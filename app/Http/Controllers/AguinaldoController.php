<?php

namespace App\Http\Controllers;

use App\Models\Aguinaldo;
use App\Models\Empleado;
use App\Models\Cargo;
use App\Models\Contrato;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Spatie\Activitylog\Models\Activity;
use PDF;

class AguinaldoController extends Controller
{
    //
    //
    public function index()
    {
        $aguinaldos = DB::table('aguinaldos')
            ->join('empleados', 'aguinaldos.idEmpleado', '=', 'empleados.id')
            ->select('aguinaldos.*', 'empleados.Nombre', 'empleados.Apellido')
            ->get();
        return view('aguinaldos.index', compact('aguinaldos'));
    }

    public function indexEmpleado(){//el foreach para listar
        $aguinaldo = Aguinaldo::All();
        $contrato = Contrato::All();
        $cargo = Cargo::All();
        // dd($cargo);
        //Filtro los que no tienen aguinaldo este año
        $empleadoSinFiltrar = Empleado::whereDoesntHave('aguinaldos', function ($query) {
            $query->whereYear('fecha', now()->year);
        })->get();
        
        // dd($empleadoSinFiltrar);

        $empleado = [];

        // aquellos que tengan >= 90 dias trabajados
        foreach($empleadoSinFiltrar as $empleados){
            $dias = 0;
            foreach($contrato as $contratos){
                if($contratos->idEmpleado == $empleados->id){//los contratos de ese empleado
                    //==========================================================================
                    // Calcular los dias del contrato dentro de este año, 
                    $inicio = strtotime($contratos->fecha_inicio);
                    $ahora = strtotime(now());
                    $fin = $ahora;
                    
                    $primerDiaDelAnio = strtotime(date('Y-01-01'));
                    $ultimoDiaDelAnio = strtotime(date('Y-12-31'));

                    if($contratos->tipo == "Temporal"){
                        $fin = strtotime($contratos->fecha_fin);
                    }
                    if($contratos->estado == "Inactivo"){
                        $fin = strtotime($contratos->updated_at);
                    }
                    if($fin >= $ahora){//en caso de que en temporal la fecha fin acabe mas adelante que ahora
                        $fin = $ahora;
                    }
                    
                    if($inicio <= $primerDiaDelAnio && $fin >= $primerDiaDelAnio){
                        $inicio =  $primerDiaDelAnio;
                    }
                    //===============================================================================
                    //solo toma en cuenta dias de este año
                    if($inicio >= $primerDiaDelAnio && $inicio <= $ultimoDiaDelAnio && $fin >= $primerDiaDelAnio && $fin <= $ultimoDiaDelAnio && $inicio <= $fin){
                        $diferenciaDias = floor(($fin - $inicio + 1) / (60 * 60 * 24)) ;
                        $dias += $diferenciaDias;
                    } 
                }
            }
            if($dias >= 90){
                $empleado[] = $empleados;
            }
        }
        return view('aguinaldos.indexEmpleado', compact('empleado', 'contrato', 'cargo', 'aguinaldo'));
    }

    public function showEmpleado($empleadoId)
    {
        $aguinaldos = Aguinaldo::where('idEmpleado', $empleadoId)->get();
        // dd($aguinaldos);
        $empleados = Empleado::where('id', $empleadoId)->first(); //solo para una fila
        return view('aguinaldos.showEmpleado', compact('aguinaldos', 'empleados'));
    }

    public function create($empleadoId)
    {
        return view('aguinaldos.crear', compact('empleadoId'));
    }

