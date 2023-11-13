@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h4 class="card-title">Roles</h4>
            <div class="d-flex align-items-center">
                <!-- Puedes ajustar la ruta según tus necesidades -->
                <a class="btn btn-primary mb-2" href="{{ route('roles.create') }}">CREAR</a>
            </div>
        </div>
    </div>

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="row">
        @foreach ($roles as $role)
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rol: {{ $role->id }}</h5>
                        <p class="card-text">
                        <span  style="font-size: 20px;">{{ $role->name }}</span>
                        </p>
                        <div class="d-flex justify-content-around">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('roles.destroy', $role) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
