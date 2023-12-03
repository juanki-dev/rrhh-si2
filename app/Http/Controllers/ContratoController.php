<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Horario;

class ContratoController extends Controller
{
    public function index()
    {
        $contrato = Contrato::All();
        $empleado  = Empleado::All();

        $empleadocontratos = DB::table('contratos')
            ->join('empleados', 'contratos.id_empleado', '=', 'empleados.id')
            ->join('horarios', 'contratos.idHorario', '=', 'horarios.id')
            ->select('empleados.id as id_empleado', 'empleados.Nombre as nombre_empleado', 'empleados.Apellido as apellido_empleado', 'contratos.id as id_contrato', 'contratos.sueldo', 'contratos.fecha_inicio', 'contratos.fecha_fin', 'horarios.hora_inicio', 'horarios.hora_fin')
            ->get();

        return view('empleados.index', compact('empleadocontratos'));


        // Rest of the code...


    }
}
