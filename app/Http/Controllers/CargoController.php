<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Departamento;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;


class CargoController extends Controller
{
    public function index()
    {
        $cargodepartamentos = DB::table('cargos')
    ->join('departamentos', 'cargos.idDepartamento', '=', 'departamentos.id')
    ->select('cargos.id as idCargo', 'cargos.Nombre as nombreCargo', 'departamentos.id AS idDepartamento', 'departamentos.Nombre AS nombreDepartamento')
    ->orderBy('nombreDepartamento')
    ->get();

        return view('cargos.index', compact('cargodepartamentos'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        return view('cargos.crear', compact('departamentos'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Nombre' => 'required',
            'Descripcion' => 'required',
            'idDepartamento' => 'required',
        ]);

        $cargo = Cargo::create($request->all());

        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Cargo')->log('Registró')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $cargo->id;
        $lastActivity->save();

        return redirect()->route('cargos.index');
    }




    public function edit($id)
    {
        $cargo = Cargo::find($id);
        $departamentos = Departamento::all();
        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Cargo')->log('Editó')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $cargo->id;
        $lastActivity->save();
        return view('cargos.editar', compact('cargo', 'departamentos'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'Nombre' => 'required',
            'Descripcion' => 'required',
        ]);

        $input = $request->all();
        $cargo = Cargo::find($id);
        $cargo->update($input);

        return redirect()->route('cargos.index');
    }


    public function destroy($id)
    {
        $cargo = Cargo::find($id);
    
        if ($cargo) {
            date_default_timezone_set("America/La_Paz");
            activity()->useLog('Cargo')->log('Eliminó')->subject();
            $lastActivity = Activity::latest()->first();
            $subjectId = $cargo->id;
            $lastActivity->subject_id = $subjectId;
            $lastActivity->save();
            $cargo->delete();
        } else {
            return redirect()->route('cargos.index')->with('error', ' no se encontra el cargo');
        }
        return redirect()->route('cargos.index');
    }
    

    /*public function pdf(Personal $personals)
    {

        $empleado = Empleado::all();

        date_default_timezone_set("America/La_Paz");
        activity()->useLog('Empleado')->log('Generó reporte')->subject();
        $lastActivity=Activity::all()->last();
        $lastActivity->subject_id= $empleado->id;
        $lastActivity->save();

        $pdf =PDF::loadView('Empleado.pdf', compact('empleado','empleados'));
        return $pdf->download('Empleado-'.$empleados->id.'.pdf');
    }*/
}
