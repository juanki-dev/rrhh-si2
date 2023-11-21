@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">CREAR ENTREVISTAS</h2>
                    <p class="card-description">Complete el formulario para crear una entrevista.</p>
                    
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

                    {!! Form::open(array('route' => 'entrevistas.store', 'method' => 'POST')) !!}
                    
                    <div class="form-group">
                        <label for="idEmpleado">Seleccionar Entrevistador:</label>
                        <select name="idEmpleado" class="form-control" id="idEmpleado">
                            @foreach ($empleado as $empleados)
                                <option value="{{ $empleados->id }}">{{ $empleados->Nombre }} {{ $empleados->Apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="Fecha">Fecha</label>
                        {!! Form::date('Fechainicio', null, array('class' => 'form-control', 'id' => 'Fecha')) !!}
                    </div>
                    
                    <div class="form-group">
                        <label for="Hora">Hora</label>
                        {!! Form::select('Hora', ['8:30' => '8:30', '09:30' => '9:30'], null, ['class' => 'form-control', 'id' => 'Hora']) !!}
                    </div>

                    <div class="form-group">
                        <label for="idPostulante">Seleccionar Postulante:</label>
                        <select name="idPostulante" class="form-control" id="idPostulante">
                            @foreach ($postulante as $postulantes)
                                <option value="{{ $postulantes->id }}">{{ $postulantes->Nombre }} {{ $postulantes->Apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="Comentario">Comentario</label>
                        {!! Form::textarea('Comentario', null, array('class' => 'form-control', 'id' => 'Comentario', 'placeholder' => 'Comentario')) !!}
                    </div>
                    
                    <div class="form-group">
                        <label for="Calificacion">Calificación</label>
                        {!! Form::select('Calificacion', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], null, array('class' => 'form-control', 'id' => 'Calificacion')) !!}
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
