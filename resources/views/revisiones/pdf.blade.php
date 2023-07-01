<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Revision</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid" style="display: flex; justify-content: center;">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Vehiculo</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="placa">Placa</label>
                    <p>{{ $revision->placa }}</p>
                </div>

                <div class="form-group">
                    <label for="propietario">Propietario</label>
                    <p>{{ $revision->propietario }}</p>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo de vehiculo</label>
                    <p>{{ $revision->tipo }}</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid" style="display: flex; justify-content: center;">
        <div class="card">
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
