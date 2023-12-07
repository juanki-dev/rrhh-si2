@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="page__heading">ASIGNAR AGUINALDO</h3>
                            <a class="btn btn-dark ml-auto" href="{{ route('aguinaldos.index') }}">Atras </a>
                        </div>
                        <div class="table-responsive">
                           
                            <table class="table">
                                <h3 class="page__heading">Empleados</h3>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Cargo</th>
                                        <th>Sueldo</th>
                                        <th>Contrato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleado as $empleados)
                                        <tr>
                                            <td>{{ $empleados->id }}</td>
                                            <td>{{ $empleados->Nombre }}</td>
                                            <td>{{ $empleados->Apellido }}</td>
                                            @foreach ($contrato as $contratos)
                                                @foreach($cargo as $cargos)
                                                    @if ($contratos->idCargo == $cargos->id && $contratos->idEmpleado == $empleados->id)
                                                        <td>{{ $cargos->Nombre }}</td>
                                                        <td>{{ $contratos->sueldo}}</td>
                                                        <td>{{ $contratos->tipo_pago}}</td>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            
                                            {{-- @foreach ($aguinaldo as $aguinaldos)
                                                @if($aguinaldos->idEmpleado != $empleados->id)
                                                    @if($date('Y', strtotime(now())) != $date('Y', strtotime($aguinaldos->date) ))
                                                        <td>
                                                            <a class="btn btn-dark ml-auto"  href="{{ route('aguinaldo.verEmpleado', ['id' => $empleados->id]) }}">Ver Aguinaldos21</a>
                                                        </td>
                                                    @endif
                                                @endif
                                            @endforeach --}}
                                            
                                            <td>
                                                <a class="btn btn-success"  href="{{ route('aguinaldo.create', ['id' => $empleados->id]) }}">Asignar</a>
                                                <a class="btn btn-dark ml-auto"  href="{{ route('aguinaldo.verEmpleado', ['id' => $empleados->id]) }}">Ver Aguinaldos21</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
