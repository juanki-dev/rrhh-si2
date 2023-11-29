@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">EDITAR PERMISO</h4>
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

                    {!! Form::model($permisos, ['method' => 'PATCH','route' => ['permisos.update', $permisos->id]]) !!}

                    {{-- EDITAR------------- --}}

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
                    <div class="col-xs-12 col-sm-12 col-md-12 my-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a class="btn btn-light" href="{{ route('permisos.index') }}">Cancelar </a>     
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
