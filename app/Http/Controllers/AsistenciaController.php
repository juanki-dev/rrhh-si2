<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class AsistenciaController extends Controller
{
    public function index()
    {
        $empleados = Empleado::join('asistencias', 'empleados.id', '=', 'asistencias.idEmpleado')
            ->select(
                'empleados.id as idEmpleado',
                'empleados.Nombre as Nombre',
                'empleados.Apellido as Apellido',
                'asistencias.fecha as fecha',
                'asistencias.hora_entrada as hora_entrada',
                'asistencias.hora_salida as hora_salida'
            )
            ->get();

        return view('asistencia.index', compact('empleados'));
    }

    public function indexMarcar()
    {
        return view('asistencia.indexMarcar');
    }

    public function create()
    {
        $empleados = Empleado::All();
        return view('asistencia.crear', compact('empleados'));
    }

    public function store2(Request $request)
    {
        $this->validate($request, [
            'empleadoId' => 'required',
            /* 'fecha' => 'required', */
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
        ]);
        $asistencia = new Asistencia();
        $asistencia->idEmpleado = $request->input('empleadoId');
        $asistencia->fecha = now();  // Usar now() para obtener la fecha y hora actuales
        $asistencia->hora_entrada = $request->input('hora_entrada');
        $asistencia->hora_salida = $request->input('hora_salida');
        $asistencia->save();


        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Asistencia')->log('Registró')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $asistencia->id;
        $lastActivity->save();

        return redirect()->route('asistencias.index')->with('success', 'ASISTENCIA REGISTRADA');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ci' => 'required|numeric',
        ]);
        $ci = $request->input(('ci'));
        //----------------------------------------------
        $empleado = Empleado::where('CI', $ci)->first();

        if (!$empleado || $empleado->estado == "Inactivo") { //verifica que exista el empleado o este activo           
            return redirect()->route('asistencia.indexMarcar')->with('error', 'NO SE ENCONTRO UN EMPLEADO CON ESTE CI');
        }
        //----------------------------------------------

        $boliviaTime = Carbon::now('America/La_Paz');
        $fecha = $boliviaTime->toDateString();
        $hora = $boliviaTime->toTimeString();
        $idEmpleado = $empleado->id;
        //----------------------------------------------
        $asistencia = Asistencia::where('idEmpleado',  $idEmpleado)
            ->where('fecha', $fecha)->first();
        if ($asistencia) { //verifica que el empleado ya haya marcada su asistencia en ESE DIA 
            if ($asistencia->hora_salida != null) { //verifica si marco su salida
                return redirect()->route('asistencia.indexMarcar')->with('error', 'YA NO PUEDE MARCAR MAS EN ESTE DIA');
            } else {
                Asistencia::where('idEmpleado',  $idEmpleado)
                    ->where('fecha', $fecha)->update(['hora_salida' => $hora]);
                return redirect()->route('asistencia.indexMarcar')->with('success', 'MARCO SU SALIDA');
            }
        } else { //NO marco su asistencia de ESE DIA entonces quiere decir que recien marcara su entrada
            $a = new Asistencia();
            $a->fecha = $fecha;
            $a->hora_entrada =  $hora;
            $a->idEmpleado = $idEmpleado;
            $a->save();
            return redirect()->route('asistencia.indexMarcar')->with('success', 'MARCO SU ENTRADA');
        }
        //----------------------------------------------
    }

    public function show($id)
    {
        // Lógica para mostrar los detalles de una asistencia específica
    }

    public function edit($id)
    {
        // Lógica para mostrar el formulario de edición
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar una asistencia existente
    }

    public function destroy($id)
    {
        // Lógica para eliminar una asistencia
    }
}
