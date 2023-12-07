@extends('layouts.estilo')

@section('tabla')
<div class="content-wrapper">
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h1 class="card-title">HORAS EXTRAS</h1>
            <div>
                <a class="btn btn-success ml-2" href="#" id="generateReport">Reporte</a>
                <a class="btn btn-dark" href="{{ route('hora.indexEmpleado') }}">Nuevo</a>
            </div>
        </div>
    </div>

    <div id="formatOptions" style="display: none;">
        <label for="format" style="font-weight: bold;">Seleccione el Tipo de Reporte:</label>
        <select id="format" class="form-control">
            <option value="excel">EXCEL</option>
            <option value="pdf">PDF</option>
        </select>
        <button id="generate" class="btn btn-primary mt-2">Generar</button>
    </div>

    <!-- Añade una tarjeta oculta para el informe -->
    <div id="reportCard" class="card" style="display: none;">
        <div class="card-body">
            <h5 class="card-title">Reporte de Horas Extras</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha</th>
                            <th>Cantidad de Horas</th>
                            <th>Monto por Hora</th>
                            <th>Monto Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($horasExtras as $horaExtra)
                        <tr>
                            <td>{{ $horaExtra->id }}</td>
                            <td>{{ $horaExtra->Nombre }}</td>
                            <td>{{ $horaExtra->Apellido }}</td>
                            <td>{{ date('d-m-Y', strtotime($horaExtra->Fecha)) }}</td>
                            <td>{{ $horaExtra->Cantidad_Hora }}</td>
                            <td>{{ $horaExtra->Monto_Hora }}</td>
                            <td>{{ $horaExtra->Monto_Total }}</td>
                            <td>
                                @if ($horaExtra->estado == 0)
                                <div class="badge badge-warning">Pendiente</div>
                                @elseif ($horaExtra->estado == 1)
                                <div class="badge badge-success">Pagado</div>
                                @elseif ($horaExtra->estado == 2)
                                <div class="badge badge-danger">Anulado</div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const generateReportButton = document.getElementById("generateReport");
            const formatOptions = document.getElementById("formatOptions");
            const formatSelect = document.getElementById("format");
            const generateButton = document.getElementById("generate");
            const reportCard = document.getElementById("reportCard");

            generateReportButton.addEventListener("click", function () {
                formatOptions.style.display = "block";
            });

            generateButton.addEventListener("click", function () {
                const selectedFormat = formatSelect.value;

                if (selectedFormat === "pdf") {

                    const logoPath =
                        '{{ asset('admin/assets/images/logo.png') }}'; // ruta del logo ruta publica de laravel(proyecto)

                    const pdfDefinition = {

                        images: {
                            logo: logoPath,
                        },
                        content: [{
                                image: 'logo', // Usa el nombre definido para la imagen del logo
                                width: '350', // Ajusta el ancho de la imagen según tus necesidades
                                alignment: 'center', // Alinea la imagen a la derecha (puedes ajustar la alineación)
                            },
                            {
                                text: ' ',
                                margin: [0, 10]
                            },
                            {
                                text: "Reporte de Horas Extras",
                                style: "header",
                                alignment: 'center',
                            },
                            {
                                text: ' ',
                                margin: [0, 10]
                            },
                            {
                                table: {
                                    headerRows: 1,
                                    widths: [15, '*', '*', 'auto', 'auto', 'auto', 'auto', 'auto'],
                                    body: [
                                        ["ID", "Nombres", "Apellidos", "Fecha", "Cantidad de Horas", "Monto por Hora", "Monto Total", "Estado",
                                        ],
                                        @foreach ($horasExtras as $horaExtra)
                                        ["{{ $horaExtra->id }}",
                                            "{{ $horaExtra->Nombre }}",
                                            "{{ $horaExtra->Apellido }}",
                                            "{{ $horaExtra->Fecha }}",
                                            "{{ $horaExtra->Cantidad_Hora }}",
                                            "{{ $horaExtra->Monto_Hora }}",
                                            "{{ $horaExtra->Monto_Total}}",
                                            @if($horaExtra->estado == 0)
                                            "{{ "pendiente"}}",
                                            @endif
                                            @if($horaExtra->estado == 1)
                                            "{{ "pagado"}}",
                                            @endif
                                            @if($horaExtra->estado == 2)
                                            "{{ "anulado"}}",
                                            @endif
                                        ],
                                        @endforeach
                                    ],
                                },
                                layout: {
                                    fillColor: function (rowIndex) {
                                        return rowIndex % 2 === 0 ? "#006400" : null;
                                    }
                                }
                            },
                        ],
                        styles: {
                            header: {
                                fontSize: 18,
                                bold: true,
                            },
                        },
                    };
                    //Genera el PDF
                    pdfMake.createPdf(pdfDefinition).download("reporte.pdf");

                } else if (selectedFormat === "excel") {
                    // Generar el excel
                    const data = XLSX.utils.table_to_book(reportTable, {
                        sheet: "HorasExtras"
                    });
                    XLSX.writeFile(data, "reporte de Horas Extras.xlsx");
                }
            });
        });
    </script>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Fecha</th>
                                    <th>Cantidad de Horas</th>
                                    <th>Monto por Hora</th>
                                    <th>Monto Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($horasExtras as $horaExtra)
                                <tr>
                                    <td>{{ $horaExtra->id }}</td>
                                    <td>{{ $horaExtra->Nombre }}</td>
                                    <td>{{ $horaExtra->Apellido }}</td>
                                    <td>{{ date('d-m-Y', strtotime($horaExtra->Fecha)) }}</td>
                                    <td>{{ $horaExtra->Cantidad_Hora }}</td>
                                    <td>{{ $horaExtra->Monto_Hora }}</td>
                                    <td>{{ $horaExtra->Monto_Total }}</td>
                                    <td>
                                        @if ($horaExtra->estado == 0)
                                        <div class="badge badge-warning">Pendiente</div>
                                        @elseif ($horaExtra->estado == 1)
                                        <div class="badge badge-success">Pagado</div>
                                        @elseif ($horaExtra->estado == 2)
                                        <div class="badge badge-danger">Anulado</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($horaExtra->estado != 2)
                                            <a class="btn btn-primary" href="{{ route('horas.edit', $horaExtra->id) }}">Editar</a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['horas.destroy', $horaExtra->id],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            {!! Form::submit('Anular', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                            {!! Form::open([
            'method' => 'POST',
            'route' => ['horas.markAsPaid', $horaExtra->id],
            'style' => 'display:inline',
            'id' => 'pagarForm',  // Agregamos un ID al formulario
        ]) !!}
        {!! Form::submit('Pagado', ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
                                        @endif
                                        <a class="btn btn-success" href="{{ route('horas.show', $horaExtra->id) }}">Ver detalle</a>
                                    </td>
                                    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const pagarForm = document.getElementById("pagarForm");
        const editarBtn = document.getElementById("editarBtn");
        const anularBtn = document.getElementById("anularBtn");

        pagarForm.addEventListener("submit", function () {
            // Deshabilita el botón de editar
            editarBtn.disabled = true;
            // Deshabilita el botón de anular
            anularBtn.disabled = true;
        });
    });
</script>
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
