@extends('layouts.estilo')

@section('tabla')
    <div class="content-wrapper">
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="card-title">Detalle de Descuento</h1>
                <div>
                   {{--  <a class="btn btn-success ml-2" href="#" id="generateReport">Reporte</a> --}}
                    <a class="btn btn-dark" href="{{ route('descuentos.index') }}">Atras</a>
                </div>
            </div>
        </div>

        <div id="formatOptions" style="display: none;">
            <label for="format" style="font-weight: bold;">Seleccione el Tipo de Reporte:</label>
            <select id="format" class="form-control">
                <option value="pdf">PDF</option>
                <option value="excel">EXCEL</option>
            </select>
            <button id="generate" class="btn btn-primary mt-2">Generar</button>
        </div>

        <!-- Añade una tabla oculta para el informe -->
        {{-- <table id="reportTable" class="table" style="display: none;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>E-mail</th>
                    <th>Celular</th>
                    <th>Cargo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleado as $empleados)
                    <tr>
                        <td>{{ $empleados->id }}</td>
                        <td>{{ $empleados->Nombre }}</td>
                        <td>{{ $empleados->Apellido }}</td>
                        <td>{{ $empleados->Email }}</td>
                        <td>{{ $empleados->Celular }}</td>
                        <td>
                            @foreach ($cargo as $cargos)
                                @if ($cargos->id == $empleados->idCargo)
                                    {{ $cargos->Nombre }}
                                @endif
                            @endforeach
                        </td>
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
                                    text: "Reporte de Empleados",
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
                                            ["ID", "Nombres", "Apellidos", "E-mail", "Celular",
                                                "Cargo"
                                            ],
                                            @foreach ($empleado as $empleados)
                                                [   "{{ $empleados->id }}", 
                                                    "{{ $empleados->Nombre }}",
                                                    "{{ $empleados->Apellido }}",
                                                    "{{ $empleados->Email }}",
                                                    "{{ $empleados->Celular }}",
                                                    "{{ $empleados->cargo->Nombre }}"
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
                        XLSX.writeFile(data, "reporte.xlsx");
                    }
                });
            });
        </script> --}}
        
        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body ">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID:</th>
                                    <td>{{ $descuento->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nombres:</th>
                                    <td>{{ $descuento->Nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Apellidos:</th>
                                    <td>{{ $descuento->Apellido }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha:</th>
                                    <td>{{ date('d-m-Y', strtotime($descuento->fecha)) }}</td>
                                </tr>
                                <tr>
                                    <th>Hora:</th>
                                    <td>{{ $descuento->hora }}</td>
                                </tr>
                                <tr>
                                    <th>Monto:</th>
                                    <td>{{ $descuento->monto }}</td>
                                </tr>
                                <tr>
                                    <th>Motivo:</th>
                                    <td>{{ $descuento->motivo }}</td>
                                </tr>
                                <tr>
                                    <th>Observacion:</th>
                                    <td>{{ $descuento->observacion }}</td>
                                </tr>

                                <tr>
                                    <th>Estado:</th>
                                    <td>
                                        @if ($descuento->estado == 0)
                                            <div class="badge badge-warning">Pendiente</div>
                                        @endif
                                        @if ($descuento->estado == 1)
                                            <div class="badge badge-success">Pagado</div>
                                        @endif
                                        @if ($descuento->estado == 2)
                                            <div class="badge badge-danger">Anulado</div>
                                        @endif
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection