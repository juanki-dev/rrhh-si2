@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">CREAR CONTRATO</h2>
                        <p class="card-description">Complete el formulario para crear un contrato para un empleado.</p>
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
                        {!! Form::open(['route' => 'contratos.store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            <label for="idEmpleado">Seleccionar Empleado</label>
                            <select name="idEmpleado" class="form-control" id="idEmpleado">
                                @foreach ($empleados as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->Nombre }} {{ $emp->Apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="idCargo">Seleccionar Cargo</label>
                            <select name="idCargo" class="form-control" id="idCargo">
                                @foreach ($cargos as $car)
                                    <option value="{{ $car->id }}">{{ $car->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="idHorario">Seleccionar Horario</label>
                            <select name="idHorario" class="form-control" id="idHorario">
                                @foreach ($horarios as $hor)
                                    <option value="{{ $hor->id }}">{{ $hor->hora_ini }} a {{ $hor->hora_fin }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sueldo">Sueldo</label>
                            {!! Form::number('sueldo', null, ['class' => 'form-control', 'id' => 'sueldo', 'placeholder' => 'Sueldo']) !!}
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo de contrato</label>
                            {!! Form::select('tipo', ['Temporal' => 'Temporal', 'Indefinido' => 'Indefinido'], null, [
                                'class' => 'form-control',
                                'id' => 'tipo',
                                'placeholder' => 'Selecciona el tipo de contrato',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de Inicio</label>
                            {!! Form::date('fecha_inicio', null, [
                                'class' => 'form-control',
                                'id' => 'fecha_inicio',
                                'placeholder' => 'Fecha de Inicio',
                            ]) !!}
                        </div>
                        <div class="form-group" id="fechaFinContainer">
                            <label for="fecha_fin">Fecha Fin</label>
                            {!! Form::date('fecha_fin', null, [
                                'class' => 'form-control',
                                'id' => 'fecha_fin',
                                'placeholder' => 'Fecha Fin',
                                'disabled' => true,// Deshabilita el campo por defecto
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="tipo_pago">Tipo de Pago</label>
                            {!! Form::select(
                                'tipo_pago',
                                [
                                    'Mensual' => 'Mensual',
                                    'Quincenal' => 'Quincenal',
                                    'Semanal' => 'Semanal',
                                    'Diario' => 'Diario',
                                ],
                                null,
                                [
                                    'class' => 'form-control',
                                    'id' => 'tipo_pago',
                                    'placeholder' => 'Selecciona el tipo de pago',
                                ],
                            ) !!}
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                        <button class="btn btn-light">Cancelar</button>
                        {!! Form::close() !!}

                        <script>
                            $(document).ready(function() {
                                // Oculta inicialmente el campo fecha_fin
                                $('#fechaFinContainer').hide();

                                // Escucha cambios en el campo tipo
                                $('#tipo').change(function() {
                                    // Si el valor es 'Indefinido', muestra el campo fecha_fin, de lo contrario, ocúltalo y deshabilítalo
                                    if ($(this).val() === 'Indefinido') {
                                        $('#fechaFinContainer').hide().find('input').prop('disabled', true);
                                    } else {
                                        $('#fechaFinContainer').show().find('input').prop('disabled', false);
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
