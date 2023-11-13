@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">USUARIOS</h2>
                    @if (isset($msg))
                        <h2>{{ $msg }}</h2>
                    @endif
                    <a href="{{ url('roles') }}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection