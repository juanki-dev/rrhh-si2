@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="page__heading">HORARIOS</h3>
                        <a class="btn btn-dark ml-auto" href="{{ route('horarios.create') }}">Nuevo</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Empleado</th>
                                    <th>Cargo</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($horario as $horarios)
                                <tr>
                                    @foreach ($empleado as $empleados)
                                            @if ($empleados->id == $horarios->idEmpleado)
                                                <td>{{ $empleados->Nombre }} {{ $empleados->Apellido }}</td>
                                            @endif
                                    @endforeach
                                    @foreach ($cargo as $cargos)
                                            @if ($cargos->id == $horarios->idCargo)
                                                <td>{{ $cargos->Nombre }}</td>
                                            @endif
                                    @endforeach
                                    <td>{{ $horarios->HoraEntrada }}</td>
                                    <td>{{ $horarios->HoraSalida }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('horarios.edit', $horarios->id) }}">Editar</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['horarios.destroy', $horarios->id], 'style' => 'display:inline']) !!}
                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
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
