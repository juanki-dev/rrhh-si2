@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="page__heading">LIQUIDAR</h3>
                            <a class="btn btn-dark ml-auto" href="<!-- {{ route('planillasueldos.index') }} -->">Atras </a>
                        </div>
                        <div class="table-responsive">
                           
                            <table class="table">
                                <h3 class="page__heading">Empleados</h3>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Sueldo</th>
                                        <th>Tipo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $empleadocontratos as $empleadocontrato)
                                        <tr>
                                            <td>{{ $empleadocontrato->idEmpleado }}</td>
                                            <td>{{ $empleadocontrato->NombreEmpleado }}</td>
                                            <td>{{ $empleadocontrato->ApellidoEmpleado }}</td>
                                            <td>{{ $empleadocontrato->sueldo }}</td>
                                            <td>{{ $empleadocontrato->tipo_pago }}</td>
                                                       
                                            <td>
                                                <a class="btn btn-success"  href="{{ route('bono.create', ['id' => $empleados->id]) }}">Asignar</a>
                                                <a class="btn btn-dark ml-auto"  href="{{ route('bono.verEmpleado', ['id' => $empleados->id]) }}">Ver Bonos</a>
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
