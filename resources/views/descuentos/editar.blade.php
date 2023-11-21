@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">EDITAR DESCUENTOS</h4>
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

                    {!! Form::model($descuentos, ['method' => 'PATCH','route' => ['descuentos.update', $descuentos->id]]) !!}

                    {{-- EDITAR------------- --}}
                    <div class="form-group">
                        <label for="monto">Monto</label>
                        {!! Form::number('monto', null, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="motivo">Motivo</label>
                                {!! Form::textarea('motivo', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observacion">Observacion</label>
                                {!! Form::textarea('observacion', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 my-4">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a class="btn btn-light" href="{{ route('descuentos.index') }}">Cancelar </a>     
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
