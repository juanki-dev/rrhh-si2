@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h3 class="page__heading">Vacaciones de {{ $empleados->Nombre . ' ' . $empleados->Apellido }}</h3>
                <div>
                    <a class="btn btn-success ml-2" href="#" id="generateReport">Reporte</a>
                    <a class="btn btn-dark ml-auto" href="{{ route('vacacion.indexEmpleado') }}">Atras </a>
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

        <!-- Añade una tabla oculta para el informe -->
        <table id="reportTable" class="table" style="display: none;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vacaciones as $vacacion)
                    <tr>
                        <td>{{ $vacacion->id }}</td>
                        <td>{{ date('d-m-Y', strtotime($vacacion->fecha)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($vacacion->fechaInicio)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($vacacion->fechaFin)) }}</td>
                        <td>{{ $vacacion->descripcion }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const generateReportButton = document.getElementById("generateReport");
                const formatOptions = document.getElementById("formatOptions");
                const formatSelect = document.getElementById("format");
                const generateButton = document.getElementById("generate");
                const reportTable = document.getElementById("reportTable");

                generateReportButton.addEventListener("click", function() {
                    formatOptions.style.display = "block";
                });

                generateButton.addEventListener("click", function() {
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
                                    text: "Reporte de Vacaciones",
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
                                        widths: [15, '*', '*', 'auto', 'auto', 'auto'],
                                        body: [
                                            ["ID", "Fecha", "Fecha Inicio",
                                                "Fecha Fin",
                                                "Descripcion",
                                            ],
                                            @foreach ($vacaciones as $vacacion)
                                                ["{{ $vacacion->id }}",
                                                    "{{ $vacacion->fecha }}",
                                                    "{{ $vacacion->fechaInicio }}",
                                                    "{{ $vacacion->fechaFin }}",
                                                    "{{ $vacacion->descripcion }}",
                                                ],
                                            @endforeach
                                        ],
                                    },
                                    layout: {
                                        fillColor: function(rowIndex) {
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
                            sheet: "Empleados"
                        });
                        XLSX.writeFile(data, "reporte de Vacaciones de {{ $empleados->Nombre}} {{$empleados->Apellido}}.xlsx");
                    }
                });
            });
        </script>


        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        {{--  <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="page__heading">Vacaciones de {{$empleados->Nombre. " ". $empleados->Apellido}}</h3>
                            <a class="btn btn-dark ml-auto" href="{{ route('vacacion.indexEmpleado') }}">Atras </a>
                        </div> --}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vacaciones as $vacacion)
                                        <tr>
                                            <td>{{ $vacacion->id }}</td>
                                            <td>{{ date('d-m-Y', strtotime($vacacion->fecha)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($vacacion->fechaInicio)) }}</td>
                                            <td>{{ date('d-m-Y', strtotime($vacacion->fechaFin)) }}</td>
                                            <td>{{ $vacacion->descripcion }}</td>
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
