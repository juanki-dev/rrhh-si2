@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">CREAR HORARIO</h4>
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

                    {!! Form::model($horario, ['method' => 'PATCH', 'route' => ['horarios.update', $horario->id]]) !!}
                    <div class="form-group">
                        <label for="idEmpleado">Seleccionar Empleado:</label>
                        <select name="idEmpleado" class="form-control" id="idEmpleado">
                            @foreach ($empleado as $empleados)
                                <option value="{{ $empleados->id }}">{{ $empleados->Nombre }} {{ $empleados->Apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idCargo">Seleccionar Cargo:</label>
                        <select name="idCargo" class="form-control" id="idEmpleado">
                            @foreach ($cargo as $cargos)
                                <option value="{{ $cargos->id }}">{{ $cargos->Nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Hora">Hora Entrada</label>
                        {!! Form::select('HoraEntrada', ['8:30' => '8:30', '09:30' => '9:30'], null, ['class' => 'form-control', 'id' => 'Hora']) !!}
                    </div>
                    <div class="form-group">
                        <label for="Hora">Hora Salida</label>
                        {!! Form::select('HoraSalida', ['16:30' => '16:30', '18:30' => '18:30'], null, ['class' => 'form-control', 'id' => 'Hora']) !!}
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
