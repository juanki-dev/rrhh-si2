<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;

use Spatie\Activitylog\Models\Activity;
class HorarioController extends Controller
{
    public function index(Request $request)
    {   
        $horario = Horario::All();
        return view('horarios.index', compact('horario'));
    }

    public function create()
    {   
        return view('horarios.crear');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hora_ini'=>'required',
            'hora_fin'=>'required',
        ]);

        $horario3 = new Horario();
        $horario3->hora_ini = $request->input('hora_ini');
        $horario3->hora_fin = $request->input('hora_fin');
        $horario3->save();

        /* $horario = Horario::create($request->all()); */
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Horarios')->log('Registró')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $horario3->id;
        $lastActivity->save();

        $horarios = Horario::All();
        return redirect()->route('horarios.index',compact('horarios'));
    }

    public function edit($id)
    {
        $horario = Horario::find($id);
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Horario')->log('Editó')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $horario->id;
        $lastActivity->save();
        return view('horarios.editar', compact('horario'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hora_ini'=>'required',
            'hora_fin'=>'required',
        ]);

        $input = $request->all();
        $horario = Horario::find($id);
        $horario->update($input);
        $horarios = Horario::All();
        return redirect()->route('horarios.index',compact('horarios'));
    }


    public function destroy($id)
    {
        $horario = Horario::find($id);
        if ($horario) {
            date_default_timezone_set("America/La_Paz");
            activity()->useLog('Horario')->log('Eliminó')->subject();
            $lastActivity = Activity::latest()->first();
            $subjectId = $horario->id;
            $lastActivity->subject_id = $subjectId;
            $lastActivity->save();
            $horario->delete();
        } else {
            $horarioselse = Horario::all();
            return redirect()->route('horarios.index',compact('horarios'))->with('error', 'Horario no Encontrado');
        }
        $horarios = Horario::All();
        return redirect()->route('horarios.index',compact('horarios'));
    }
}