    private function calcularMonto($contrato, $empleados)
    {
        $sum = 0;
        $diasTotales = 0;
        $dias = 0;
        foreach($contrato as $contratos){
            if($contratos->idEmpleado == $empleados->id){//los contratos de ese empleado
                //==========================================================================
                // Calcular los dias del contrato dentro de este año, 
                $inicio = strtotime($contratos->fecha_inicio);
                $ahora = strtotime(now());
                $fin = $ahora;
                
                $primerDiaDelAnio = strtotime(date('Y-01-01'));
                $ultimoDiaDelAnio = strtotime(date('Y-12-31'));

                if($contratos->tipo == "Temporal"){
                    $fin = strtotime($contratos->fecha_fin);
                }
                if($contratos->estado == "Inactivo"){
                    $fin = strtotime($contratos->updated_at);
                }
                if($fin >= $ahora){//en caso de que en temporal la fecha fin acabe mas adelante que ahora
                    $fin = $ahora;
                }
                
                if($inicio <= $primerDiaDelAnio && $fin >= $primerDiaDelAnio){
                    $inicio =  $primerDiaDelAnio;
                }
                //===============================================================================
                //solo toma en cuenta dias de este año
                if($inicio >= $primerDiaDelAnio && $inicio <= $ultimoDiaDelAnio && $fin >= $primerDiaDelAnio && $fin <= $ultimoDiaDelAnio && $inicio <= $fin){
                    $dias = floor(($fin - $inicio + 1) / (60 * 60 * 24)) ;
                    //sum = sum + (dias/tipo) * sueldo + (dias%tipo) * (sueldo/tipo);
                    $tipo = 1;
                    switch ($contratos->tipo_pago) {
                        case 'Quincenal':
                            $tipo = 15;
                            break;
                        case 'Mensual':
                            $tipo = 30;
                            break;
                        case 'Semanal':
                            $tipo = 7;
                            break;
                        case 'Diario':
                            $tipo = 1;
                            break;            
                    }
                    $sueldo = $contratos->sueldo;
                    $diasTotales = $diasTotales + $dias;
                    $sum = $sum + ($dias/$tipo) * $sueldo + ($dias % $tipo) * ($sueldo / $tipo);
                } 
            }
        }
        $sum = $sum / 360 * $diasTotales;//SP o salario promedio 
        return $sum;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //  'fecha' => 'required',
            //  'hora' => 'required',
            //  'monto' => 'required',
            //   'idEmpleado' => 'required',
        ]);

        // $contratosTodos = Contrato::All();
        $contratos = Contrato::where('idEmpleado', $request->input('idEmpleado'))->get();
        $empleado = Empleado::where('id', $request->input('idEmpleado'))->first();
        
        $montoAguinaldo = $this -> calcularMonto($contratos, $empleado);
        // dd($montoAguinaldo);
        /////////////////////////////////////////////
        $boliviaTime = Carbon::now('America/La_Paz');
        $fecha = $boliviaTime->toDateString();
        $hora = $boliviaTime->toTimeString();
        /////////////////////////////////////////////
        $aguinaldo = new Aguinaldo();
        $aguinaldo->fecha = $fecha;
        $aguinaldo->hora =  $hora;
        $aguinaldo->monto = $montoAguinaldo;
        $aguinaldo->idEmpleado = $request->input('idEmpleado');
        $aguinaldo->dias = 0;
        $aguinaldo->save();

        $this->addBitacora("Aguinaldo", "Registró");
        return redirect()->route('aguinaldo.indexEmpleado');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fecha' => 'required',
            'monto' => 'required',
        ]);
        
        $aguinaldo = Aguinaldo::find($id);
        $aguinaldo->monto = $request->input('monto');
        $aguinaldo->save();
        
        $this->addBitacora("Aguinaldo", "Editó");
        return redirect()->route('aguinaldos.index');
    }

    public function show($id)
    {
        $aguinaldo = DB::table('aguinaldos')
            ->join('empleados', 'aguinaldos.idEmpleado', '=', 'empleados.id')
            ->select('aguinaldos.*', 'empleados.Nombre', 'empleados.Apellido')
            ->where('aguinaldos.id', $id)
            ->first();
        
        return view('aguinaldos.show', compact('aguinaldo'));
    }

    public function edit($id)
    {
        $aguinaldos = Aguinaldo::find($id);
        return view('aguinaldos.editar', compact('aguinaldos'));
    }

    public function destroy($id) //SOLO ANULARA
    {

        $aguinaldo = Aguinaldo::find($id);
        $aguinaldo->estado = 2;
        $aguinaldo->observacion = "ANULADO";
        $aguinaldo->save();
        $this->addBitacora("Aguinaldo", "Anuló");
        return redirect()->route('aguinaldos.index');
    }

    public function addBitacora($tabla, $accion)
    {
        date_default_timezone_set("America/La_Paz");
        activity()->useLog($tabla)->log($accion)->subject();
    }

}
