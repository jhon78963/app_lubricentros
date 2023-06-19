@extends('layout.template')

@section('title')
    <title>Lubricentro | Products</title>
@endsection

@section('content')
    <div class="container-fluid" style="display: flex; justify-content: center;">
        <div class="card" style="width: 50%">
            <div class="card-header">
                <h2 class="card-title">Revisión<b> Técnica</b></h2>
            </div>
            <div class="card-body">
                @if (session('datos'))
                    <div class="alert alert-warning" id="warning-alert">
                        {{ session('datos') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <form action="{{ route('revisiones.store') }}" method="POST">
        @csrf
        <div class="container-fluid" style="display: flex; justify-content: center;">
            <div class="card" style="width: 50%">
                <div class="card-header">
                    <h2 class="card-title">Vehiculo</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" name="placa" id="placa"
                            value="{{ $revision->placa }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="propietario">Propietario</label>
                        <input type="text" name="propietario" id="propietario" class="form-control"
                            value="{{ $revision->propietario }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo de vehiculo</label>
                        <input type="text" name="tipo" id="tipo" class="form-control"
                            value="{{ $revision->tipo }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" style="display: flex; justify-content: center;">
            <div class="card" style="width: 50%">
                <div class="card-header">
                    <h2 class="card-title">Revisión Técnica</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" style="margin: 0 auto; width:100%;">
                        <thead>
                            <tr>
                                <th>Revisión</th>
                                <th>Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Estado del motor</td>
                                <td>
                                    @if ($revision->motor == true)
                                        <label><input type="radio" name="motor" value="opcion1" checked>
                                            Bueno</label>
                                        <label><input type="radio" name="motor" value="opcion2"
                                                onclick="showTextArea('motor')">
                                            Reparar</label>
                                        <br>
                                        <textarea id="motorTextArea" name="motor_detail" style="display: none; width: 300px;">{{ $revision->motor_detail }}</textarea>
                                    @else
                                        <label><input type="radio" name="motor" value="opcion1">
                                            Bueno</label>
                                        <label><input type="radio" name="motor" value="opcion2" checked
                                                onclick="showTextArea('motor')">
                                            Reparar</label>
                                        <br>
                                        <textarea id="motorTextArea" name="motor_detail" style="display: block; width: 300px;">{{ $revision->motor_detail }}</textarea>
                                    @endif

                                </td>
                            </tr>

                            <tr>
                                <td>Sistema de frenos</td>
                                <td>
                                    @if ($revision->frenos == true)
                                        <label><input type="radio" name="frenos" value="opcion1" checked>
                                            Bueno</label>
                                        <label><input type="radio" name="frenos" value="opcion2"
                                                onclick="showTextArea('frenos')"> Reparar</label>
                                        <br>
                                        <textarea id="frenosTextArea" name="frenos_detail" style="display: none; width: 300px;">{{ $revision->frenos_detail }}</textarea>
                                    @else
                                        <label><input type="radio" name="frenos" value="opcion1">
                                            Bueno</label>
                                        <label><input type="radio" name="frenos" value="opcion2" checked
                                                onclick="showTextArea('frenos')"> Reparar</label>
                                        <br>
                                        <textarea id="frenosTextArea" name="frenos_detail" style="display: block; width: 300px;">{{ $revision->frenos_detail }}</textarea>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Sistema de suspensión y dirección</td>
                                <td>
                                    @if ($revision->suspension_direccion == true)
                                        <label><input type="radio" name="suspension_direccion" value="opcion1" checked>
                                            Bueno</label>
                                        <label><input type="radio" name="suspension_direccion" value="opcion2"
                                                onclick="showTextArea('suspension_direccion')">
                                            Reparar</label>
                                        <br>
                                        <textarea id="suspension_direccionTextArea" name="suspension_direccion_detail" style="display: none; width: 300px;">{{ $revision->suspension_direccion_detail }}</textarea>
                                    @else
                                        <label><input type="radio" name="suspension_direccion" value="opcion1">
                                            Bueno</label>
                                        <label><input type="radio" name="suspension_direccion" value="opcion2" checked
                                                onclick="showTextArea('suspension_direccion')">
                                            Reparar</label>
                                        <br>
                                        <textarea id="suspension_direccionTextArea" name="suspension_direccion_detail" style="display: block; width: 300px;">{{ $revision->suspension_direccion_detail }}</textarea>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Luces y señalización</td>
                                <td>
                                    @if ($revision->luces_señalizacion == true)
                                        <label><input type="radio" name="luces_señalizacion" value="opcion1" checked>
                                            Bueno</label>
                                        <label><input type="radio" name="luces_señalizacion" value="opcion2"
                                                onclick="showTextArea('luces_señalizacion')">
                                            Reparar</label>
                                        <br>
                                        <textarea id="luces_señalizacionTextArea" name="luces_señalizacion_detail" style="display: none; width: 300px;">{{ $revision->luces_señalizacion_detail }}</textarea>
                                    @else
                                        <label><input type="radio" name="luces_señalizacion" value="opcion1">
                                            Bueno</label>
                                        <label><input type="radio" name="luces_señalizacion" value="opcion2" checked
                                                onclick="showTextArea('luces_señalizacion')">
                                            Reparar</label>
                                        <br>
                                        <textarea id="luces_señalizacionTextArea" name="luces_señalizacion_detail" style="display: block; width: 300px;">{{ $revision->luces_señalizacion_detail }}</textarea>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Equipos de seguridad</td>
                                <td>
                                    @if ($revision->equipo_seguridad == true)
                                        <label><input type="radio" name="equipo_seguridad" value="opcion1" checked>
                                            Bueno</label>
                                        <label><input type="radio" name="equipo_seguridad" value="opcion2"
                                                onclick="showTextArea('equipo_seguridad')"> Reparar</label>

                                        <br>
                                        <textarea id="equipo_seguridadTextArea" name="equipo_seguridad_detail" style="display: none; width: 300px;">{{ $revision->equipo_seguridad_detail }}</textarea>
                                    @else
                                        <label><input type="radio" name="equipo_seguridad" value="opcion1">
                                            Bueno</label>
                                        <label><input type="radio" name="equipo_seguridad" value="opcion2" checked
                                                onclick="showTextArea('equipo_seguridad')"> Reparar</label>
                                        <br>
                                        <textarea id="equipo_seguridadTextArea" name="equipo_seguridad_detail" style="display: block; width: 300px;">{{ $revision->equipo_seguridad_detail }}</textarea>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-fluid" style="display: flex; justify-content: center;">
            <div class="card" style="width: 50%">
                <div class="card-body d-flex justify-content-center">
                    <button class="btn btn-success" type="submit">Guardar</button>
                    <a href="{{ route('revisiones.index') }}" class="btn btn-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        function showTextArea(radioName) {
            var selectedRadio = document.querySelector('input[name="' + radioName + '"]:checked');
            var textArea = document.getElementById(radioName + 'TextArea');

            if (selectedRadio && selectedRadio.value == 'opcion2') {
                textArea.style.display = 'block';
            } else {
                textArea.style.display = 'none';
            }
        }
        var radioButtons = document.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('change', function() {
                var radioName = this.getAttribute('name');
                showTextArea(radioName);
            });
        });
    </script>
@endsection
