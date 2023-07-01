@extends('layout.template')

@section('title')
    <title>Lubricentro | Clientes</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Gestión de<b> Clientes</b></h2>
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
                        <a class="nav-link active" id="customer-list-tab" data-toggle="tab" href="#customer-list"
                            role="tab" aria-controls="home" aria-selected="true">Lista de Clientes</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="customer-store-tab" data-toggle="tab" href="#customer-store" role="tab"
                            aria-controls="profile" aria-selected="false">Nuevo Cliente</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer-list" role="tabpanel"
                        aria-labelledby="customer-list-tab">
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="tabla-customer" class="table table-striped table-bordered table-hover nowrap"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center" data-priority="1">#</th>
                                                <th class="text-center" data-priority="2">DNI</th>
                                                <th class="text-center">Cliente</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="customer-store" role="tabpanel" aria-labelledby="customer-store-tab">
                        <br>
                        <form id="frmRegistro">
                            @csrf
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="text" class="form-control" name="dni">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="category_name">Nombre</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="category_name">Apellidos</label>
                                        <input type="text" class="form-control" name="lastname">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_name">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>

                            <button type="submit" class="btn btn-outline-success btn-round"
                                id="guardar">Registrar</button>
                        </form>
                    </div>
                </div>

                <!-- Modal actualizar customero-->
                <div class="modal fade" id="customer_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Editar Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="customer_edit_form">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" id="update_cust_id" name="update_cust_id">
                                    <div class="form-group">
                                        <label for="dni">DNI</label>
                                        <input type="text" class="form-control" name="dni" id="update_dni">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="category_name">Nombre</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="update_name">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="category_name">Apellidos</label>
                                                <input type="text" class="form-control" name="lastname"
                                                    id="update_lastname">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_name">Email</label>
                                        <input type="email" class="form-control" name="email" id="update_email">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" id="actualizar">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal eliminar customer -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Desea eliminar el registro seleccionado?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="btnEliminar" name="btnEliminar"
                                    class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <style>
        table thead {
            background-color: black;
            color: white;
        }

        #tabla-customer tbody td:eq(0) {
            text-align: left;
        }

        #tabla-customer tbody td {
            text-align: center;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <!-- Data tables -->
    <script>
        $(document).ready(function() {
            $('#tabla-customer').DataTable({
                serverSide: true,
                responsive: true,
                "language": {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                        "first": "Primero",
                        "last": "Último"
                    }
                },
                ajax: {
                    url: "{{ route('customers.index') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'dni'
                    },
                    {
                        data: 'full_name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ]
            });
        });
    </script>

    <!-- Registrar customer -->
    <script>
        $("#frmRegistro").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('customers.store') }}',
                method: 'POST',
                dataType: 'json',
                data: new FormData($("#frmRegistro")[0]),
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#guardar').attr("disabled", true);
                    $('#guardar').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procensando...'
                    );
                },
                success: function(data) {
                    let mensaje = data.mensaje;
                    $("#frmRegistro")[0].reset();
                    toastr.success(mensaje, 'Nuevo Registro', {
                        timeOut: 3000
                    });
                    $('#tabla-customer').DataTable().ajax.reload();
                },
                complete: function() {
                    $('#guardar').text('REGISTRAR');
                    $('#guardar').attr("disabled", false);
                },
            });
        });
    </script>

    <!-- Editar customer -->
    <script>
        function editCustomer(cust_id) {
            $.get('customers/' + cust_id + '/edit', function(customer) {
                $('#update_cust_id').val(customer.id);
                $('#update_dni').val(customer.dni);
                $('#update_name').val(customer.name);
                $('#update_lastname').val(customer.lastname);
                $('#update_email').val(customer.email);
                $("input[name=_token]").val();
                $('#customer_edit_modal').modal('toggle');
            });
        }
    </script>

    <!-- Actualizar customer -->
    <script>
        $('#customer_edit_form').submit(function(e) {
            e.preventDefault();
            var cust_id = $('#update_cust_id').val();
            var cust_dni = $('#update_dni').val();
            var cust_name = $('#update_name').val();
            var cust_lastname = $('#update_lastname').val();
            var cust_email = $('#update_email').val();
            var _token2 = $("input[name=_token]").val();
            $.ajax({
                url: '{{ route('customers.actualizar') }}',
                type: "POST",
                data: {
                    id: cust_id,
                    dni: cust_dni,
                    name: cust_name,
                    lastname: cust_lastname,
                    email: cust_email,
                    _token: _token2
                },
                beforeSend: function() {
                    $('#actualizar').attr("disabled", true);
                    $('#actualizar').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procensando...'
                    );
                },
                success: function(data) {
                    let mensaje = data.mensaje;
                    $("#customer_edit_form")[0].reset();
                    $('#customer_edit_modal').modal('hide');
                    toastr.success(mensaje, 'Actualizar Registro', {
                        timeOut: 3000
                    });
                    $('#tabla-customer').DataTable().ajax.reload();
                },
                complete: function() {
                    $('#actualizar').text('REGISTRAR');
                    $('#actualizar').attr("disabled", false);
                },
            });
        });
    </script>

    <!-- Eliminar Customer -->
    <script>
        var cust_id;
        $(document).on('click', '.deleteCustomer', function() {
            cust_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#btnEliminar').click(function() {
            $.ajax({
                url: "customers/eliminar/" + cust_id,
                beforeSend: function() {
                    $('#btnEliminar').attr("disabled", true);
                    $('#btnEliminar').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Eliminando...'
                    );
                },
                success: function(data) {
                    $('#confirmModal').modal('hide');
                    toastr.error('El registro fue eliminado correctamente.',
                        'Eliminar Registro', {
                            timeOut: 3000
                        });
                    $('#tabla-customer').DataTable().ajax.reload();
                    $('#btnEliminar').attr("disabled", false);
                    $('#btnEliminar').text('Eliminar');
                }
            });
        });
    </script>
@endsection
