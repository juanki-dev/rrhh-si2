<?php

namespace App\Http\Controllers;

use App\Models\Memorandum;
use App\Models\EmpleadoMemorandum;
use App\Models\Empleado;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Spatie\Activitylog\Models\Activity;
use PDF;

class MemorandumController extends Controller
{
    //
    public function index(Request $request)
    {
        $memorandum = Memorandum::All();
        return view('memorandums.index', compact('memorandum') );
    }

    public function create()
    {
        return view('memorandums.crear');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required',
            'body' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $memorandum = Memorandum::create($request->all());

        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Memorandum')->log('Registró')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $memorandum->id;
        $lastActivity->save();

        return redirect()->route('memorandums.index');
    }

    public function edit($id)
    {
        $memorandum = Memorandum::find($id);
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Memorandum')->log('Editó')->subject();
        $lastActivity = Activity::all()->last();
        $lastActivity->subject_id = $memorandum->id;
        $lastActivity->save();
        return view('memorandums.editar', compact('memorandum'));
    }


    public function show($id)
    {
        $empleado = DB::table('empleados_memorandums')
            ->join('empleados', 'empleados_memorandums.id_Empleado', '=', 'empleados.id')
            ->where('empleados_memorandums.id_Memorandum', '=', $id)
            ->select('empleados.*')
            ->get();

        $memorandum = Memorandum::find($id);

        return view('memorandums.verempleados', compact('empleado', 'memorandum'));
    }

    public function assign($id)
    {
        $memorandum = Memorandum::find($id);
        $listaEmpleados = $this->getUnassignedEmpleados($memorandum);
        return view('memorandums.asignarempleado', compact('listaEmpleados', 'memorandum'));

    }

    public function getUnassignedEmpleados(Memorandum $memorandum)
    {
        $id = $memorandum->id;
        $noempleados = DB::table('empleados')
            ->leftJoin('empleados_memorandums', function ($join) use ($id) {
                $join->on('empleados.id', '=', 'empleados_memorandums.id_Empleado')
                    ->where('empleados_memorandums.id_Memorandum', '=', $id);
            })
            ->whereNull('empleados_memorandums.id_Empleado')
            ->select('empleados.*')
            ->get();
        return $noempleados;        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'subject' => 'required',
            'body' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $input = $request->all();
        $memorandum = Memorandum::find($id);
        $memorandum->update($input);
        return redirect()->route('memorandums.index');
    }


    public function destroy($id)
    {
        $memorandum = Memorandum::find($id);
        if ($memorandum) {
            date_default_timezone_set("America/La_Paz");
            activity()->useLog('Memorandum')->log('Eliminó')->subject();
            $lastActivity = Activity::latest()->first();
            $subjectId = $memorandum->id;
            $lastActivity->subject_id = $subjectId;
            $lastActivity->save();
            $memorandum->delete();
        } else {
            return redirect()->route('memorandums.index')->with('error', 'Memorandum no encontrado');
        }
        return redirect()->route('memorandums.index');
    }
}
