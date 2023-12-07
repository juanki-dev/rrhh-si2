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
        $this->validate($request, [
            'fecha' => 'required',
            'cantidad_hora' => 'required|numeric',
            'idEmpleado' => 'required',
        ]);
    
        $horasExtras = HorasExtras::findOrFail($id);
    
        $contrato = Contrato::where('idEmpleado', $request->idEmpleado)->first();
    
        if (!$contrato) {
            // Manejar el caso en el que el empleado no tiene contrato
        }
    
        $montoHora = $this->calcularMontoHora($contrato);
    
        $horasExtras->update([
            'Fecha' => $request->fecha,
            'Cantidad_Hora' => $request->cantidad_hora,
            'Monto_Hora' => $montoHora,
            'Monto_Total' => $request->cantidad_hora * $montoHora,
            'idEmpleado' => $request->idEmpleado,
            'idContrato' => $contrato->id,
        ]);
    
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
            $horasExtras->estado = 2;
            $horasExtras->save();
    
            return redirect()->route('horas.index')->with('success', 'Horas extras anuladas satisfactoriamente');
        } else {
            return redirect()->route('horas.index')->with('error', 'Horas extras no encontradas');
        }
    }
    public function markAsPaid($id)
    {
        $horaExtra = HorasExtras::find($id);
    
        if ($horaExtra) {
            // Marcar como pagado
            $horaExtra->estado = 1;  // Asigna el estado correspondiente para "Pagado"
            $horaExtra->save();
    
            // Redirige a la vista de detalles
            return redirect()->route('horas.index', $horaExtra->id)->with('success', 'Horas extras marcadas como pagadas');
        } else {
            return redirect()->route('horas.index')->with('error', 'Horas extras no encontradas');
        }
    }
    

}
