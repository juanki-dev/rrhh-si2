@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">CREAR EMPLEADOS</h2>
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
                        {!! Form::open(['route' => 'empleados.store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            <label for="Nombre">Nombre</label>
                            {!! Form::text('Nombre', null, ['class' => 'form-control', 'id' => 'Nombre', 'placeholder' => 'Nombre']) !!}
                        </div>
                        <div class="form-group">
                            <label for="Apellido">Apellidos</label>
                            {!! Form::text('Apellido', null, ['class' => 'form-control', 'id' => 'Apellido', 'placeholder' => 'Apellidos']) !!}
                        </div>
                        <div class="form-group">
                            <label for="Email">E-mail</label>
                            {!! Form::text('Email', null, ['class' => 'form-control', 'id' => 'Email', 'placeholder' => 'E-mail']) !!}
                        </div>
                        <div class="form-group">
                            <label for="CI">CI</label>
                            {!! Form::text('CI', null, ['class' => 'form-control', 'id' => 'CI', 'placeholder' => 'CI']) !!}
                        </div>
                        <div class="form-group">
                            <label for="Celular">Celular</label>
                            {!! Form::text('Celular', null, ['class' => 'form-control', 'id' => 'Celular', 'placeholder' => 'Celular']) !!}
                        </div>
                        <div class="form-group">
                            <label for="Direccion">Direccion</label>
                            {!! Form::text('Direccion', null, [
                                'class' => 'form-control',
                                'id' => 'Direccion',
                                'placeholder' => 'Direccion',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="FechaNacimiento">Fecha de Nacimiento</label>
                            {!! Form::date('FechaNacimiento', null, [
                                'class' => 'form-control',
                                'id' => 'FechaNacimiento',
                                'placeholder' => 'Fecha de Nacimiento',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="PaisNacimiento">Pais de Nacimiento</label>
                            {!! Form::text('PaisNacimiento', null, [
                                'class' => 'form-control',
                                'id' => 'PaisNacimiento',
                                'placeholder' => 'Pais de Nacimiento',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="CiudadNacimiento">Ciudad de Nacimiento</label>
                            {!! Form::text('CiudadNacimiento', null, [
                                'class' => 'form-control',
                                'id' => 'CiudadNacimiento',
                                'placeholder' => 'Ciudad de Nacimiento',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="Sexo">Sexo</label>
                            {!! Form::select('Sexo', ['femenino' => 'Femenino', 'masculino' => 'Masculino'], null, [
                                'class' => 'form-control',
                                'id' => 'Sexo',
                                'placeholder' => 'Selecciona el sexo',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="EstadoCivil">Estado Civil</label>
                            {!! Form::select(
                                'EstadoCivil',
                                ['Soltero' => 'Soltero', 'Casado' => 'Casado', 'Divorciado' => 'Divorciado', 'Viudo' => 'Viudo'],
                                null,
                                ['class' => 'form-control', 'id' => 'EstadoCivil', 'placeholder' => 'Selecciona el estado civil'],
                            ) !!}
                        </div>
                        <div class="form-group">
                            <label for="Profesion">Profesion</label>
                            {!! Form::text('Profesion', null, [
                                'class' => 'form-control',
                                'id' => 'Profesion',
                                'placeholder' => 'Profesion',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="Estado">Estado</label>
                            {!! Form::select('Estado', ['Activo' => 'Activo', 'Inactivo' => 'Inactivo'], null, [
                                'class' => 'form-control',
                                'id' => 'Estado',
                                'placeholder' => 'Selecciona el estado',
                            ]) !!}
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                        <button class="btn btn-light">Cancelar</button>
                        {!! Form::close() !!}
                        {{-- <script>
                            const btnGuardar = document.querySelector("button[type='submit']");
                            document.addEventListener('keydown', e => {
                                if (e.key === 'g' || e.key === 'G') {
                                    btnGuardar.click();
                                }
                            });
                        </script> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
