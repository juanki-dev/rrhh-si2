@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h3 class="page__heading">Aguinaldos de {{ $empleados->Nombre . ' ' . $empleados->Apellido }}</h3>
                    <div>
                        <a class="btn btn-success ml-2" href="#" id="generateReport">Reporte</a>
                        <a class="btn btn-dark" href="{{ route('aguinaldo.indexEmpleado') }}">Atras</a>
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
            {{-- Esta tabla va al excel --}}
            <table id="reportTable" class="table" style="display: none;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aguinaldos as $aguinaldo)
                    <tr>
                        <td>{{ $aguinaldo->id }}</td>
                        <td>{{ date('d-m-Y', strtotime($aguinaldo->fecha)) }}</td>
                        <td>{{ $aguinaldo->hora }}</td>
                        <td>{{ $aguinaldo->monto }}</td>
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
                                        text: "Reporte de Aguinaldos",
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
                                                ["ID", "Fecha", "Hora", "Monto", 
                                                    
                                                ],
                                                @foreach ($aguinaldos as $aguinaldo)
                                                    [   "{{ $aguinaldo->id }}",
                                                        "{{ $aguinaldo->fecha }}",
                                                        "{{ $aguinaldo->hora }}",
                                                        "{{ $aguinaldo->monto }}",
                                                    ],
                                                @endforeach
                                            ],
                                        },
                                        layout: {
                                            fillColor: function(rowIndex) {
                                                return rowIndex % 2 === 0 ? "#640000" : null;
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
                            XLSX.writeFile(data, "reporte de Aguinaldos de {{ $empleados->Nombre}} {{$empleados->Apellido}}.xlsx");
                        }
                    });
                });
            </script>

            <div class="card-deck">
                @foreach ($aguinaldos as $aguinaldo)
                    <div class="card mb-3 border border-dark rounded">
                        <div class="card-header bg-primary text-white border dark rounded">
                            <strong>ID: {{ $aguinaldo->id }}</strong>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Fecha:</strong> {{ date('d-m-Y', strtotime($aguinaldo->fecha)) }}</p>
                            <hr class="my-3">
                            <p class="card-text"><strong>Hora:</strong> {{ $aguinaldo->hora}}</p>
                            <hr class="my-3">
                            <p class="card-text"><strong>Monto:</strong> {{ $aguinaldo->monto }}</p>
                            <hr class="my-3">
                        </div>
                        <div class="card-footer bg-light text-right border dark rounded">
                            <small class="text-muted">Última actualización: {{ $aguinaldo->updated_at }}</small>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    @endsection
