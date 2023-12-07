@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="card-title">AGUINALDOS</h1>
                <div>
                    <a class="btn btn-success ml-2" href="#" id="generateReport">Reporte</a>
                    <a class="btn btn-dark" href="{{ route('aguinaldo.indexEmpleado') }}">Ir a pagar</a>
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
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aguinaldos as $aguinaldo)
                    <tr>
                        <td>{{ $aguinaldo->id }}</td>
                        <td>{{ $aguinaldo->Nombre }}</td>
                        <td>{{ $aguinaldo->Apellido }}</td>
                        <td>{{ date('d-m-Y', strtotime($aguinaldo->fecha)) }}</td>
                        <td>{{ $aguinaldo->hora }}</td>
                        <td>{{ $aguinaldo->monto}}</td>
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
                                        widths: [15, '*', '*', 'auto', 'auto', 'auto', 'auto'],
                                        body: [
                                            ["ID", "Nombres", "Apellidos", "Fecha", "Hora", "Monto", 
                                            ],
                                            @foreach ($aguinaldos as $aguinaldo)
                                                ["{{ $aguinaldo->id }}",
                                                    "{{ $aguinaldo->Nombre }}",
                                                    "{{ $aguinaldo->Apellido }}",
                                                    "{{ $aguinaldo->fecha }}",
                                                    "{{ $aguinaldo->hora }}",
                                                    "{{ $aguinaldo->monto}}",                                                 
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
                        XLSX.writeFile(data, "reporte de Aguinaldos.xlsx");
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
                                        <th>Hora</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aguinaldos as $aguinaldo)
                                        <tr>
                                            <td>{{ $aguinaldo->id }}</td>
                                            <td>{{ $aguinaldo->Nombre }}</td>
                                            <td>{{ $aguinaldo->Apellido }}</td>
                                            <td>{{ date('d-m-Y', strtotime($aguinaldo->fecha)) }}</td>
                                            <td>{{ $aguinaldo->hora }}</td>
                                            <td>{{ $aguinaldo->monto }}</td>

                                            <td>
                                                {{-- <a class="btn btn-primary"
                                                    href="{{ route('aguinaldos.edit', $aguinaldo->id) }}">Editar</a> --}}
                                                
                                                {{-- {!! Form::open([
                                                    'method' => 'DELETE', 
                                                    'route' => ['aguinaldos.destroy', $aguinaldo->id], 
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!} --}}

                                                <a class="btn btn-success" href="{{ route('aguinaldos.show', $aguinaldo->id) }}">Ver
                                                    detalle</a>
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
