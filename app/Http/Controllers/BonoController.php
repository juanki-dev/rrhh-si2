<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bono;
use App\Models\Empleado;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BonoController extends Controller
{
    //
    public function index()
    {
        $bonos = DB::table('bonos')
            ->join('empleados', 'bonos.idEmpleado', '=', 'empleados.id')
            ->select('bonos.*', 'empleados.Nombre', 'empleados.Apellido')
            ->get();



        return view('bonos.index', compact('bonos'));
    }

    public function indexEmpleado()
    {
        $empleado = Empleado::All();
        $cargo  = Cargo::All();
        return view('bonos.indexEmpleado', compact('empleado', 'cargo'));
    }

    public function showEmpleado($empleadoId)
    {
        $bonos = Bono::where('idEmpleado', $empleadoId)->get();
        $empleados = Empleado::where('id', $empleadoId)->first(); //solo para una fila
        return view('bonos.showEmpleado', compact('bonos', 'empleados'));
    }

    public function create($empleadoId)
    {
        return view('bonos.crear', compact('empleadoId'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'empleadoId' => 'required',
            'monto' => 'required|numeric',
            'motivo' => 'required|string|max:100',

        ]);
        $observacion = $request->input('observacion');
        $observacion = $observacion ?? '';
        /////////////////////////////////////////////
        $boliviaTime = Carbon::now('America/La_Paz');
        $fecha = $boliviaTime->toDateString();
        $hora = $boliviaTime->toTimeString();
        /////////////////////////////////////////////
        $bono = new Bono();
        $bono->fecha = $fecha;
        $bono->hora =  $hora;
        $bono->monto = $request->input('monto');
        $bono->motivo = $request->input('motivo');
        $bono->observacion = $observacion;
        $bono->estado = 0;
        $bono->idEmpleado = $request->input('empleadoId');
        $bono->save();

        $this->addBitacora("Bono", "Registró");
        return redirect()->route('bono.indexEmpleado');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'monto' => 'required|numeric',
            'motivo' => 'required|string|max:100',

        ]);
        $observacion = $request->input('observacion');
        $observacion = $observacion ?? '';

        $bono = Bono::find($id);
        $bono->monto = $request->input('monto');
        $bono->motivo = $request->input('motivo');
        $bono->observacion = $observacion;
        $bono->save();
        $this->addBitacora("Bono", "Editó");
        return redirect()->route('bonos.index');
    }


    public function show($id)
    {
        //$bono = Bono::find($id);
        $bono = DB::table('bonos')
            ->join('empleados', 'bonos.idEmpleado', '=', 'empleados.id')
            ->select('bonos.*', 'empleados.Nombre', 'empleados.Apellido')
            ->where('bonos.id', $id)
            ->first();


        return view('bonos.show', compact('bono'));
    }

    public function edit($id)
    {
        $bonos = Bono::find($id);
        return view('bonos.editar', compact('bonos'));
    }



    public function destroy($id) //SOLO ANULARA
    {

        $bono = Bono::find($id);
        $bono->estado = 2;
        $bono->observacion = "ANULADO";
        $bono->save();
        $this->addBitacora("Bono", "Anuló");
        return redirect()->route('bonos.index');
    }

    public function addBitacora($tabla, $accion)
    {
        date_default_timezone_set("America/La_Paz");
        activity()->useLog($tabla)->log($accion)->subject();
    }
}
