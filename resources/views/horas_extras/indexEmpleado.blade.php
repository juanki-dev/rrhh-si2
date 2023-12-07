@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="page__heading">ASIGNAR HORAS EXTRAS</h3>
                            <a class="btn btn-dark ml-auto" href="{{ route('horas.index') }}">Atrás</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <h3 class="page__heading">Empleados</h3>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($empleados as $empleado)
                                        <tr>
                                            <td>{{ $empleado->id }}</td>
                                            <td>{{ $empleado->Nombre }}</td>
                                            <td>{{ $empleado->Apellido }}</td>
                                            <td>
                                                {{--<td>
                                                    @foreach ($cargo as $cargos)
                                                        @if ($cargos->id == $empleado->idCargo)
                                                            {{ $cargos->Nombre }}
                                                        @endif
                                                    @endforeach
                                                </td>--}}
                                                <a class="btn btn-success" href="{{ route('hora.create', ['id' => $empleado->id]) }}">Asignar</a>
                                                <a class="btn btn-dark ml-auto" href="{{ route('hora.verEmpleado', ['id' => $empleado->id]) }}">Ver Horas Extras</a>
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
