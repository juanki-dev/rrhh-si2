@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="page__heading">ASIGNAR MEMORANDUM</h3>
                            <a class="btn btn-dark ml-auto" href="{{ route('memorandums.index') }}">Atras </a>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleado as $empleados)
                                        <tr>
                                            <td>{{ $empleados->id }}</td>
                                            <td>{{ $empleados->Nombre }}</td>
                                            <td>{{ $empleados->Apellido }}</td>
                                            <td>
                                                @foreach ($contrato as $contratos)
                                                    @foreach($cargo as $cargos)
                                                        @if ($contratos->idCargo == $cargos->id && $contratos->idEmpleado == $empleados->id)
                                                            {{ $cargos->Nombre }}
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </td>                
                                            <td>
                                                <a class="btn btn-success"  href="{{ route('memorandum.create', ['id' => $empleados->id]) }}">Asignar</a>
                                                <a class="btn btn-dark ml-auto"  href="{{ route('memorandum.verEmpleado', ['id' => $empleados->id]) }}">Ver Memorandums</a>
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
