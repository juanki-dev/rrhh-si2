@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="page__heading">ASIGNAR PERMISOS</h3>
                            <a class="btn btn-dark ml-auto" href="{{ route('permisos.index') }}">Atras </a>
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
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleado as $empleados)
                                        <tr>
                                            <td>{{ $empleados->id }}</td>
                                            <td>{{ $empleados->Nombre }}</td>
                                            <td>{{ $empleados->Apellido }}</td>
                                            <td>
                                                @foreach ($cargo as $cargos)
                                                    @if ($cargos->id == $empleados->idCargo)
                                                        {{ $cargos->Nombre }}
                                                    @endif
                                                @endforeach
                                            </td>                
                                            <td>
                                                <a class="btn btn-success"  href="{{ route('permiso.create', ['id' => $empleados->id]) }}">Asignar</a>
                                                <a class="btn btn-dark ml-auto"  href="{{ route('permiso.verEmpleado', ['id' => $empleados->id]) }}">Ver Permisos</a>
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
