@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="page__heading">Asignar Empleados a {{ $memorandum->subject }}</h3>

                            <a class="btn btn-success"
                            href="{{ route('memorandums.show', ['memorandum' => $memorandum]) }}">Atrás

                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listaEmpleados as $listaEmpleado)
                                        <tr>
                                            <td>{{ $listaEmpleado->id }}</td>
                                            <td>{{ $listaEmpleado->Nombre }}</td>
                                            <td>{{ $listaEmpleado->Apellido }}</td>
                                            <td>
                                                <a class="btn btn-primary"
                                                    href="{{ route('empleadomemorandums.store', ['id_Empleado' => $listaEmpleado->id, 'id_Memorandum' => $memorandum->id]) }}">Asignar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
