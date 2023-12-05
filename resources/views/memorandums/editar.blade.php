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

                    {!! Form::model($memorandums, ['method' => 'PATCH','route' => ['memorandums.update', $memorandums->id]]) !!}

                    {{-- EDITAR------------- --}}
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

                    <div class="col-xs-12 col-sm-12 col-md-12 my-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a class="btn btn-light" href="{{ route('memorandums.index') }}">Cancelar </a>     
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
