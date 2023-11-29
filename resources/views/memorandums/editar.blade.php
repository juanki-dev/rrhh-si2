@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">EDITAR MEMORANDUMS</h4>
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

                    {!! Form::model($memorandum, ['method' => 'PATCH','route' => ['memorandums.update', $memorandum->id]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="subject">Asunto</label>
                                {!! Form::text('subject', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>                    
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                            <div class="form-group">
                                <label for="date">Fecha</label>
                                {!! Form::text('date', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        
                        

                    <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                        <label for="time">Hora</label>
                        {!! Form::time('time', null, array('class' => 'form-control', 'id' => 'time', 'placeholder' => 'Hora')) !!}
                    </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="body">Contenido</label>
                                    {!! Form::textarea('body', null, array('class' => 'form-control', 'id' => 'body', 'placeholder' => 'Contenido')) !!}
                                </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 my-4">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-light" href="{{ route('memorandums.index') }}">Cancelar </a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
