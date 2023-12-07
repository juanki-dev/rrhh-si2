@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="page__heading">VER PLANILLAS</h3>
                        <a class="btn btn-dark ml-auto" href="{{ route('planillasueldos.create') }}">Nuevo</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>sueldo</th>
                                    <th>horas_extras</th>
                                    <th>monto_horas_extras</th>
                                    <th>bono_total</th>
                                    <th>descuento_total</th>
                                    <th>afp</th>
                                    <th>liquido</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($planillasempleado as $planilla)
                                <tr>
                                    <td>{{ $planilla->idEmpleado }}</td>
                                    <td>{{ $planilla->sueldo }}</td>
                                    <td>{{ $planilla->horas_extras }}</td>
                                    <td>{{ $planilla->monto_horas_extras }}</td>
                                    <td>{{ $planilla->bono_total }}</td>
                                    <td>{{ $planilla->descuento_total }}</td>
                                    <td>{{ $planilla->afp }}</td>
                                    <td>{{ $planilla->liquido }}</td>
 
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
