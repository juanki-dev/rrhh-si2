@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="page__heading">Asignar Postulantes a {{ $reclutamiento->nombre }}</h3>

                            <a class="btn btn-success"
                            href="{{ route('reclutamientos.show', ['reclutamiento' => $reclutamiento]) }}">Atrás

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
                                    @foreach ($listapostu as $listapostus)
                                        <tr>
                                            <td>{{ $listapostus->id }}</td>
                                            <td>{{ $listapostus->Nombre }}</td>
                                            <td>{{ $listapostus->Apellido }}</td>
                                            <td>
                                                <a class="btn btn-primary"
                                                    href="{{ route('postulantereclutamientos.store', ['idpostulante' => $listapostus->id, 'idreclutamiento' => $reclutamiento->id]) }}">Asignar</a>
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
