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
                                    <th>ID</th>
                                    <th>Hora de Inicio</th>
                                    <th>Hora de Salida</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($horario as $horarios)
                                <tr>
                                    <td>{{ $horarios->id }}</td>
                                    <td>{{ $horarios->hora_ini }}</td>
                                    <td>{{ $horarios->hora_fin }}</td>
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
