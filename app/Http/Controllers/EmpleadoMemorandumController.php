<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Memorandum;
use App\Models\Empleado;
use App\Models\EmpleadoMemorandum;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MemorandumController;

class EmpleadoMemorandumController extends Controller
{
    //
    public function create()
    {return 'hola index intermedia';
    }


    public function store($idempleado, $idmemorandum)
    {   
        $empleadomemorandum = new EmpleadoMemorandum();
        $empleadomemorandum->id_Empleado = $idempleado;
        $empleadomemorandum->id_Memorandum =  $idmemorandum;
        $empleadomemorandum->save();

        

        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Memorandum')->log('Registró')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $empleadomemorandum->id;
        $lastActivity->save();

        $empleado = DB::table('empleados_memorandums')
            ->join('empleados', 'empleados_memorandums.id_Empleado', '=', 'empleados.id')
            ->where('empleados_memorandums.id_Memorandum', '=', $idmemorandum)
            ->select('empleados.*')
            ->get();
        return redirect()->route('memorandums.assign', ['id' => $idmemorandum]);
    }

    public function downloadPDF(Empleado $empleado)
    {
        $pdf = PDF::loadView('empleados.pdf', compact('empleado')); // view de como sera imprimido el pdf
        return $pdf->download('Empleado-'.$empleado->id.'.pdf');
    }
}
