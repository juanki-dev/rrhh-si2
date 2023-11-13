<?php

namespace App\Http\Controllers;

use App\Models\Reclutamiento;
use App\Models\Cargo;
use App\Models\PostulanteReclutamiento;
use App\Models\Postulante;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ReclutamientoController extends Controller
{
    public function index(Request $request)
    {
        $reclutamiento = Reclutamiento::All();
        $cargo  = Cargo::All();
        return view('reclutamientos.index', compact('reclutamiento', 'cargo'));
    }

    public function create()
    {
        $cargo  = Cargo::All();
        return view('reclutamientos.crear', compact('cargo'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'fechainicio' => 'required',
            'fechafin' => 'required',
            'idCargo' => 'required',
        ]);

        $reclutamiento = Reclutamiento::create($request->all());
        $cargo  = Cargo::All();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Reclutamiento')->log('Registró')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $reclutamiento->id;
        $lastActivity->save();

        return redirect()->route('reclutamientos.index', compact('cargo'));
    }

    public function edit($id)
    {
        $reclutamiento = Reclutamiento::find($id);
        $cargo  = Cargo::All();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Reclutamiento')->log('Editó')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $reclutamiento->id;
        $lastActivity->save();
        return view('reclutamientos.editar', compact('reclutamiento', 'cargo'));
    }


    public function show($id)
    {
        $postulante = DB::table('postulantesreclutamientos')
            ->join('postulantes', 'postulantesreclutamientos.idPostulante', '=', 'postulantes.id')
            ->where('postulantesreclutamientos.idReclutamiento', '=', $id)
            ->select('postulantes.*')
            ->get();

        $reclutamiento = Reclutamiento::find($id);

        return view('reclutamientos.verpostulantes', compact('postulante', 'reclutamiento'));
    }

    public function assign($id)
    {
        $reclutamiento = Reclutamiento::find($id);
        $listapostu = $this->getUnassignedPostulantes($reclutamiento);
        return view('reclutamientos.asignarpostulante', compact('listapostu', 'reclutamiento'));

    }

    public function getUnassignedPostulantes(Reclutamiento $reclutamiento)
    {
        $id = $reclutamiento->id;
        $nopostulantes = DB::table('postulantes')
            ->leftJoin('postulantesreclutamientos', function ($join) use ($id) {
                $join->on('postulantes.id', '=', 'postulantesreclutamientos.idPostulante')
                    ->where('postulantesreclutamientos.idReclutamiento', '=', $id);
            })
            ->whereNull('postulantesreclutamientos.idPostulante')
            ->select('postulantes.*')
            ->get();
        return $nopostulantes;        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'fechainicio' => 'required',
            'fechafin' => 'required',
            'idCargo' => 'required',
        ]);

        $input = $request->all();
        $reclutamiento = Reclutamiento::find($id);
        $reclutamiento->update($input);
        $cargo  = Cargo::All();
        return redirect()->route('reclutamientos.index', compact('cargo'));
    }


    public function destroy($id)
    {
        $reclutamiento = Reclutamiento::find($id);
        $cargo  = Cargo::All();
        if ($reclutamiento) {
            date_default_timezone_set("America/La_Paz");
            activity()->useLog('Reclutamiento')->log('Eliminó')->subject();
            $lastActivity = Activity::latest()->first();
            $subjectId = $reclutamiento->id;
            $lastActivity->subject_id = $subjectId;
            $lastActivity->save();
            $reclutamiento->delete();
        } else {
            return redirect()->route('reclutamientos.index', compact('cargo'))->with('error', 'Reclutamiento no encontrado');
        }
        return redirect()->route('reclutamientos.index', compact('cargo'));
    }
}
