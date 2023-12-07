<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Planillasueldo;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillasueldoController extends Controller
{
    public function index()
    {
        $planillas=Planillasueldo::All();
        return view('planillasueldo.index',compact('planillas'));  
    }

    public function create()
    {
        return view('planillasueldo.crear');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fecha' => 'required',
            'tipo' => 'required|string|max:100',
        ]);

        $planilla = new Planillasueldo();
        $planilla->Fecha = $request->input('fecha');
        $planilla->Total_pagado = 0;
        $planilla->Tipo =  $request->input('tipo');;
        $planilla->save();
        return redirect()->route('planillasueldos.index'); 
    }

    public function showEmpleado($tipo_contrato)
    {
        $empleadocontratos = DB::table('contratos')
        ->join('empleados', 'contratos.idEmpleado', '=', 'empleados.id') ->where('contratos.tipo_pago', $tipo_contrato) // Agrega tu condición aquí
        ->select(
            'empleados.id as idEmpleado',
            'empleados.Nombre as NombreEmpleado',
            'empleados.Apellido as ApellidoEmpleado',
            'contratos.id',
            'contratos.sueldo',
            'contratos.tipo_pago',
            'contratos.estado',
        )
        ->get();
        return view('planillasueldo.indexEmpleado',compact('empleadocontratos'));  

    }
    

}
