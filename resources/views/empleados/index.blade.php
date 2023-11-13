@extends('layouts.estilo')

@section('tabla')

<div class="content-wrapper">
<div class="card mb-3">
<div class="card-body d-flex justify-content-between align-items-center">
    <h3 class="card-title">EMPLEADOS</h3>
    <div class="d-flex align-items-center">
        <a class="btn btn-success mx-2" id="generateReport">Reporte</a>
        <a class="btn btn-dark" href="{{ route('empleados.create') }}">Nuevo</a>
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
        <table id="reportTable" class="table" style="display: none;">
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
                    <td>{{$empleados->id}}</td>
                    <td>{{$empleados->Nombre}}</td>
                    <td>{{$empleados->Apellido}}</td>
                    <td>{{$empleados->Email}}</td>
                    <td>{{$empleados->Celular}}</td>
                    <td> @foreach ($cargo as $cargos)
                        @if($cargos->id==$empleados->idCargo)
                        {{$cargos->Nombre}}
                        @endif
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

<script>
    document.addEventListener("keydown", function (event) {
    // Verificar si la tecla "N" o "n" se presiona
    if (event.key === "N" || event.key === "n") {
        // Redirigir al usuario a la ruta para crear un nuevo empleado
        window.location.href = "{{ route('empleados.create') }}";
    }
});
    document.addEventListener("DOMContentLoaded", function() {
        const generateReportButton = document.getElementById("generateReport");
        const formatOptions = document.getElementById("formatOptions");
        const formatSelect = document.getElementById("format");
        const generateButton = document.getElementById("generate");
        const reportTable = document.getElementById("reportTable");
    
    document.addEventListener("keydown", function (event) {
    if ((event.key === "P") || (event.key === "p")) {
        // Descargar el PDF al presionar "P"
        generatePDF();
    } else if ((event.key === "E") || (event.key === "e")) {
        // Descargar la tabla en Excel al presionar "E"
        generateExcel();
    }
});

        generateReportButton.addEventListener("click", function() {
        if (formatOptions.style.display === "none") {
            formatOptions.style.display = "block";
        } else {
            formatOptions.style.display = "none";
        }
    });

        generateButton.addEventListener("click", function() {
            const selectedFormat = formatSelect.value;

            if (selectedFormat === "pdf") {
                generatePDF();
            } else if (selectedFormat === "excel") {
                generateExcel();
            }
        });

        // Función para generar y descargar el PDF
        function generatePDF() {
            const logoPath = '{{ asset('admin/assets/images/logo.png') }}'; // Ruta del logo (ruta pública de Laravel).

            const pdfDefinition = {
                images: {
                    logo: logoPath,
                },
                content: [
                    {
                        image: 'logo',
                        width: 350,
                        alignment: 'center',
                    },
                    {
                        text: ' ',
                        margin: [0, 10],
                    },
                    {
                        text: "Reporte de Empleados",
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
                            widths: [15, '*', '*', 'auto', 'auto', 'auto'],
                            body: [
                                ["ID", "Nombres", "Apellidos", "E-mail", "Celular", "Cargo"],
                                @foreach($empleado as $empleados)
                                ["{{ $empleados->id }}", "{{ $empleados->Nombre }}", "{{ $empleados->Apellido }}", "{{ $empleados->Email }}", "{{ $empleados->Celular }}", "{{ $empleados->cargo->Nombre }}"],
                                @endforeach
                            ],
                        },
                        layout: {
                            fillColor: function(rowIndex) {
                                return rowIndex % 2 === 0 ? "#FFF" : null;
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

            pdfMake.createPdf(pdfDefinition).download("reporte.pdf");
        }

        // Función para generar y descargar la tabla en Excel
        function generateExcel() {
            const data = XLSX.utils.table_to_book(reportTable, {
                sheet: "Empleados"
            });
            XLSX.writeFile(data, "reporte.xlsx");
        }
    });
</script>



<div class="row" id="employee-container">
    @foreach ($empleado as $empleados)
    <div class="col-lg-4 mb-3">
        <div class="card">
            <div class="card-body">
                        <h4 class="card-title">Empleado:</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID:</th>
                                    <td>{{ $empleados->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nombres:</th>
                                    <td>{{ $empleados->Nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Apellidos:</th>
                                    <td>{{ $empleados->Apellido }}</td>
                                </tr>
                                <tr>
                                    <th>E-mail:</th>
                                    <td>{{ $empleados->Email }}</td>
                                </tr>
                                <tr>
                                    <th>Celular:</th>
                                    <td>{{ $empleados->Celular }}</td>
                                </tr>
                                <tr>
                                    <th>Cargo:</th>
                                    <td>
                                        @foreach ($cargo as $cargos)
                                        @if ($cargos->id == $empleados->idCargo)
                                        {{ $cargos->Nombre }}
                                        @endif
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-success" href="{{ route('empleados.pdf', $empleados->id) }}">PDF</a>
                                <a class="btn btn-primary mx-2" href="{{ route('empleados.edit', $empleados->id) }}">Editar</a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['empleados.destroy', $empleados->id],
                                'style' => 'display:inline']) !!}
                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</div>
@endsection