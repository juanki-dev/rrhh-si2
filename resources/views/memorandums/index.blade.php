@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="page__heading">MEMORANDUMS</h3>
                        <a class="btn btn-dark ml-auto" href="{{ route('memorandums.create') }}">Nuevo</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Asunto</th>
                                    <!-- <th>Cargo</th> -->
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <!-- <th>Fecha fin</th> -->
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($memorandum as $memorandums)
                                <tr>
                                    <td>{{ $memorandums->id }}</td>
                                    <td>{{ $memorandums->subject }}</td>
                                    
                                    <td>{{ date('d-m-Y', strtotime($memorandums->date)) }}</td>                               
                                    <td>{{ date('H:i:s', strtotime($memorandums->time)) }}</td> 
                                    <td>
                                        <a class="btn btn-success" href="{{ route('memorandums.show', $memorandums) }}">Ver</a>
                                        <a class="btn btn-primary" href="{{ route('memorandums.edit', $memorandums->id) }}">Editar</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['memorandums.destroy', $memorandums->id], 'style' => 'display:inline']) !!}
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
