@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">ASIGNAR AGUINALDO</h2>
                        <p class="card-description">Detalles del aguinaldo</p>
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
                        {!! Form::open(['route' => 'aguinaldos.store', 'method' => 'POST']) !!}
                        @csrf
                        <input type="hidden" name="idEmpleado" value="{{ $empleadoId }}">

                        <div class="form-group">
                            <label for="asunto">Comentarios</label>
                            {!! Form::textarea('asunto', null,  ['class' => 'form-control', 'id' => 'asunto', 'placeholder' => 'Felices fiestas']) !!}
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>    
                        <a class="btn btn-light" href="{{ route('aguinaldo.indexEmpleado') }}">Cancelar </a>     
                        {!! Form::close() !!}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
