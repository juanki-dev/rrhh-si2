<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Descuento;
use App\Models\Empleado;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DescuentoController extends Controller
{
    public function index()
    {
        $descuentos = DB::table('descuentos')
            ->join('empleados', 'descuentos.idEmpleado', '=', 'empleados.id')
            ->select('descuentos.*', 'empleados.Nombre', 'empleados.Apellido')
            ->get();



        return view('descuentos.index', compact('descuentos'));
    }

    public function indexEmpleado()
    {
        $empleado = Empleado::All();
        $cargo  = Cargo::All();
        return view('descuentos.indexEmpleado', compact('empleado', 'cargo'));
    }

    public function showEmpleado($empleadoId)
    {
        $descuentos = Descuento::where('idEmpleado', $empleadoId)->get();
        $empleados = Empleado::where('id', $empleadoId)->first(); //solo para una fila
        return view('descuentos.showEmpleado', compact('descuentos', 'empleados'));
    }

    public function create($empleadoId)
    {
        return view('descuentos.crear', compact('empleadoId'));
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
        $descuento = new Descuento();
        $descuento->fecha = $fecha;
        $descuento->hora =  $hora;
        $descuento->monto = $request->input('monto');
        $descuento->motivo = $request->input('motivo');
        $descuento->observacion = $observacion;
        $descuento->estado = 0;
        $descuento->idEmpleado = $request->input('empleadoId');
        $descuento->save();

        $this->addBitacora("Descuento", "Registró");
        return redirect()->route('descuento.indexEmpleado');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'monto' => 'required|numeric',
            'motivo' => 'required|string|max:100',

        ]);
        $observacion = $request->input('observacion');
        $observacion = $observacion ?? '';

        $descuento = Descuento::find($id);
        $descuento->monto = $request->input('monto');
        $descuento->motivo = $request->input('motivo');
        $descuento->observacion = $observacion;
        $descuento->save();
        $this->addBitacora("Descuento", "Editó");
        return redirect()->route('descuentos.index');
    }


    public function show($id)
    {
        //$descuento = Descuento::find($id);
        $descuento = DB::table('descuentos')
            ->join('empleados', 'descuentos.idEmpleado', '=', 'empleados.id')
            ->select('descuentos.*', 'empleados.Nombre', 'empleados.Apellido')
            ->where('descuentos.id', $id)
            ->first();


        return view('descuentos.show', compact('descuento'));
    }

    public function edit($id)
    {
        $descuentos = Descuento::find($id);
        return view('descuentos.editar', compact('descuentos'));
    }



    public function destroy($id) //SOLO ANULARA
    {

        $descuento = Descuento::find($id);
        $descuento->estado = 2;
        $descuento->observacion = "ANULADO";
        $descuento->save();
        $this->addBitacora("Descuento", "Anuló");
        return redirect()->route('descuentos.index');
    }

    public function addBitacora($tabla, $accion)
    {
        date_default_timezone_set("America/La_Paz");
        activity()->useLog($tabla)->log($accion)->subject();
    }
}
