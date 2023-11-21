<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrevista;
use App\Models\Postulante;
use App\Models\Empleado;
use Spatie\Activitylog\Models\Activity;
use PDF;


class EntrevistaController extends Controller
{
    public function index(Request $request)
    {   
        $entrevista = Entrevista::All();
        $postulante = Postulante::All();
        $empleado  = Empleado::All();
        return view('entrevistas.index', compact('entrevista','postulante','empleado'));
    }

    public function create()
    {   
        $entrevista = Entrevista::All();
        $postulante = Postulante::All();
        $empleado  = Empleado::All();
        return view('entrevistas.crear',compact('entrevista','postulante','empleado'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Fechainicio'=>'required',
            'Hora'=>'required',
            'Calificacion'=>'required',
            'Comentario'=>'required',
            'idEmpleado'=>'required',
            'idPostulante'=>'required',
        ]);

        $entrevista = Entrevista::create($request->all());
        $postulante  = Postulante::All();
        $empleado  = Empleado::All();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Entrevista')->log('Registró')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $entrevista->id;
        $lastActivity->save();

        return redirect()->route('entrevistas.index',compact('postulante','empleado'));
    }




    public function edit($id)
    {
        $entrevista = Entrevista::find($id);
        $postulante  = Postulante::All();
        $empleado  = Empleado::All();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Entrevista')->log('Editó')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $entrevista->id;
        $lastActivity->save();
        return view('entrevistas.editar', compact('entrevista','postulante','empleado'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Fechainicio'=>'required',
            'Hora'=>'required',
            'Calificacion'=>'required',
            'Comentario'=>'required',
            'idEmpleado'=>'required',
            'idPostulante'=>'required',
        ]);

        $input = $request->all();
        $entrevista = Entrevista::find($id);
        $entrevista->update($input);
        $empleado  = Empleado::All();
        $postulante  = Postulante::All();
        return redirect()->route('entrevistas.index',compact('entrevista','empleado','postulante'));
    }


    public function destroy($id)
    {
        $entrevista = Entrevista::find($id);
        $empleado = Empleado::All();
        $postulante = Postulante::All();
        if ($postulante) {
            date_default_timezone_set("America/La_Paz");
            activity()->useLog('Entrevista')->log('Eliminó')->subject();
            $lastActivity = Activity::latest()->first();
            $subjectId = $entrevista->id;
            $lastActivity->subject_id = $subjectId;
            $lastActivity->save();
            $entrevista->delete();
        } else {
            return redirect()->route('entrevistas.index',compact('entrevista','empleado','postulante'))->with('error', 'Entrevista no Encontrada');
        }
        return redirect()->route('entrevistas.index',compact('entrevista','empleado','postulante'));
    }

}
