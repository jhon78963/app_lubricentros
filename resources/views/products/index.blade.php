@extends('layout.template')

@section('title')
    <title>Lubricentro | Products</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Gestión de<b> Almacén</b></h2>
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
                        <a class="nav-link active" id="product-list-tab" data-toggle="tab" href="#product-list"
                            role="tab" aria-controls="home" aria-selected="true">Lista de Productos/Servicios</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="product-store-tab" data-toggle="tab" href="#product-store" role="tab"
                            aria-controls="profile" aria-selected="false">Nuevo Producto/Servicio</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="category-tab" data-toggle="tab" href="#category" role="tab"
                            aria-controls="profile" aria-selected="false">Categorías</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="order-list-tab" data-toggle="tab" href="#order-list" role="tab"
                            aria-controls="profile" aria-selected="false">Lista de pedidos</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="order-store-tab" data-toggle="tab" href="#order-store" role="tab"
                            aria-controls="profile" aria-selected="false">Nuevo Pedido</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="product-list" role="tabpanel"
                        aria-labelledby="product-list-tab">
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="tabla-product" class="table table-striped table-bordered table-hover nowrap"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center" data-priority="1">#</th>
                                                <th class="text-center" data-priority="2">Categoría</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Stock</th>
                                                <th class="text-center">Precio</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="product-store" role="tabpanel" aria-labelledby="product-store-tab">
                        <br>
                        <form id="frmRegistro">
                            @csrf
                            <div class="form-group">
                                <label for="category_name">Categoría</label>
                                <select class="form-control selectCategory" name="category_id" id="create_category_id"
                                    required>
                                    <option value="">Seleccione ...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="category_name">Código de barras</label>
                                        <input type="text" class="form-control" name="code_bar">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="category_name">Producto</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_name">Stock</label>
                                <input type="text" class="form-control" name="stock">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name">Precio de Compra</label>
                                        <input type="text" class="form-control" name="purchase_price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name">Precio de Venta</label>
                                        <input type="text" class="form-control" name="sale_price">
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-outline-success btn-round"
                                id="guardar">Registrar</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
                        <br>
                        <div class="container-fluid">
                            <button class="btn btn-primary" data-toggle="modal"
                                data-target="#create_category">CREAR</button>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="tabla-category"
                                        class="table table-striped table-bordered table-hover nowrap" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center" data-priority="1">#</th>
                                                <th data-priority="2">Categoría</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="order-list" role="tabpanel" aria-labelledby="order-list-tab">
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table id="tabla-order" class="table table-striped table-bordered table-hover nowrap"
                                        cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th data-priority="1" class="text-center">ID</th>
                                                <th class="text-center">Fecha</th>
                                                <th class="text-center">Proveedor</th>
                                                <th class="text-center">Total</th>
                                                <th data-priority="2" class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="order-store" role="tabpanel" aria-labelledby="order-store-tab">
                        <br>
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-5">
                                    <section class="content">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h3 class="card-title">Producto</h3>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="date" name="date_order" id="date_order"
                                                            class="form-control text-center" required>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <select name="prod_id" id="select_prod_id"
                                                        class="form-control text-center selectProduct">
                                                        <option value="0">Nuevo Producto</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">
                                                                {{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Proveedor</label>
                                                    <select name="supplier_id" id="supplier_id"
                                                        class="form-control text-center selectSupplier" required>
                                                        <option value="">Seleccione ...</option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">
                                                                {{ $supplier->business_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="update ml-auto mr-auto">
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-round">Registrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-7">
                                    <section class="content">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Ingresar Stock</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-primary"
                                                                onclick="limpiar();">Limpiar</button>
                                                            <table id="product-detail"
                                                                class="table table-striped table-bordered"
                                                                style="margin: 0 auto; width:100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center" scope="col">Código</th>
                                                                        <th class="text-center" scope="col">Producto
                                                                        </th>
                                                                        <th class="text-center" scope="col">Stock</th>
                                                                        <th class="text-center" scope="col">Opción</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <td class="text-center" colspan="4"
                                                                        id="cabecera">Seleccione productos</td>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal actualizar producto-->
                <div class="modal fade" id="product_edit_modal" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Editar Mercadería</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <form id="product_edit_form">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" id="update_prod_id" name="update_prod_id">
                                    <div class="form-group">
                                        <label for="category_name">Categoría</label>
                                        <select class="form-control selectCategory" name="category_id"
                                            id="update_category_id" required>
                                            <option value="">Seleccione ...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="category_name">Código de barras</label>
                                                <input type="text" class="form-control" name="code_bar"
                                                    id="update_code_bar">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="category_name">Producto</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="update_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_name">Stock</label>
                                        <input type="text" class="form-control" name="stock" id="update_stock">
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="category_name">Precio de Compra</label>
                                                <input type="text" class="form-control" name="purchase_price"
                                                    id="update_purchase_price">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="category_name">Precio de Venta</label>
                                                <input type="text" class="form-control" name="sale_price"
                                                    id="update_sale_price">
                                            </div>
                                        </div>
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

                <!-- Modal eliminar producto -->
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

                <!-- Modal crear categoría -->
                <div class="modal fade" id="create_category" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear categoría</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="frm_create_category">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="category_name">Categoría</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">CANCELAR</button>
                                    <button type="submit" class="btn btn-primary" id="btnGuardarCate">GUARDAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal editar categoría -->
                <div class="modal fade" id="category_edit_modal" data-backdrop="static" data-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Editar Categoría</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="category_edit_form">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" id="update_cate_id" name="update_cate_id">

                                    <div class="form-group">
                                        <label for="category_name">Categoría</label>
                                        <input type="text" class="form-control" name="name" id="update_cate_name">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary"
                                        id="btnActualizarCate">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal eliminar categoría -->
                <div class="modal fade" id="category_delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                <button type="button" id="btnEliminarCate" name="btnEliminarCate"
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/select_product.js') }}"></script>

    <!-- Select 2 -->
    <script>
        $(function() {
            $('.selectCategory').select2({
                theme: 'bootstrap4'
            });

            $('.selectProduct').select2({
                theme: 'bootstrap4'
            });

            $('.selectSupplier').select2({
                theme: 'bootstrap4'
            });
        })
    </script>

    <!-- Data tables -->
    <script>
        $(document).ready(function() {
            $('#tabla-product').DataTable({
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
                    url: "{{ route('products.index') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'category_name'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'stock'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ]
            });

            $('#tabla-category').DataTable({
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
                    url: "{{ route('categories.index') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ]
            });

            $('#tabla-order').DataTable({
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
                    url: "{{ route('orders.index') }}",
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'date_order'
                    },
                    {
                        data: 'business_representative'
                    },
                    {
                        data: 'total_payment'
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ]
            });
        });
    </script>

    <!-- Registrar producto -->
    <script>
        $("#frmRegistro").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('products.store') }}',
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
                    let prod_id = data.prod_id;
                    let prod_name = data.prod_name;
                    $("#frmRegistro")[0].reset();
                    $('#create_category_id').val(null).trigger('change');
                    toastr.success(mensaje, 'Nuevo Registro', {
                        timeOut: 3000
                    });
                    $('#tabla-product').DataTable().ajax.reload();

                    var select = $('#select_prod_id');
                    var nuevaOpcion = $('<option>', {
                        value: prod_id,
                        text: prod_name
                    });
                    select.append(nuevaOpcion);
                },
                complete: function() {
                    $('#guardar').text('REGISTRAR');
                    $('#guardar').attr("disabled", false);
                },
            });
        });
    </script>

    <!-- Editar producto -->
    <script>
        function editProduct(prod_id) {
            $.get('products/' + prod_id + '/edit', function(product) {
                $('#update_prod_id').val(product[0].id);
                $('#update_category_id').val(product[0].category_id).trigger('change');
                $('#update_code_bar').val(product[0].code_bar);
                $('#update_name').val(product[0].name);
                $('#update_stock').val(product[0].stock);
                $('#update_purchase_price').val(product[0].purchase_price);
                $('#update_sale_price').val(product[0].sale_price);
                $("input[name=_token]").val();
                $('#product_edit_modal').modal('toggle');
            });
        }
    </script>

    <!-- Actualizar producto -->
    <script>
        $('#product_edit_form').submit(function(e) {
            e.preventDefault();
            var prod_id = $('#update_prod_id').val();
            var prod_code_bar = $('#update_code_bar').val();
            var prod_name = $('#update_name').val();
            var prod_stock = $('#update_stock').val();
            var prod_purchase_price = $('#update_purchase_price').val();
            var prod_sale_price = $('#update_sale_price').val();
            var cate_id = $('#update_category_id').val();
            var _token2 = $("input[name=_token]").val();
            $.ajax({
                url: '{{ route('products.actualizar') }}',
                type: "POST",
                data: {
                    id: prod_id,
                    code_bar: prod_code_bar,
                    name: prod_name,
                    stock: prod_stock,
                    purchase_price: prod_purchase_price,
                    sale_price: prod_sale_price,
                    category_id: cate_id,
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
                    $("#product_edit_form")[0].reset();
                    $('#product_edit_modal').modal('hide');
                    toastr.success(mensaje, 'Actualizar Registro', {
                        timeOut: 3000
                    });
                    $('#tabla-product').DataTable().ajax.reload();
                },
                complete: function() {
                    $('#actualizar').text('REGISTRAR');
                    $('#actualizar').attr("disabled", false);
                },
            });
        });
    </script>

    <!-- Eliminar producto -->
    <script>
        var prod_id;
        $(document).on('click', '.deleteProduct', function() {
            prod_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#btnEliminar').click(function() {
            $.ajax({
                url: "products/eliminar/" + prod_id,
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
                    $('#tabla-product').DataTable().ajax.reload();
                    $('#btnEliminar').attr("disabled", false);
                    $('#btnEliminar').text('Eliminar');
                }
            });
        });
    </script>

    <!-- Registrar categoría -->
    <script>
        $("#frm_create_category").on("submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('categories.store') }}',
                method: 'POST',
                dataType: 'json',
                data: new FormData($("#frm_create_category")[0]),
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnGuardarCate').attr("disabled", true);
                    $('#btnGuardarCate').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procensando...'
                    );
                },
                success: function(data) {
                    let mensaje = data.mensaje;
                    let cate_id = data.cate_id;
                    let cate_name = data.cate_name;
                    $("#frm_create_category")[0].reset();
                    toastr.success(mensaje, 'Nuevo Registro', {
                        timeOut: 3000
                    });
                    $('#create_category').modal('hide');
                    $('#tabla-category').DataTable().ajax.reload();

                    var select2 = $('#create_category_id');
                    var nuevaOpcion = $('<option>', {
                        value: cate_id,
                        text: cate_name
                    });
                    select2.append(nuevaOpcion);
                    select2.trigger('change');

                    var select1 = $('#update_category_id');
                    var nuevaOpcion = $('<option>', {
                        value: cate_id,
                        text: cate_name
                    });
                    select1.append(nuevaOpcion);
                    select1.trigger('change');

                    var select3 = $('#cate_id');
                    var nuevaOpcion = $('<option>', {
                        value: cate_id,
                        text: cate_name
                    });
                    select3.append(nuevaOpcion);
                    select3.trigger('change');
                },
                complete: function() {
                    $('#btnGuardarCate').text('REGISTRAR');
                    $('#btnGuardarCate').attr("disabled", false);
                },
            });
        });
    </script>

    <!-- Editar categoría -->
    <script>
        function editCategory(cate_id) {
            $.get('categories/' + cate_id + '/edit', function(category) {
                $('#update_cate_id').val(category.id);
                $('#update_cate_name').val(category.name);
                $("input[name=_token]").val();
                $('#category_edit_modal').modal('toggle');
            });
        }
    </script>

    <!-- Actualizar categoría -->
    <script>
        $('#category_edit_form').submit(function(e) {
            e.preventDefault();
            var cate_id = $('#update_cate_id').val();
            var cate_name = $('#update_cate_name').val();
            var _token2 = $("input[name=_token]").val();
            $.ajax({
                url: '{{ route('categories.actualizar') }}',
                type: "POST",
                data: {
                    id: cate_id,
                    name: cate_name,
                    _token: _token2
                },
                beforeSend: function() {
                    $('#btnActualizarCate').attr("disabled", true);
                    $('#btnActualizarCate').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procensando...'
                    );
                },
                success: function(data) {
                    let mensaje = data.mensaje;
                    $("#category_edit_form")[0].reset();
                    $('#category_edit_modal').modal('hide');
                    toastr.success(mensaje, 'Actualizar Registro', {
                        timeOut: 3000
                    });
                    $('#tabla-category').DataTable().ajax.reload();
                },
                complete: function() {
                    $('#btnActualizarCate').text('REGISTRAR');
                    $('#btnActualizarCate').attr("disabled", false);
                },
            });
        });
    </script>

    <!-- Eliminar categoría -->
    <script>
        var cate_id;
        $(document).on('click', '.deleteCategory', function() {
            cate_id = $(this).attr('id');
            $('#category_delete_modal').modal('show');
        });

        $('#btnEliminarCate').click(function() {
            $.ajax({
                url: "categories/eliminar/" + cate_id,
                beforeSend: function() {
                    $('#btnEliminarCate').attr("disabled", true);
                    $('#btnEliminarCate').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Eliminando...'
                    );
                },
                success: function(data) {
                    $('#category_delete_modal').modal('hide');
                    toastr.error('El registro fue eliminado correctamente.',
                        'Eliminar Registro', {
                            timeOut: 3000
                        });
                    $('#tabla-category').DataTable().ajax.reload();
                    $('#create_category_id option[value="' + cate_id + '"]').remove();
                    $('#update_category_id option[value="' + cate_id + '"]').remove();
                },
                complete: function() {
                    $('#btnEliminarCate').attr("disabled", false);
                    $('#btnEliminarCate').text('Eliminar');
                },
            });
        });
    </script>

    <!-- Redireccionar detalle -->
    <script>
        function goShow(orde_id) {
            window.location.href = '/orders/' + orde_id;
        }
    </script>
@endsection
