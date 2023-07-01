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
                        <a class="nav-link active" id="supplier-list-tab" data-toggle="tab" href="#supplier-list"
                            role="tab" aria-controls="home" aria-selected="true">Lista de Proveedores</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="supplier-store-tab" data-toggle="tab" href="#supplier-store" role="tab"
                            aria-controls="profile" aria-selected="false">Nuevo Proveedor</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="supplier-list" role="tabpanel"
                        aria-labelledby="supplier-list-tab">
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="tabla-supplier" class="table table-striped table-bordered table-hover nowrap"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center" data-priority="1">#</th>
                                                <th class="text-center" data-priority="2">Razón Social</th>
                                                <th class="text-center">Representante</th>
                                                <th class="text-center">Linea de Negocio</th>
                                                <th class="text-center">Telefono/Celular</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="supplier-store" role="tabpanel" aria-labelledby="supplier-store-tab">
                        <br>
                        <form id="frmRegistro">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="business_name">Razón Social</label>
                                        <input type="text" class="form-control" name="business_name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="business_representative">Representante</label>
                                        <input type="text" class="form-control" name="business_representative">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="line_business">Linea de Negocio</label>
                                <input type="text" class="form-control" name="line_business">
                            </div>

                            <div class="form-group">
                                <label for="phone">Telefono/Celular</label>
                                <input type="text" class="form-control" name="phone">
                            </div>

                            <button type="submit" class="btn btn-outline-success btn-round"
                                id="guardar">Registrar</button>
                        </form>
                    </div>
                </div>

                <!-- Modal actualizar supplier-->
                <div class="modal fade" id="supplier_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Editar Proveedor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="supplier_edit_form">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" id="update_supp_id" name="update_supp_id">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="business_name">Razón Social</label>
                                                <input type="text" class="form-control" name="business_name"
                                                    id="update_business_name">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="business_representative">Representante</label>
                                                <input type="text" class="form-control" name="business_representative"
                                                    id="update_business_representative">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="line_business">Linea de Negocio</label>
                                        <input type="text" class="form-control" name="line_business"
                                            id="update_line_business">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Telefono/Celular</label>
                                        <input type="text" class="form-control" name="phone" id="update_phone">
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

                <!-- Modal eliminar supplier -->
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

        #tabla-supplier tbody td:eq(0) {
            text-align: left;
        }

        #tabla-supplier tbody td {
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
            $('#tabla-supplier').DataTable({
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
                    url: "{{ route('suppliers.index') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'business_name'
                    },
                    {
                        data: 'business_representative'
                    },
                    {
                        data: 'line_business'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ]
            });
        });
    </script>

    <!-- Registrar supplier -->
    <script>
        $("#frmRegistro").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('suppliers.store') }}',
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
                    $('#tabla-supplier').DataTable().ajax.reload();
                },
                complete: function() {
                    $('#guardar').text('REGISTRAR');
                    $('#guardar').attr("disabled", false);
                },
            });
        });
    </script>

    <!-- Editar supplier -->
    <script>
        function editSupplier(supp_id) {
            $.get('suppliers/' + supp_id + '/edit', function(supplier) {
                $('#update_supp_id').val(supplier.id);
                $('#update_business_name').val(supplier.business_name);
                $('#update_business_representative').val(supplier.business_representative);
                $('#update_line_business').val(supplier.line_business);
                $('#update_phone').val(supplier.phone);
                $("input[name=_token]").val();
                $('#supplier_edit_modal').modal('toggle');
            });
        }
    </script>

    <!-- Actualizar supplier -->
    <script>
        $('#supplier_edit_form').submit(function(e) {
            e.preventDefault();
            var supp_id = $('#update_supp_id').val();
            var supp_business_name = $('#update_business_name').val();
            var supp_business_representative = $('#update_business_representative').val();
            var supp_line_business = $('#update_line_business').val();
            var supp_phone = $('#update_phone').val();
            var _token2 = $("input[name=_token]").val();
            $.ajax({
                url: '{{ route('suppliers.actualizar') }}',
                type: "POST",
                data: {
                    id: supp_id,
                    business_name: supp_business_representative,
                    business_representative: supp_business_representative,
                    line_business: supp_line_business,
                    phone: supp_phone,
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
                    $("#supplier_edit_form")[0].reset();
                    $('#supplier_edit_modal').modal('hide');
                    toastr.success(mensaje, 'Actualizar Registro', {
                        timeOut: 3000
                    });
                    $('#tabla-supplier').DataTable().ajax.reload();
                },
                complete: function() {
                    $('#actualizar').text('REGISTRAR');
                    $('#actualizar').attr("disabled", false);
                },
            });
        });
    </script>

    <!-- Eliminar supplier -->
    <script>
        var supp_id;
        $(document).on('click', '.deleteSupplier', function() {
            supp_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#btnEliminar').click(function() {
            $.ajax({
                url: "suppliers/eliminar/" + supp_id,
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
                    $('#tabla-supplier').DataTable().ajax.reload();
                    $('#btnEliminar').attr("disabled", false);
                    $('#btnEliminar').text('Eliminar');
                }
            });
        });
    </script>
@endsection
