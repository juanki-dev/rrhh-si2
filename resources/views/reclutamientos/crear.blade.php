@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">CREAR RECLUTAMIENTOS</h2>
                    <p class="card-description">Complete el formulario para crear un Reclutamiento.</p>
                    @if ($errors->any())
                    <div class="alert alert-dark alert-dismissible fade show" role="alert">
                        <strong>¡Revise los campos!</strong>
                        @foreach ($errors->all() as $error)
                        <span class="badge badge-danger">{{ $error }}</span>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    {!! Form::open(array('route' => 'reclutamientos.store', 'method' => 'POST')) !!}
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        {!! Form::text('nombre', null, array('class' => 'form-control', 'id' => 'nombre', 'placeholder' => 'Nombre')) !!}
                    </div>
                    <div class="form-group">
                        <label for="fechainicio">Fecha Inicio</label>
                        {!! Form::date('fechainicio', null, array('class' => 'form-control', 'id' => 'fechainicio', 'placeholder' => 'Año Mes Dia')) !!}
                    </div>
                    <div class="form-group">
                        <label for="fechafin">Fecha Fin</label>
                        {!! Form::date('fechafin', null, array('class' => 'form-control', 'id' => 'fechafin', 'placeholder' => 'Año mes Dia')) !!}
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        {!! Form::text('descripcion', null, array('class' => 'form-control', 'id' => 'descripcion', 'placeholder' => 'Descripcion')) !!}
                    </div>
                    <div class="form-group">
                        <label for="idCargo">Seleccionar Cargo</label>
                        <select name="idCargo" class="form-control" id="idCargo">
                            @foreach ($cargo as $cargos)
                            <option value="{{ $cargos->id }}">{{ $cargos->Nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                    <button class="btn btn-light">Cancelar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection