@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">CREAR HORAS EXTRAS</h2>
                        <p class="card-description">Complete el formulario para registrar horas extras.</p>
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
                        {!! Form::open(['route' => 'horas.store', 'method' => 'POST']) !!}
                        @csrf
                        <input type="hidden" name="idEmpleado" value="{{ $empleadoId }}">

                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            {!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'fecha']) !!}
                        </div>
                        <div class="form-group">
                            <label for="cantidad_hora">Cantidad de Horas</label>
                            {!! Form::number('cantidad_hora', null,  ['class' => 'form-control', 'id' => 'cantidad_hora', 'placeholder' => 'Cantidad de Horas','step' => '0.01']) !!}
                        </div>
                        {{--<div class="form-group">
                            <label for="idContrato">Contrato</label>
                            {!! Form::select('idContrato', $contratos, null, ['class' => 'form-control', 'id' => 'idContrato', 'placeholder' => 'Seleccionar Contrato']) !!}
                        </div>--}}
                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>    
                        <a class="btn btn-light" href="{{ route('hora.indexEmpleado') }}">Cancelar </a>     
                        {!! Form::close() !!}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
