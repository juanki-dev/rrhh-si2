@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="page__heading">{{ $reclutamiento->nombre }}</h3>
                            <a class="btn btn-success mx-2" id="generateReport">Reporte</a>
                            <a class="btn btn-success"
                                href="{{ route('reclutamientos.assign', ['id' => $reclutamiento->id]) }}">Asignar</a>
                        </div>
                        <div> </div>
                        <div id="formatOptions" style="display: none;">
                            <label for="format" style="font-weight: bold;">Seleccione el Tipo de Reporte:</label>
                            <select id="format" class="form-control">
                                <option value="pdf">PDF</option>
                                <option value="excel">EXCEL</option>
                            </select>
                            <button id="generate" class="btn btn-primary mt-2">Generar</button>
                        </div>


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($postulante as $postulantes)
                                        <tr>
                                            <td>{{ $postulantes->id }}</td>
                                            <td>{{ $postulantes->Nombre }}</td>
                                            <td>{{ $postulantes->Apellido }}</td>

                                            <td>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                <!-- Añade una tabla oculta para el informe -->
                <table id="reportTable" class="table" style="display: none;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>E-mail</th>
                            <th>Teléfono</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($postulante as $postulantes)
                            <tr>
                                <td>{{ $postulantes->id }}</td>
                                <td>{{ $postulantes->Nombre }}</td>
                                <td>{{ $postulantes->Apellido }}</td>
                                <td>{{ $postulantes->Email }}</td>
                                <td>{{ $postulantes->Celular }}</td>

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
                                const logoPath = '{{ asset('admin/assets/images/logo.png') }}';

                                const pdfDefinition = {
                                    images: {
                                        logo: logoPath,
                                    },
                                    content: [{
                                            image: 'logo',
                                            width: '350',
                                            alignment: 'center',
                                        },
                                        {
                                            text: ' ',
                                            margin: [0, 10],
                                        },
                                        {
                                            text: "Reporte de Postulantes",
                                            style: "header",
                                            alignment: 'center',
                                        },
                                        {
                                            text: ' ',
                                            margin: [0, 10],
                                        },
                                        {
                                            table: {
                                                headerRows: 1,
                                                widths: [15, '*', '*', 'auto', 'auto'],
                                                body: [
                                                    ["ID", "Nombres", "Apellidos", "E-mail", "Teléfono" ],
                                                    @foreach ($postulante as $postulantes)
                                                        ["{{ $postulantes->id }}",
                                                            "{{ $postulantes->Nombre }}",
                                                            "{{ $postulantes->Apellido }}",
                                                            "{{ $postulantes->Email }}",
                                                            "{{ $postulantes->Celular }}"
                                                        ],
                                                    @endforeach
                                                ],
                                            },
                                            layout: {
                                                fillColor: function(rowIndex) {
                                                    return rowIndex % 2 === 0 ? "#006400" : null;
                                                },
                                            },
                                        },
                                    ],
                                    styles: {
                                        header: {
                                            fontSize: 18,
                                            bold: true,
                                        },
                                    },
                                };

                                pdfMake.createPdf(pdfDefinition).download("reporte_postulantes.pdf");
                            } else if (selectedFormat === "excel") {
                                const data = XLSX.utils.table_to_book(reportTable, {
                                    sheet: "Postulantes"
                                });
                                XLSX.writeFile(data, "reporte_{{ $reclutamiento->nombre }}.xlsx");
                            }
                        });
                    });
                </script>



            </div>
        </div>
    </div>
@endsection
