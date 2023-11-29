@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="page__heading">RECLUTAMIENTOS</h3>
                        <a class="btn btn-dark ml-auto" href="{{ route('reclutamientos.create') }}">Nuevo</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Cargo</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reclutamiento as $reclutamientos)
                                <tr>
                                    <td>{{ $reclutamientos->id }}</td>
                                    <td>{{ $reclutamientos->nombre }}</td>
                                    <td>@foreach ($cargo as $cargos)
                                        @if($cargos->id==$reclutamientos->idCargo)
                                        {{$cargos->Nombre}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>{{ date('d-m-Y', strtotime($reclutamientos->fechainicio)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($reclutamientos->fechafin)) }}</td>                                  
                                  
                                    <td>
                                        <a class="btn btn-success" href="{{ route('reclutamientos.show', $reclutamientos) }}">Ver</a>
                                        <a class="btn btn-primary" href="{{ route('reclutamientos.edit', $reclutamientos->id) }}">Editar</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['reclutamientos.destroy', $reclutamientos->id], 'style' => 'display:inline']) !!}
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
