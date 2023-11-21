@extends('layouts.estilo')

@section('tabla')

<div class="content-wrapper">
<div class="card mb-3">
<div class="card-body d-flex justify-content-between align-items-center">
    <h3 class="card-title">Entrevistas</h3>
    <div class="d-flex align-items-center">
        <a class="btn btn-dark" href="{{ route('entrevistas.create') }}">Nuevo</a>
    </div>

</div>
</div>

<div class="row" id="employee-container">
    @foreach ($entrevista as $entrevistas)
    <div class="col-lg-4 mb-3">
        <div class="card">
            <div class="card-body">
                        <h4 class="card-title">Entrevista:</h4>
                        <table class="table">
                            <tbody>
                                <th>Entrevistador:</th>
                                    <td>
                                        @foreach ($empleado as $empleados)
                                        @if ($empleados->id == $entrevistas->idEmpleado)
                                        {{ $empleados->Nombre }} {{ $empleados->Apellido }}
                                        @endif
                                        @endforeach
                                    </td>
                                <tr>
                                    <th>Fecha:</th>
                                    <td>{{ $entrevistas->Fechainicio }}</td>
                                </tr>
                                <tr>
                                    <th>Hora:</th>
                                    <td>{{ $entrevistas->Hora }}</td>
                                </tr>
                                <th>Postulante:</th>
                                    <td>
                                        @foreach ($postulante as $postulantes)
                                        @if ($postulantes->id == $entrevistas->idPostulante)
                                        {{ $postulantes->Nombre }} {{ $postulantes->Apellido }}
                                        @endif
                                        @endforeach
                                    </td>
                                <tr>
                                <tr>
                                    <th>Calificacion:</th>
                                    <td>{{ $entrevistas->Calificacion }}</td>
                                </tr>
                                <tr>
                                <th>Comentario:</th>
                                <td>{{ $entrevistas->Comentario }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                        <div class="d-flex justify-content-center">
                        <a class="btn btn-primary mx-2" href="{{ route('entrevistas.edit', $entrevistas->id) }}">Editar</a>
        
                            <div class="mx-2"></div>
        
                        {!! Form::open(['method' => 'DELETE', 'route' => ['entrevistas.destroy', $entrevistas->id],
                        'style' => 'display:inline']) !!}
                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
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