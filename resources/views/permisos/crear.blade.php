@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">CREAR PERMISOS</h2>
                        <p class="card-description">Complete el formulario para crear una vacacion</p>
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
                        {!! Form::open(['route' => 'permisos.store', 'method' => 'POST']) !!}
                        @csrf
                        <input type="hidden" name="empleadoId" value="{{ $empleadoId }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monto">Fecha Inicio</label>
                                    {!! Form::date('fechaInicio', null, ['class' => 'form-control', 'id' => 'fechaInicio']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="monto">Fecha Fin</label>
                                    {!! Form::date('fechaFin', null, ['class' => 'form-control', 'id' => 'fechaFin']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Motivo</label>
                            {!! Form::textarea('motivo', null, [
                                'class' => 'form-control',
                                'id' => 'motivo',
                                'placeholder' => 'motivo',
                            ]) !!}
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                        <a class="btn btn-light" href="{{ route('permiso.indexEmpleado') }}">Cancelar </a>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
