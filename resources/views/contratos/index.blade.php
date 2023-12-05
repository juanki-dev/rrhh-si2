@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h3 class="card-title">CONTRATOS</h3>
                <div class="d-flex align-items-center">
                    <a class="btn btn-dark" href="{{ route('contratos.create') }}">Nuevo</a>
                </div>

            </div>
        </div>

        <div class="row" id="employee-container">
            @foreach ($empleadocontratos as $empleados)
                <div class="col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Contrato:</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID:</th>
                                        <td>{{ $empleados->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nombres:</th>
                                        <td>{{ $empleados->NombreEmpleado }}</td>
                                    </tr>
                                    <tr>
                                        <th>Apellidos:</th>
                                        <td>{{ $empleados->ApellidoEmpleado }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sueldo:</th>
                                        <td>{{ $empleados->sueldo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de inicio:</th>
                                        <td>{{ $empleados->fecha_inicio }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha fin:</th>
                                        <td>{{ $empleados->fecha_fin ? $empleados->fecha_fin : 'Indefinido' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Horario:</th>
                                        <td>{{ $empleados->hora_ini }} a {{ $empleados->hora_fin }}</td>
                                    </tr>
                                    <tr>
                                        <th>Departamento:</th>
                                        <td>{{ $empleados->departamentoNombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cargo:</th>
                                        <td>{{ $empleados->cargoNombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Estado:</th>
                                        <td>{{ $empleados->estado }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-primary mx-2"
                                        href="{{ route('contratos.edit', $empleados->id) }}">Editar</a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['contratos.destroy', $empleados->id],
                                        'style' => 'display:inline',
                                    ]) !!}
                                    {{-- {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!} --}}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
