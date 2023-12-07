@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="page__heading">PLANILLAS</h3>
                        <a class="btn btn-dark ml-auto" href="{{ route('planillasueldos.create') }}">Nuevo</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Liquido Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($planillas as $planilla)
                                <tr>
                                    <td>{{ $planilla->id }}</td>
                                    <td>{{ $planilla->Fecha }}</td>
                                    <td>{{ $planilla->Tipo }}</td>
                                    <td>{{ $planilla->Total_pagado }}</td>
                                   
                                    <td>
                                        
                                        <a class="btn btn-primary" href="{{ route('planilla.verEmpleado', ['tipo' => $planilla->Tipo, 'id_planillasueldo' => $planilla->id]) }}">Liquidar</a>

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
