@extends('layout.template')

@section('title')
    <title>Lubricentro | Products</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Gestión de<b> Ventas</b></h2>
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

            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="list-tab" data-toggle="tab" href="#list" role="tab"
                            aria-controls="home" aria-selected="true">Lista de Revisiones</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" role="tab"
                            aria-controls="profile" aria-selected="false">Nueva Revisión</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                        <h3></h3>
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="tabla-sale" class="table table-striped table-bordered table-hover nowrap"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th data-priority="1" class="text-center">Fecha</th>
                                                <th class="text-center">Placa</th>
                                                <th class="text-center">Propietario</th>
                                                <th class="text-center">Tipo</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($revisiones as $revision)
                                                <tr>
                                                    <td class="text-center">{{ $revision->fecha }}</td>
                                                    <td class="text-center">{{ $revision->placa }}</td>
                                                    <td class="text-center">{{ $revision->propietario }}</td>
                                                    <td class="text-center">{{ $revision->tipo }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('revisiones.show', $revision->id) }}"
                                                            class="btn btn-info">Ver</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                        <br>
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
                                                placeholder="Ingrese placa del vehiculo">

                                            <div class="alert alert-warning mt-2" id="warning-alert" style="display: none;">
                                                La placa del vehiculo no está registrada, por favor llene los campos
                                                siguientes.
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="alert alert-warning mt-2" id="lenght-alert"
                                                style="display: none;">
                                                La placa debe contener 7 caracteres.
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="propietario">Propietario</label>
                                            <input type="text" name="propietario" id="propietario"
                                                class="form-control" placeholder="Ingrese propietario del vehiculo">
                                        </div>

                                        <div class="form-group">
                                            <label for="tipo">Tipo de vehiculo</label>
                                            <select name="tipo" id="tipo" class="form-control">
                                                <option value="">Seleccione tipo de vehiculo</option>
                                                <option value="Automóvil">Automóvil</option>
                                                <option value="Moto">Moto</option>
                                            </select>
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
                                        <table class="table table-striped table-bordered"
                                            style="margin: 0 auto; width:100%;">
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
                                                        <label><input type="radio" name="motor" value="opcion1">
                                                            Bueno</label>
                                                        <label><input type="radio" name="motor" value="opcion2"
                                                                onclick="showTextArea('motor')">
                                                            Reparar</label>
                                                        <br>
                                                        <textarea id="motorTextArea" name="motor_detail" style="display: none; width: 300px;"></textarea>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Sistema de frenos</td>
                                                    <td>
                                                        <label><input type="radio" name="frenos" value="opcion1">
                                                            Bueno</label>
                                                        <label><input type="radio" name="frenos" value="opcion2"
                                                                onclick="showTextArea('frenos')"> Reparar</label>
                                                        <br>
                                                        <textarea id="frenosTextArea" name="frenos_detail" style="display: none; width: 300px;"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Sistema de suspensión y dirección</td>
                                                    <td>
                                                        <label><input type="radio" name="suspension_direccion"
                                                                value="opcion1">
                                                            Bueno</label>
                                                        <label><input type="radio" name="suspension_direccion"
                                                                value="opcion2"
                                                                onclick="showTextArea('suspension_direccion')">
                                                            Reparar</label>
                                                        <br>
                                                        <textarea id="suspension_direccionTextArea" name="suspension_direccion_detail" style="display: none; width: 300px;"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Luces y señalización</td>
                                                    <td>
                                                        <label><input type="radio" name="luces_señalizacion"
                                                                value="opcion1"> Bueno</label>
                                                        <label><input type="radio" name="luces_señalizacion"
                                                                value="opcion2"
                                                                onclick="showTextArea('luces_señalizacion')">
                                                            Reparar</label>
                                                        <br>
                                                        <textarea id="luces_señalizacionTextArea" name="luces_señalizacion_detail" style="display: none; width: 300px;"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Equipos de seguridad</td>
                                                    <td>
                                                        <label><input type="radio" name="equipo_seguridad"
                                                                value="opcion1"> Bueno</label>
                                                        <label><input type="radio" name="equipo_seguridad"
                                                                value="opcion2"
                                                                onclick="showTextArea('equipo_seguridad')"> Reparar</label>
                                                        <br>
                                                        <textarea id="equipo_seguridadTextArea" name="equipo_seguridad_detail" style="display: none; width: 300px;"></textarea>
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
                                        <button class="btn btn-secondary">Limpiar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        table thead {
            background-color: black;
            color: white;
        }

        #tabla-product tbody td:eq(0) {
            text-align: left;
        }

        #tabla-product tbody td {
            text-align: center;
        }

        #tabla-category tbody td:eq(0) {
            text-align: left;
        }

        #tabla-category tbody td {
            text-align: center;
        }

        #tabla-order tbody td:eq(0) {
            text-align: left;
        }

        #tabla-order tbody td {
            text-align: center;
        }
    </style>
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

            var radioButtons = document.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(function(radioButton) {
                radioButton.addEventListener('change', function() {
                    var radioName = this.getAttribute('name');
                    showTextArea(radioName);
                });
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#placa').keyup(function() {
                var placa = document.getElementById("placa").value;
                var lenght = document.getElementById("placa").value;
                var alert = document.getElementById('warning-alert');
                var lenght_alert = document.getElementById('lenght-alert');
                if (lenght.length == 7) {
                    $.get('/api/vehiculo/' + placa, function(data) {
                        if (data.placa != undefined) {
                            alert.style.display = 'none';
                            lenght_alert.style.display = 'none';
                            $('#propietario').val(data.propietario);
                            $('#tipo').val(data.tipo);
                            $('#propietario').attr("readonly", true);
                            $('#tipo').attr("readonly", true);
                        } else {
                            alert.style.display = 'block';
                            lenght_alert.style.display = 'none';
                            $('#propietario').val('');
                            $('#tipo').val('');
                            $('#propietario').attr("readonly", false);
                            $('#tipo').attr("readonly", false);
                        }
                    });
                } else {
                    lenght_alert.style.display = 'block';
                    alert.style.display = 'none';
                    $('#propietario').val('');
                    $('#tipo').val('');
                    $('#propietario').attr("readonly", true);
                    $('#tipo').attr("readonly", true);
                }
            });
        });
    </script>
@endsection
