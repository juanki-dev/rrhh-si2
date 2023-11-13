@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h3 class="page__heading">Bonos de {{ $empleados->Nombre . ' ' . $empleados->Apellido }}</h3>
                    <div>
                        <a class="btn btn-success ml-2" href="#" id="generateReport">Reporte</a>
                        <a class="btn btn-dark" href="{{ route('bono.indexEmpleado') }}">Atras</a>
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
                        <th>Hora</th>
                        <th>Monto</th>
                        <th>Motivo</th>
                        <th>Observacion</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bonos as $bono)
                    <tr>
                        <td>{{ $bono->id }}</td>
                        <td>{{ date('d-m-Y', strtotime($bono->fecha)) }}</td>
                        <td>{{ $bono->hora }}</td>
                        <td>{{ $bono->monto }}</td>
                        <td>{{ $bono->motivo }}</td>
                        <td>{{ $bono->observacion }}</td>
                        @if ($bono->estado == 0)
                            <td class="font-weight-medium">
                                <div class="badge badge-warning">Pendiente</div>
                            </td>
                        @endif
                        @if ($bono->estado == 1)
                            <td class="font-weight-medium">
                                <div class="badge badge-success">Pagado</div>
                            </td>
                        @endif
                        @if ($bono->estado == 2)
                            <td class="font-weight-medium">
                                <div class="badge badge-danger">Anulado</div>
                            </td>
                        @endif
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
                                        text: "Reporte de Bonos",
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
                                                ["ID", "Fecha", "Hora", "Monto", "Motivo", "Observacion", "Estado", 
                                                    
                                                ],
                                                @foreach ($bonos as $bono)
                                                    [   "{{ $bono->id }}",
                                                        "{{ $bono->fecha }}",
                                                        "{{ $bono->hora }}",
                                                        "{{ $bono->monto }}",
                                                        "{{ $bono->motivo }}",
                                                        "{{ $bono->observacion }}",
                                                        @if ($bono->estado == 0)
                                                            "{{ 'pendiente' }}",
                                                        @endif
                                                        @if ($bono->estado == 1)
                                                            "{{ 'pagado' }}",
                                                        @endif
                                                        @if ($bono->estado == 2)
                                                            "{{ 'anulado' }}",
                                                        @endif
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
                            XLSX.writeFile(data, "reporte de Bonos de {{ $empleados->Nombre}} {{$empleados->Apellido}}.xlsx");
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
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Monto</th>
                                            <th>Motivo</th>
                                            <th>Observacion</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bonos as $bono)
                                            <tr>
                                                <td>{{ $bono->id }}</td>
                                                <td>{{ date('d-m-Y', strtotime($bono->fecha)) }}</td>
                                                <td>{{ $bono->hora }}</td>
                                                <td>{{ $bono->monto }}</td>
                                                <td>{{ $bono->motivo }}</td>
                                                <td>{{ $bono->observacion }}</td>
                                                @if ($bono->estado == 0)
                                                    <td class="font-weight-medium">
                                                        <div class="badge badge-warning">Pendiente</div>
                                                    </td>
                                                @endif
                                                @if ($bono->estado == 1)
                                                    <td class="font-weight-medium">
                                                        <div class="badge badge-success">Pagado</div>
                                                    </td>
                                                @endif
                                                @if ($bono->estado == 2)
                                                    <td class="font-weight-medium">
                                                        <div class="badge badge-danger">Anulado</div>
                                                    </td>
                                                @endif
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
