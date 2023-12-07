@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="card-title">Detalle de Horas Extras</h1>
                <div>
                    <a class="btn btn-dark" href="{{ route('horas.index') }}">Atrás</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID:</th>
                                    <td>{{ $horasExtras->id }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha:</th>
                                    <td>{{ date('d-m-Y', strtotime($horasExtras->Fecha)) }}</td>
                                </tr>
                                <tr>
                                    <th>Cantidad de Horas:</th>
                                    <td>{{ $horasExtras->Cantidad_Hora }}</td>
                                </tr>
                                <tr>
                                    <th>Monto por Hora:</th>
                                    <td>{{ $horasExtras->Monto_Hora }}</td>
                                </tr>
                                <tr>
                                    <th>Monto Total:</th>
                                    <td>{{ $horasExtras->Monto_Total }}</td>
                                </tr>
                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if ($horasExtras->estado == 0)
                                            <div class="badge badge-warning">Pendiente</div>
                                        @elseif ($horasExtras->estado == 1)
                                            <div class="badge badge-success">Pagado</div>
                                        @elseif ($horasExtras->estado == 2)
                                            <div class="badge badge-danger">Anulado</div>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Agrega aquí las demás filas de tu tabla según tus necesidades -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
