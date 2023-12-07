<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcado de Asistencia</title>
    <!-- Agrega los enlaces a los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                {{-- RELOJ DIGITAL --}}
                <button class="btn btn-lg btn-light bg-white" type="button" id="dropdownMenuDate2"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="mdi mdi-calendar"></i> <span id="currentDateTime"></span>
                </button>
                {{-- ----------- --}}
                <div class="card">
                    <div class="card-body text-center">
                        <label class="form-label">MARCADO DE ASISTENCIA</label>


                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('asistencias.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="carnetIdentidad" class="form-label">Ingrese su CI:</label>
                                <input type="text" class="form-control form-control-lg" id="ci" name="ci"
                                    readonly required>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <!-- Agrega botones del 1 al 9 -->
                                    @for ($i = 1; $i <= 9; $i++)
                                        <div class="col-4">
                                            <button type="button" class="btn btn-lg btn-dark btn-block"
                                                onclick="agregarDigito({{ $i }})">{{ $i }}</button>
                                        </div>
                                    @endfor
                                    <!-- Agrega botones 0, borrar último y borrar todo -->
                                    <div class="col-4">
                                        <button type="button" class="btn btn-lg btn-dark btn-block"
                                            onclick="agregarDigito(0)">0</button>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-secondary btn-block"
                                            onclick="borrarUltimoDigito()">Borrar</button>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-danger btn-block"
                                            onclick="limpiarCampo()">Borrar Todo</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" {{-- onclick="registrarMarcado()" --}}>Registrar
                                Marcado</button>
                        </form>
                        <br>
                     
                        <div class="col-19">
                            <!-- Enlace a tu ruta con el botón de estilo -->
                            <a href="{{ route('asistencia.indexMarcar') }}" class="btn btn-secondary btn-block">
                                Actualizar 
                            </a>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    {{-- Olvidar la variable de sesión para que no aparezca en la siguiente recarga --}}
                    {{ session()->forget('success') }}
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    {{-- Olvidar la variable de sesión para que no aparezca en la siguiente recarga --}}
                    {{ session()->forget('error') }}
                @endif

            </div>
        </div>
    </div>

    <!-- Agrega los scripts de Bootstrap y jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        function agregarDigito(digito) {
            var carnetInput = document.getElementById('ci');
            carnetInput.value += digito;
        }

        function borrarUltimoDigito() {
            var carnetInput = document.getElementById('ci');
            var currentValue = carnetInput.value;
            carnetInput.value = currentValue.slice(0, -1); // Elimina el último dígito
        }

        function limpiarCampo() {
            var carnetInput = document.getElementById('ci');
            carnetInput.value = '';
        }

        /* function registrarMarcado() {
            var ci = document.getElementById('ci').value;
            // Aquí puedes enviar el carnet de identidad a tu servidor o hacer cualquier otra acción
            alert('Asistencia Registrada');
        } */

        function updateCurrentDateTime() {
            const now = new Date();
            const formattedDateTime = now.toLocaleString();
            document.getElementById("currentDateTime").textContent = formattedDateTime;
        }

        // Actualiza la hora cada segundo
        setInterval(updateCurrentDateTime, 1000);

        // Llama a la función una vez para mostrar la hora inmediatamente
        updateCurrentDateTime();
    </script>
</body>

</html>
