@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">CREAR ASISTENCIA</h2>
                        <p class="card-description">Complete el formulario para crear un empleado.</p>
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
                        {!! Form::open(['route' => 'asistencias.store2', 'method' => 'POST']) !!}
                        <div class="form-group">
                            <label for="empleadoId">Seleccionar Empleado</label>
                            <select name="empleadoId" class="form-control" id="empleadoId">
                                @foreach ($empleados as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->Nombre }} {{ $emp->Apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hora_entrada">Hora Entrada</label>
                            {!! Form::time('hora_entrada', null, [
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                        </div>

                        <div class="form-group">
                            <label for="hora_salida">Hora Salida</label>
                            {!! Form::time('hora_salida', null, [
                                'class' => 'form-control',
                                'required' => 'required',
                            ]) !!}
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                        <button class="btn btn-light">Cancelar</button>
                        {!! Form::close() !!}

                        {{-- <script>
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
                        </script> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
