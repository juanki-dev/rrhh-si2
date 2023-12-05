<?php

namespace App\Http\Controllers;

use App\Models\Memorandum;
use App\Models\Empleado;
use App\Models\Cargo;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Spatie\Activitylog\Models\Activity;
use PDF;

class MemorandumController extends Controller
{
    //
    public function index()
    {
        $memorandums = DB::table('memorandums')
            ->join('empleados', 'memorandums.idEmpleado', '=', 'empleados.id')
            ->select('memorandums.*', 'empleados.Nombre', 'empleados.Apellido')
            ->get();
        return view('memorandums.index', compact('memorandums'));
    }
    
    public function indexEmpleado()
    {
        $empleado = Empleado::All();
        $cargo  = Cargo::All();
        return view('memorandums.indexEmpleado', compact('empleado', 'cargo'));
    }

    public function showEmpleado($empleadoId)
    {
        $memorandums = Memorandum::where('idEmpleado', $empleadoId)->get();
        // dd($memorandums);
        $empleados = Empleado::where('id', $empleadoId)->first(); //solo para una fila
        return view('memorandums.showEmpleado', compact('memorandums', 'empleados'));
    }

    public function create($empleadoId)
    {
        return view('memorandums.crear', compact('empleadoId'));
    }

    

    public function store(Request $request)
    {
        $this->validate($request, [
            'asunto' => 'required',
            'contenido' => 'required',
            // 'fecha' => 'required',
            // 'hora' => 'required',
        ]);

        /////////////////////////////////////////////
        $boliviaTime = Carbon::now('America/La_Paz');
        $fecha = $boliviaTime->toDateString();
        $hora = $boliviaTime->toTimeString();
        /////////////////////////////////////////////
        $memorandum = new Memorandum();
        $memorandum->fecha = $fecha;
        $memorandum->hora =  $hora;
        $memorandum->asunto = $request->input('asunto');
        $memorandum->contenido = $request->input('contenido');
        $memorandum->idEmpleado = $request->input('empleadoId');
        $memorandum->save();

        $this->addBitacora("Memorandum", "Registró");
        return redirect()->route('memorandum.indexEmpleado');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'asunto' => 'required',
            'contenido' => 'required',
        ]);
        
        $memorandum = Memorandum::find($id);
        $memorandum->asunto = $request->input('asunto');
        $memorandum->contenido = $request->input('contenido');
        $memorandum->save();

        $this->addBitacora("Memorandum", "Editó");
        return redirect()->route('memorandums.index');
    }

    public function show($id)
    {
        $memorandum = DB::table('memorandums')
            ->join('empleados', 'memorandums.idEmpleado', '=', 'empleados.id')
            ->select('memorandums.*', 'empleados.Nombre', 'empleados.Apellido')
            ->where('memorandums.id', $id)
            ->first();
        
        return view('memorandums.show', compact('memorandum'));
    }

    public function edit($id)
    {
        $memorandums = Memorandum::find($id);
        return view('memorandums.editar', compact('memorandums'));
    }

    public function destroy($id)
    {
        $memorandum = Memorandum::find($id);

        if ($memorandum) {
            $memorandum->delete();
            $this->addBitacora("Memorandum", "Eliminó");
        }

        return redirect()->route('memorandums.index');
    }

    public function addBitacora($tabla, $accion)
    {
        date_default_timezone_set("America/La_Paz");
        activity()->useLog($tabla)->log($accion)->subject();
    }

}
