@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Editar Rol</h4>
                    <form method="POST" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="Nombre">Nombre</label>
                            <input type="text" class="form-control" id="Nombre" name="name" value="{{ $role->name }}" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="Descripcion">Lista de permisos</label>
                            @foreach ($permissions as $permission)
                                @php
                                    $rolExist = '';
                                    if ($role->hasAnyPermission($permission->name)) {
                                        $rolExist = 'checked';
                                    }
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $permission->id }}"
                                        id="{{ $permission->id }}" name="permissions[]" {{ $rolExist }}>
                                    <label class="form-check-label" for="{{ $permission->id }}">
                                        {{ $permission->description }}
                                    </label>
                                </div>
                            @endforeach
                            @error('email')
                            <br>
                            <small>*{{ $message }} </small>
                        @enderror
                        </div>

                        <div class="my-4">
                            <button type="submit" class="btn btn-primary mr-2">Guardar</button>
                            <a class="btn btn-light" href="{{ route('roles.index') }}">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection