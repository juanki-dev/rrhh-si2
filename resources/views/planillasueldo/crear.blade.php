@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">CREAR PLANILLA</h2>
                        <p class="card-description">Complete el formulario para crear una planilla.</p>
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
                        {!! Form::open(['route' => 'planillasueldos.store', 'method' => 'POST']) !!}       
                        <div class="form-group">


                            <label for="fecha">Fecha</label>
                            {!! Form::date('fecha', null, [
                                'class' => 'form-control',
                                'id' => 'fecha',
                                'placeholder' => 'Fecha',
                            ]) !!}
                

                            <label for="tipo">Tipo de Pago</label>
                            {!! Form::select(
                                'tipo',
                                [
                                    'Mensual' => 'Mensual',
                                    'Quincenal' => 'Quincenal',
                                    'Semanal' => 'Semanal',
                                    'Diario' => 'Diario',
                                ],
                                null,
                                [
                                    'class' => 'form-control',
                                    'id' => 'tipo',
                                    'placeholder' => 'Selecciona el tipo de pago',
                                ],
                            ) !!}
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                        <a class="btn btn-light" href="{{ route('planillasueldos.index') }}">Cancelar </a>  
                        {!! Form::close() !!}

                       <!--  <script>
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
                        </script> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
