<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Planillasueldo;
use App\Models\Bono;
use App\Models\Descuento;
use App\Models\Contrato;
use App\Models\HorasExtras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Planillaempleado;

class PlanillasueldoController extends Controller
{
    public function index()
    {
        $planillas = Planillasueldo::All();
        return view('planillasueldo.index', compact('planillas'));
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

    public function showEmpleado($tipo_contrato, $id_planillasueldo)
    {
        $empleadocontratos = DB::table('contratos')
            ->join('empleados', 'contratos.idEmpleado', '=', 'empleados.id')->where('contratos.tipo_pago', $tipo_contrato) // Agrega tu condición aquí
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
        return view('planillasueldo.indexEmpleado', compact('empleadocontratos', "id_planillasueldo"));
    }

    public function createPago($id_empleado, $id_contrato, $id_planillasueldo)
    {

        $planillasueldo = Planillasueldo::where('id',  $id_planillasueldo)->first();
        $fecha = $planillasueldo->Fecha;

        $contrato = Contrato::where('id', $id_contrato)->first();
        $sueldo = $contrato->sueldo;

        $horas_extras_empleado = HorasExtras::where('idEmpleado', $id_empleado)
            ->where('idContrato', $id_contrato)
            ->whereDate('Fecha', '<=', $fecha)->get();

        $cantidad_hora = 0;
        $monto_total = 0;


        foreach ($horas_extras_empleado as $horas_extra) {
            $cantidad_hora += $horas_extra->Cantidad_Hora;
            $monto_total += $horas_extra->Monto_Total;
        }

        $bonos = Bono::where('idEmpleado', $id_empleado)->where('estado', '==', 0)->get();

        $bono_total = 0;
        foreach ($bonos as $bono) {
            $bono_total += $bono->monto;
        }

        $descuentos = Descuento::where('idEmpleado', $id_empleado)->where('estado', '==', 0)->get();

        $descuento_total = 0;
        foreach ($descuentos as $descuento) {
            $descuento_total += $descuento->monto;
        }

        $porcentajeAFP = 10; // Porcentaje de AFP

        // Calcula la AFP
        $afp = ($sueldo * $porcentajeAFP) / 100;

        $liquido =  $sueldo + $monto_total + $bono_total - $descuento_total - $afp;

        $p = new Planillaempleado();
        $p->idPlanillasueldo = $id_planillasueldo;
        $p->idEmpleado = $id_empleado;
        $p->sueldo = $sueldo;
        $p->horas_extras = $cantidad_hora;
        $p->monto_horas_extras = $monto_total;
        $p->bono_total = $bono_total;
        $p->descuento_total = $descuento_total;
        $p->afp = $afp;
        $p->liquido = $liquido;
        $p->save();

        $planillasempleado = Planillaempleado::All();


        return view('planillasueldo.verpago',compact('planillasempleado'));
    }
}
