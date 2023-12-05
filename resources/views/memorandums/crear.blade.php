@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">CREAR MEMORANDUMS</h2>
                        <p class="card-description">Complete el formulario para crear un memorandum.</p>
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
                        {!! Form::open(['route' => 'memorandums.store', 'method' => 'POST']) !!}
                        @csrf
                        <input type="hidden" name="empleadoId" value="{{ $empleadoId }}">

                        <div class="form-group">
                            <label for="asunto">Asunto</label>
                            {!! Form::textarea('asunto', null,  ['class' => 'form-control', 'id' => 'asunto', 'placeholder' => 'Asunto']) !!}
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="contenido">Contenido</label>
                                    {!! Form::textarea('contenido', null, ['class' => 'form-control', 'id' => 'contenido', 'placeholder' => 'Contenido']) !!}
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>    
                        <a class="btn btn-light" href="{{ route('memorandum.indexEmpleado') }}">Cancelar </a>     
                        {!! Form::close() !!}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
