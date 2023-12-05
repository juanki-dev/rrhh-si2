<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Cargo;
use Spatie\Activitylog\Models\Activity;

class ContratoController extends Controller
{
    public function index()
    {
        $contrato = Contrato::All();
        $empleado  = Empleado::All();

        $empleadocontratos = DB::table('contratos')
            ->join('empleados', 'contratos.idEmpleado', '=', 'empleados.id')
            ->join('horarios', 'contratos.idHorario', '=', 'horarios.id')
            ->join('cargos', 'contratos.idCargo', '=', 'cargos.id')
            ->join('departamentos', 'cargos.idDepartamento', '=', 'departamentos.id')
            ->select(
                'empleados.id as idEmpleado',
                'empleados.Nombre as NombreEmpleado',
                'empleados.Apellido as ApellidoEmpleado',
                'contratos.id',
                'contratos.sueldo',
                'contratos.fecha_inicio',
                'contratos.fecha_fin',
                'contratos.estado',
                'horarios.hora_ini',
                'horarios.hora_fin',
                'cargos.Nombre as cargoNombre',
                'departamentos.Nombre as departamentoNombre'
            )
            ->orderByRaw("CASE WHEN contratos.estado = 'Activo' THEN 0 ELSE 1 END")
            ->get();



        return view('contratos.index', compact('empleadocontratos'));
    }

    public function create()
    {
        $empleados = Empleado::whereDoesntHave('contratos')
            ->orWhereHas('contratos', function ($query) {
                $query->where('estado', '=', 'Inactivo');
            })
            ->get();

        $horarios = Horario::All();
        $cargos = Cargo::All();
        return view('contratos.crear', compact('empleados', 'horarios', 'cargos'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sueldo' => 'required',
            'fecha_inicio' => 'required',
            'tipo' => 'required',
            'tipo_pago' => 'required',
            'idHorario' => 'required',
            'idEmpleado' => 'required',
            'idCargo' => 'required',
        ]);
        $contrato = new Contrato;
        $contrato->sueldo = $request->sueldo;
        $contrato->fecha_inicio = $request->fecha_inicio;
        $contrato->fecha_fin = $request->fecha_fin;
        $contrato->tipo = $request->tipo;
        $contrato->tipo_pago = $request->tipo_pago;
        $contrato->estado = 'Activo';
        $contrato->idHorario = $request->idHorario;
        $contrato->idEmpleado = $request->idEmpleado;
        $contrato->idCargo = $request->idCargo;
        $contrato->save();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Contrato')->log('Nuevo')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $contrato->id;
        $lastActivity->save();
        return redirect()->route('contratos.index')->with('success', 'Contrato creado satisfactoriamente');
    }
    public function edit($id)
    {
        $contrato = Contrato::find($id);
        $empleado = Empleado::find($contrato->idEmpleado);
        $horarios = Horario::All();
        $cargos = Cargo::All();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Contrato')->log('Editar')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $contrato->id;
        $lastActivity->save();
        return view('contratos.editar', compact('contrato', 'empleado', 'horarios', 'cargos'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sueldo' => 'required',
            'fecha_inicio' => 'required',
            'tipo' => 'required',
            'tipo_pago' => 'required',
            'estado' => 'required',
            'idHorario' => 'required',
            'idEmpleado' => 'required',
            'idCargo' => 'required',
        ]);
        $contrato = Contrato::find($id);
        $contrato->sueldo = $request->sueldo;
        $contrato->fecha_inicio = $request->fecha_inicio;
        $contrato->fecha_fin = $request->fecha_fin;
        $contrato->tipo = $request->tipo;
        $contrato->tipo_pago = $request->tipo_pago;
        $contrato->estado = $request->estado;
        $contrato->idHorario = $request->idHorario;
        $contrato->idEmpleado = $request->idEmpleado;
        $contrato->idCargo = $request->idCargo;
        $contrato->save();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Contrato')->log('Editar')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $contrato->id;
        $lastActivity->save();
        return redirect()->route('contratos.index')->with('success', 'Contrato actualizado satisfactoriamente');
    }
    public function destroy($id)
    {
        $contrato = Contrato::find($id);
        if ($contrato) {
            date_default_timezone_set("America/La_Paz");
            activity()->useLog('Contrato')->log('Eliminó')->subject();
            $lastActivity = Activity::latest()->first();
            $subjectId = $contrato->id;
            $lastActivity->subject_id = $subjectId;
            $lastActivity->save();
            $contrato->delete();
        } else {
            return redirect()->route('contratos.index')->with('error', 'Contrato no encontrado');
        }
        return redirect()->route('contratos.index');
    }
}
