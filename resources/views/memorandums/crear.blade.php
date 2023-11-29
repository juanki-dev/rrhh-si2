@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">CREAR MEMORANDUMS</h2>
                    <p class="card-description">Complete el formulario para crear un Memorandum.</p>
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
                    {!! Form::open(array('route' => 'memorandums.store', 'method' => 'POST')) !!}
                    <div class="form-group">
                        <label for="subject">Asunto</label>
                        {!! Form::text('subject', null, array('class' => 'form-control', 'id' => 'subject', 'placeholder' => 'Asunto')) !!}
                    </div>
                    <div class="form-group">
                        <label for="date">Fecha</label>
                        {!! Form::date('date', null, array('class' => 'form-control', 'id' => 'date', 'placeholder' => 'Año Mes Dia')) !!}
                    </div>
                    <div class="form-group">
                        <label for="time">Hora</label>
                        {!! Form::time('time', null, array('class' => 'form-control', 'id' => 'time', 'placeholder' => 'HH:mm:ss')) !!}
                    </div>
                    <div class="col-md">
                            <div class="form-group">
                                <label for="body">Contenido</label>
                                {!! Form::textarea('body', null, array('class' => 'form-control', 'id' => 'body', 'placeholder' => 'Contenido')) !!}
                            </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                    <a class="btn btn-light" href="{{ route('memorandums.index') }}">Cancelar </a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection