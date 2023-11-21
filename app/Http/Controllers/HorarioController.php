<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Empleado;
use App\Models\Cargo;
use Spatie\Activitylog\Models\Activity;
class HorarioController extends Controller
{
    public function index(Request $request)
    {   
        $horario = Horario::All();
        $empleado = Empleado::All();
        $cargo  = Cargo::All();
        return view('horarios.index', compact('horario','empleado','cargo'));
    }

    public function create()
    {   
        $horario = Horario::All();
        $empleado = Empleado::All();
        $cargo  = Cargo::All();
        return view('horarios.crear',compact('horario','empleado','cargo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'HoraEntrada'=>'required',
            'HoraSalida'=>'required',
            'idEmpleado'=>'required',
            'idCargo'=>'required',
        ]);

        $horario = Horario::create($request->all());
        $empleado  = Empleado::All();
        $cargo  = Cargo::All();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Horarios')->log('Registró')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $horario->id;
        $lastActivity->save();

        return redirect()->route('horarios.index',compact('empleado','cargo'));
    }




    public function edit($id)
    {
        $horario = Horario::find($id);
        $empleado  = Empleado::All();
        $cargo  = Cargo::All();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Horario')->log('Editó')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $horario->id;
        $lastActivity->save();
        return view('horarios.editar', compact('horario','cargo','empleado'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'HoraEntrada'=>'required',
            'HoraSalida'=>'required',
            'idEmpleado'=>'required',
            'idCargo'=>'required',
        ]);

        $input = $request->all();
        $horario = Horario::find($id);
        $horario->update($input);
        $empleado  = Empleado::All();
        $cargo  = Cargo::All();
        return redirect()->route('horarios.index',compact('horario','empleado','cargo'));
    }


    public function destroy($id)
    {
        $horario = Horario::find($id);
        $empleado = Empleado::All();
        $cargo = Cargo::All();
        if ($horario) {
            date_default_timezone_set("America/La_Paz");
            activity()->useLog('Horario')->log('Eliminó')->subject();
            $lastActivity = Activity::latest()->first();
            $subjectId = $horario->id;
            $lastActivity->subject_id = $subjectId;
            $lastActivity->save();
            $horario->delete();
        } else {
            return redirect()->route('horarios.index',compact('horario','empleado','cargo'))->with('error', 'Horario no Encontrada');
        }
        return redirect()->route('horarios.index',compact('horario','empleado','cargo'));
    }
}
