@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">EDITAR EMPLEADOS</h4>
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

                        {!! Form::model($empleado, ['method' => 'PATCH', 'route' => ['empleados.update', $empleado->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Nombre">Nombre</label>
                                    {!! Form::text('Nombre', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Apellido">Apellidos</label>
                                    {!! Form::text('Apellido', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Email">E-mail</label>
                                    {!! Form::text('Email', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div>
                                    <label for="CI">CI</label>
                                    {!! Form::text('CI', null, ['class' => 'form-control', 'id' => 'CI', 'placeholder' => 'CI']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="Celular">Celular</label>
                                    {!! Form::number('Celular', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div>
                                    <label for="Direccion">Direccion</label>
                                    {!! Form::text('Direccion', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div>
                                    <label for="FechaNacimiento">Fecha de Nacimiento</label>
                                    {!! Form::date('FechaNacimiento', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div>
                                    <label for="PaisNacimiento">Pais de Nacimiento</label>
                                    {!! Form::text('PaisNacimiento', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div>
                                    <label for="CiudadNacimiento">Ciudad de Nacimiento</label>
                                    {!! Form::text('CiudadNacimiento', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div>
                                    <label for="Sexo">Sexo</label>
                                    <select name="Sexo" class="form-control" id="Sexo">
                                        <option value="Femenino" {{ $empleado->Sexo == 'Femenino' ? 'selected' : '' }}>
                                            Femenino</option>
                                        <option value="Masculino" {{ $empleado->Sexo == 'Masculino' ? 'selected' : '' }}>
                                            Masculino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div>
                                    <label for="EstadoCivil">Estado Civil</label>
                                    <select name="EstadoCivil" class="form-control" id="EstadoCivil">
                                        <option value="Soltero" {{ $empleado->EstadoCivil == 'Soltero' ? 'selected' : '' }}>
                                            Soltero</option>
                                        <option value="Casado" {{ $empleado->EstadoCivil == 'Casado' ? 'selected' : '' }}>
                                            Casado</option>
                                        <option value="Divorciado"
                                            {{ $empleado->EstadoCivil == 'Divorciado' ? 'selected' : '' }}>Divorciado
                                        </option>
                                        <option value="Viudo" {{ $empleado->EstadoCivil == 'Viudo' ? 'selected' : '' }}>
                                            Viudo</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div>
                                    <label for="Profesion">Profesion</label>
                                    {!! Form::text('Profesion', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                <div>
                                    <label for="Estado">Estado</label>
                                    {!! Form::select('Estado', ['Activo' => 'Activo', 'Inactivo' => 'Inactivo'], null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 my-4">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
