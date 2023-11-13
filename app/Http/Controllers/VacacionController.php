<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Empleado;
use App\Models\Cargo;
use App\Models\Vacacion;
use Carbon\Carbon;

class VacacionController extends Controller
{
    public function index()
    {
        $vacaciones = DB::table('vacaciones')
            ->join('empleados', 'vacaciones.idEmpleado', '=', 'empleados.id')
            ->select('vacaciones.*', 'empleados.Nombre', 'empleados.Apellido')
            ->get();

        return view('vacaciones.index', compact('vacaciones'));
    }

    public function indexEmpleado()
    {
        $empleado = Empleado::All();
        $cargo  = Cargo::All();
        return view('vacaciones.indexEmpleado', compact('empleado', 'cargo'));
    }

    public function showEmpleado($empleadoId)
    {
        $vacaciones = Vacacion::where('idEmpleado', $empleadoId)->get();
        $empleados = Empleado::where('id', $empleadoId)->first(); //solo para una fila
        return view('vacaciones.showEmpleado', compact('vacaciones', 'empleados'));
    }

    public function create($empleadoId)
    {
        return view('vacaciones.crear', compact('empleadoId'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'empleadoId' => 'required',
            'fechaInicio' => 'required|date|date_format:Y-m-d',
            'fechaFin' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) < strtotime($request->input('fechaInicio'))) {
                        $fail('La fecha de fin debe ser igual o posterior a la fecha de inicio.');
                    }
                },
            ],
            'descripcion' => 'required|string|max:100',
        ]);
        /////////////////////////////////////////////
        $boliviaTime = Carbon::now('America/La_Paz');
        $fecha = $boliviaTime->toDateString();
        /////////////////////////////////////////////
        $vacacion = new Vacacion();
        $vacacion->fecha = $fecha;
        $vacacion->fechaInicio = $request->input('fechaInicio');
        $vacacion->fechaFin = $request->input('fechaFin');
        $vacacion->descripcion = $request->input('descripcion');
        $vacacion->idEmpleado = $request->input('empleadoId');
        $vacacion->save();
        $this->addBitacora("Vacacion", "Registró");
        return redirect()->route('vacaciones.index');
    }

    public function edit($id)
    {
        $vacaciones = Vacacion::find($id);
        return view('vacaciones.editar', compact('vacaciones'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fechaInicio' => 'required|date|date_format:Y-m-d',
            'fechaFin' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) < strtotime($request->input('fechaInicio'))) {
                        $fail('La fecha de fin debe ser igual o posterior a la fecha de inicio.');
                    }
                },
            ],
            'descripcion' => 'required|string|max:100',
        ]);
      

        $vacacion = Vacacion::find($id);
        $vacacion->fechaInicio = $request->input('fechaInicio');
        $vacacion->fechaFin = $request->input('fechaFin');
        $vacacion->descripcion = $request->input('descripcion');
        $vacacion->save();
        $this->addBitacora("Vacacion", "Editó");
        return redirect()->route('vacaciones.index');
    }

    public function destroy($id)
    {
        $vacacion = Vacacion::find($id);
        $vacacion->delete();
        $this->addBitacora("Vacacion", "Eliminó");
        return redirect()->route('vacaciones.index');
    }
    

    public function addBitacora($tabla, $accion)
    {
        date_default_timezone_set("America/La_Paz");
        activity()->useLog($tabla)->log($accion)->subject();
    }
}
