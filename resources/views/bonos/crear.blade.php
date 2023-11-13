@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">CREAR BONO</h2>
                        <p class="card-description">Complete el formulario para crear un bono.</p>
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
                        {!! Form::open(['route' => 'bonos.store', 'method' => 'POST']) !!}
                        @csrf
                        <input type="hidden" name="empleadoId" value="{{ $empleadoId }}">

                        <div class="form-group">
                            <label for="monto">Monto</label>
                            {!! Form::number('monto', null,  ['class' => 'form-control', 'id' => 'monto', 'placeholder' => 'Monto','step' => '0.01']) !!}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="motivo">Motivo</label>
                                    {!! Form::textarea('motivo', null, ['class' => 'form-control', 'id' => 'motivo', 'placeholder' => 'Motivo']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="observacion">Observacion</label>
                                    {!! Form::textarea('observacion', null, ['class' => 'form-control', 'id' => 'observacion', 'placeholder' => 'Observacion']) !!}
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>    
                        <a class="btn btn-light" href="{{ route('bono.indexEmpleado') }}">Cancelar </a>     
                        {!! Form::close() !!}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
