<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HorasExtras;
use App\Models\Empleado;
use App\Models\Contrato;
use Illuminate\Support\Facades\DB;

class HorasExtrasController extends Controller
{
    public function index()
    {
        $horasExtras = DB::table('horas_extras')
            ->join('empleados', 'horas_extras.idEmpleado', '=', 'empleados.id')
            ->select('horas_extras.*', 'empleados.Nombre', 'empleados.Apellido')
            ->get();

        return view('horas_extras.index', compact('horasExtras'));
    }

    public function indexEmpleado()
    {
        $empleados = Empleado::all();
        $contratos = Contrato::all();

        return view('horas_extras.indexEmpleado', compact('empleados', 'contratos'));
    }

    public function showEmpleado($empleadoId)
    {
        $horasExtras = HorasExtras::where('idEmpleado', $empleadoId)->get();
        $empleado = Empleado::find($empleadoId);

        return view('horas_extras.showEmpleado', compact('horasExtras', 'empleado'));
    }

    public function create($empleadoId)
    {
        return view('horas_extras.crear', compact('empleadoId'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fecha' => 'required',
            'cantidad_hora' => 'required|numeric',
            'idEmpleado' => 'required',
        ]);
    
        $contrato = Contrato::where('idEmpleado', $request->idEmpleado)->first();
        
        if (!$contrato) {
            // Manejar el caso en el que el empleado no tiene contrato
        }
    
        $montoHora = $this->calcularMontoHora($contrato);
    
        $horasExtras = new HorasExtras([
            'Fecha' => $request->fecha,
            'Cantidad_Hora' => $request->cantidad_hora,
            'Monto_Hora' => $montoHora,
            'Monto_Total' => $request->cantidad_hora * $montoHora,
            'estado' => 0, // Valor predeterminado
            'idEmpleado' => $request->idEmpleado,
            'idContrato' => $contrato->id,
            // Otros campos necesarios
        ]);
    
        $horasExtras->save();
    
        return redirect()->route('horas.index')->with('success', 'Horas extras registradas satisfactoriamente');
    }
    
    private function calcularMontoHora($contrato)
    {
        $montoHora = 0;
    
        switch ($contrato->tipo_pago) {
            case 'Quincenal':
                $montoHora = $contrato->sueldo / (9 * 15); 
                break;
            case 'Mensual':
                $montoHora = $contrato->sueldo / (9 * 30); 
            case 'Semanal':
                $montoHora = $contrato->sueldo / (9 * 7); 
                break;
            case 'Diario':
                $montoHora = $contrato->sueldo / 9;
                break;
            
        }
    
        return $montoHora;
    }
    
    

    public function edit($id)
    {
        $horaExtra = HorasExtras::find($id);
    
        
        if (!$horaExtra) {
            
            return redirect()->route('horas.index')->with('error', 'Hora extra no encontrada');
        }
    
        return view('horas_extras.editar', compact('horaExtra'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'cantidad_hora' => 'required|numeric',
            // Otras reglas de validación...
    
            // Excluir las reglas de validación para idEmpleado e idContrato al editar
            'idEmpleado' => 'sometimes|required',
            'idContrato' => 'sometimes|required',
        ]);

        $montoHoraDefault = 30; // Monto por defecto por hora

        $horasExtras = HorasExtras::find($id);

        $horasExtras->Fecha = $request->fecha;
        $horasExtras->Cantidad_Hora = $request->cantidad_hora;
        $horasExtras->Monto_Hora = $montoHoraDefault;
        $horasExtras->Monto_Total = $request->cantidad_hora * $montoHoraDefault;
        $horasExtras->idEmpleado = $request->idEmpleado;
        $horasExtras->idContrato = $request->idContrato;
        $horasExtras->save();

        return redirect()->route('horas.index')->with('success', 'Horas extras actualizadas satisfactoriamente');
    }

    public function show($id)
    {
        $horasExtras = DB::table('horas_extras')
            ->join('empleados', 'horas_extras.idEmpleado', '=', 'empleados.id')
            ->select('horas_extras.*', 'empleados.Nombre', 'empleados.Apellido')
            ->where('horas_extras.id', $id)
            ->first();

        return view('horas_extras.show', compact('horasExtras'));
    }

    public function destroy($id)
    {
        $horasExtras = HorasExtras::find($id);
    
        if ($horasExtras) {
            // Cambiar el estado en lugar de eliminar
            $horasExtras->estado = 2; // Suponiendo que 1 sea el código para "Anulado"
            $horasExtras->save();
    
            return redirect()->route('horas.index')->with('success', 'Horas extras anuladas satisfactoriamente');
        } else {
            return redirect()->route('horas.index')->with('error', 'Horas extras no encontradas');
        }
    }
    
    
}
