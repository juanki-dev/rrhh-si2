<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use Carbon\Carbon;
use App\Models\Empleado;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{
    public function index()
    {
        $permisos = DB::table('permisos')
            ->join('empleados', 'permisos.idEmpleado', '=', 'empleados.id')
            ->select('permisos.*', 'empleados.Nombre', 'empleados.Apellido')
            ->get();

        return view('permisos.index', compact('permisos'));
    }

    public function indexEmpleado()
    {
        $empleado = Empleado::All();
        $cargo  = Cargo::All();
        return view('permisos.indexEmpleado', compact('empleado', 'cargo'));
    }

    public function create($empleadoId)
    {
        return view('permisos.crear', compact('empleadoId'));
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
            'motivo' => 'required|string|max:100',
        ]);
        /////////////////////////////////////////////
        $boliviaTime = Carbon::now('America/La_Paz');
        $fecha = $boliviaTime->toDateString();
        /////////////////////////////////////////////
        $permiso = new Permiso();
        $permiso->fecha = $fecha;
        $permiso->fechaInicio = $request->input('fechaInicio');
        $permiso->fechaFin = $request->input('fechaFin');
        $permiso->motivo = $request->input('motivo');
        $permiso->idEmpleado = $request->input('empleadoId');
        $permiso->save();
        $this->addBitacora("Permiso", "Registró");
        return redirect()->route('permisos.index');
    }

    public function edit($id)
    {
        $permisos = Permiso::find($id);
        return view('permisos.editar', compact('permisos'));
    }

    public function showEmpleado($empleadoId)
    {
        $permisos = Permiso::where('idEmpleado', $empleadoId)->get();
        $empleados = Empleado::where('id', $empleadoId)->first(); //solo para una fila
        return view('permisos.showEmpleado', compact('permisos', 'empleados'));
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
            'motivo' => 'required|string|max:100',
        ]);
      

        $permiso = Permiso::find($id);
        $permiso->fechaInicio = $request->input('fechaInicio');
        $permiso->fechaFin = $request->input('fechaFin');
        $permiso->motivo = $request->input('motivo');
        $permiso->save();
        $this->addBitacora("Permiso", "Editó");
        return redirect()->route('permisos.index');
    }

    public function destroy($id)
    {
        $permiso = Permiso::find($id);
        $permiso->delete();
        $this->addBitacora("Permiso", "Eliminó");
        return redirect()->route('permisos.index');
    }

    public function addBitacora($tabla, $accion)
    {
        date_default_timezone_set("America/La_Paz");
        activity()->useLog($tabla)->log($accion)->subject();
    }
}
