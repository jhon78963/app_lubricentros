@extends('layout.template')

@section('title')
    <title>Lubricentro | Ventas</title>
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
                            aria-controls="home" aria-selected="true">Lista de Ventas</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" role="tab"
                            aria-controls="profile" aria-selected="false">Nueva Venta</a>
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
                                                <th data-priority="1" class="text-center">#</th>
                                                <th data-priority="2" class="text-center">Fecha</th>
                                                <th class="text-center">Vendedor</th>
                                                <th class="text-center">Met. Pago</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                        <h3></h3>
                        <br>
                        <form id="frmRegistro">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="alert hidden" role="alert" style="display:none;"></div>
                                    </div>

                                    <div class="row" id="alertError" style="display: none;">
                                        <div class="alert alert-danger" role="alert">
                                            <p>Whoops! Ocurrieron algunos errores</p>
                                            <ul id="listaErrores">

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="prod_salePrice">Datos del Producto</label>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control"
                                                                        name="product_id" id="select-prod_id">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="prod_id" id="prod_id">
                                                <input type="hidden" name="prod_name" id="prod_name">
                                                <div class="row" id="price_wholeSale">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="prod_stock">Stock</label>
                                                            <input type="text" id="prod_stock" name="prod_stock"
                                                                required="required"
                                                                class="form-control text-center"placeholder="Stock"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="prod_priceWholeSale">P. Venta</label>
                                                            <input type="text" id="prod_priceRatail"
                                                                name="prod_priceRatail" required="required"
                                                                class="form-control text-center"
                                                                placeholder="P. Venta"readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="sale_cantidad">Precio unit.</label>
                                                            <input type="text" id="sale_unitprice"
                                                                name="sale_unitprice" class="form-control text-center"
                                                                placeholder="Precio unit." readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="sale_cantidad">Cantidad</label>
                                                            <input type="text" id="sale_cantidad" name="sale_cantidad"
                                                                class="form-control text-center"
                                                                placeholder="Cantidad"readonly>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="update ml-auto mr-auto">
                                                    <button type="button" id="adicionar"
                                                        class="btn btn-outline-info btn-round">agregar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="carrito">
                                        <table class="table table-bordered" id="mytable">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="10px">Cant.</th>
                                                    <th class="text-center" width="200px">Mercadería</th>
                                                    <th class="text-center" width="10px">P. Unit.</th>
                                                    <th class="text-center" width="10px">Total</th>
                                                    <th width="5px"> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td colspan="7" class="text-center" id="inicio_tabla">Seleccione
                                                    producto
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="update ml-auto mr-auto">
                                            <button type="submit" class="btn btn-outline-success btn-round"
                                                id="guardar">Registrar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card" style="background: black;">
                                        <div class="card-body">
                                            <input type="hidden" id="total_save" name="total_save">
                                            <input type="text"
                                                style="color:#11f314; background:black; border:0; font-size: 40px;"
                                                class="form-control text-center" id="total" name="total"
                                                value="S/. 0" readonly>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div id="colaborador">
                                                        <div class="form-group">
                                                            <label for="prod_salePrice"
                                                                style="margin-left:122.955px;">Colaborador</label>
                                                            <select name="empl_id" id="select-empl_id"
                                                                class="form-control text-center" required>
                                                                <option value="0">Seleccione ...</option>
                                                                @foreach ($employees as $employee)
                                                                    <option value="{{ $employee->id }}">
                                                                        {{ $employee->name }}
                                                                        {{ $employee->lastname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="prod_salePrice" style="margin-left:122.17px;">Nro
                                                            de
                                                            Venta</label>
                                                        <input type="text" id="num_venta" name="num_venta"
                                                            required="required" class="form-control text-center"
                                                            value="0" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="prod_salePrice">DNI del Cliente (Opcional)</label>
                                                <input type="text" id="select-cust_dni" name="cust_dni"
                                                    class="form-control" placeholder="PUBLICO GENERAL">
                                            </div>
                                            <div id="form-customer" style="display: none;">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="prod_salePrice">Apellido Paterno</label>
                                                            <input type="text" id="cust_apellidoPaterno"
                                                                name="cust_apellidoPaterno" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="prod_salePrice">Apellido Materno</label>
                                                            <input type="text" id="cust_apellidoMaterno"
                                                                name="cust_apellidoMaterno" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_salePrice">Nombres</label>
                                                    <input type="text" id="cust_name" name="cust_name"
                                                        class="form-control" readonly>
                                                    <input type="hidden" id="cust_nrodocumento"
                                                        name="cust_nrodocumento">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="prod_salePrice" style="margin-top: 8.72px;">Forma
                                                            de
                                                            Pago</label>
                                                    </div>
                                                    <div class="col-5">
                                                        <select name="pmet_id" id="select-pmet_id"
                                                            class="form-control text-center" required>
                                                            <option value="">Seleccione ...</option>
                                                            <option value="1">Contado</option>
                                                            <option value="2">POS</option>
                                                            <option value="3">Yape</option>
                                                            <option value="4">Transferencia</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" id="form_efectivo">
                                        <div class="card-body">

                                            <div class="row mb-4">
                                                <div class="col-6">
                                                    <label style="margin-top: 8.72px;">Efectivo: </label>
                                                </div>
                                                <div class="col-4">
                                                    <p style="text-align: right; margin-top: 7px;"><b>S/ </b>
                                                    <p>
                                                </div>
                                                <div class="col-2">

                                                    <input class="form-control text-center" name="sale_efectivo"
                                                        id="sale_efectivo" style="text-align: right;" placeholder="0"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-10">
                                                    <div class="card" style="background: #ffcc0f;">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-8">
                                                                    <h3
                                                                        style="text-align: left; color:black; margin-top: 2.72px;">
                                                                        <b>Vuelto:</b>
                                                                    </h3>
                                                                </div>
                                                                <div class="col-4">
                                                                    <input type="hidden" id="vuelto_save"
                                                                        name="vuelto_save">
                                                                    <input type="text"
                                                                        style="color:black; background:#ffcc0f; border:0; font-size: 1.75rem; text-align: right; font-weight: bold; margin-top: 0.72px;"
                                                                        class="form-control text-center" id="vuelto"
                                                                        name="vuelto" name="total" value="S/. 0"
                                                                        readonly>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card" id="form_yape">
                                        <div class="card-body">
                                            <p class="text-center">Nro YAPE
                                            <h1 class="text-center"><b>990638706</b></h1>
                                            </p>
                                            <p class="text-center">NOMBRE: Victor Tiburonsin Enrique León Paz</p>
                                        </div>
                                    </div>
                                    <div class="card" id="form_transferencia">
                                        <div class="card-body">
                                            <p class="text-center">BCP
                                            <h1 class="text-center"><b>570-01051498-0-73</b></h1>
                                            </p>
                                            <p class="text-center">TITULAR: Victor Tiburonsin Enrique León Paz</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- Modal eliminar -->
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
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        table thead {
            background-color: black;
            color: white;
        }

        #tabla-sale tbody td:eq(0) {
            text-align: left;
        }

        #tabla-sale tbody td {
            text-align: center;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/select_product_unidad.js') }}"></script>
    <script src="{{ asset('js/product_add.js') }}"></script>
    <script src="{{ asset('js/employee_select.js') }}"></script>
    <script src="{{ asset('js/consulta_dni.js') }}"></script>
    <script src="{{ asset('js/product_search.js') }}"></script>

    <!-- Data tables -->
    <script>
        $(document).ready(function() {
            $('#tabla-sale').DataTable({
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
                    url: "{{ route('sales.index') }}",
                },
                order: [
                    [0, 'desc']
                ],
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'date_payment'
                    },
                    {
                        data: 'full_name'
                    },
                    {
                        data: 'method_payment'
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

    <!-- Select 2 -->
    <script>
        $(function() {
            $('.selectProduct').select2({
                theme: 'bootstrap4'
            });
        })
    </script>

    {{-- CREAR --}}
    <script>
        $(function() {
            enviarRegistro();
        });

        var enviarRegistro = function() {
            let sale_id;
            $("#frmRegistro").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('sales.guardar') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: new FormData($("#frmRegistro")[0]),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#alertError").hide();
                        $('#guardar').attr("disabled", true);
                        $('#guardar').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procensando...'
                        );
                    },
                    success: function(data) {
                        let mensaje = data.mensaje;
                        sale_id = data.sale_id;
                        $("#frmRegistro")[0].reset();
                        $('#tabla-sale').DataTable().ajax.reload();
                    },
                    complete: function() {
                        $("#form_efectivo").hide();
                        $("#form_yape").hide();
                        $("#form_transferencia").hide();
                        document.getElementById("total").value = "S/. 0";
                        document.getElementById("total_save").value = 0;
                        for (var i = 1; i < 100; i++) {
                            $('#row' + i + '').remove();
                        }
                        $("#inicio_tabla").show();
                        $('#guardar').text('REGISTRAR');
                        $('#guardar').attr("disabled", false);

                        let timerInterval
                        Swal.fire({
                            title: 'Venta exitosa!',
                            html: 'Generando comprobante de pago en <b></b> milisegundos.',
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                let comprobante_url = "/download-sales/" + sale_id + "";
                                $.get(comprobante_url, function(data) {
                                    // Crear una nueva ventana y cargar el contenido HTML
                                    let printWindow = window.open('', '',
                                        'height=800,width=1000');
                                    printWindow.document.write(data);
                                    printWindow.document.close();

                                    // Esperar a que se cargue el contenido y luego imprimirlo
                                    printWindow.onload = function() {
                                        printWindow.print();
                                        //printWindow.close();
                                    };
                                });
                            }
                        })
                    },
                });
            });
        }
    </script>
@endsection
