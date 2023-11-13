<?php

namespace App\Http\Controllers;

use App\Models\Reclutamiento;
use App\Models\Postulante;
use App\Models\PostulanteReclutamiento;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ReclutamientoController;

class PostulanteReclutamientoController extends Controller
{
  
    public function create()
    {return 'hola index intermedia';
    }


    public function store2($idpostulante, $idreclutamiento)
    {   // NO TOCAR NADA O NOS VAMOS A LA MRD
        $postulantereclutamiento = new PostulanteReclutamiento();
        $postulantereclutamiento->idPostulante = $idpostulante;
        $postulantereclutamiento->idReclutamiento =  $idreclutamiento;
        $postulantereclutamiento->save();

        

        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Reclutamiento')->log('Registró')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $postulantereclutamiento->id;
        $lastActivity->save();

        $postulante = DB::table('postulantesreclutamientos')
            ->join('postulantes', 'postulantesreclutamientos.idPostulante', '=', 'postulantes.id')
            ->where('postulantesreclutamientos.idReclutamiento', '=', $idreclutamiento)
            ->select('postulantes.*')
            ->get();
        return redirect()->route('reclutamientos.assign', ['id' => $idreclutamiento]);
    }

    public function downloadPDF(Postulante $postulante)
    {
        $pdf = PDF::loadView('postulantes.pdf', compact('postulante')); // view de como sera imprimido el pdf
        return $pdf->download('Postulante-'.$postulante->id.'.pdf');
    }
    
}
