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
        </div>

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
                                            <th data-priority="1" class="text-center">ID</th>
                                            <th data-priority="2" class="text-center">Fecha</th>
                                            <th class="text-center">Vendedor</th>
                                            <th class="text-center">Met. Pago</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td class="text-center">{{ $sale->id }}</td>
                                                <td class="text-center">{{ $sale->date_payment }}</td>
                                                <td class="text-center">Victor Tiburonsin Enrique León Paz</td>
                                                <td class="text-center">Contado</td>
                                                <td class="text-center">{{ $sale->total_payment }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('sales.show', $sale->id) }}"
                                                        class="btn btn-info">Ver</a>
                                                    <a href="{{ route('sales.pdf', $sale->id) }}" target="_blank"
                                                        class="btn btn-primary">PDF</a>
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
                    <h3></h3>
                    <br>
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="prod_salePrice">Datos del Producto</label>
                                                    <div class="row">
                                                        <div class="col-12"><select name="select-prod_id"
                                                                id="select-prod_id" class="form-control text-center">
                                                                <option style='display: none' value="0">
                                                                    Busqueda
                                                                    ...
                                                                </option>
                                                                @foreach ($products as $product)
                                                                    <option
                                                                        value="{{ $product->id }}_{{ $product->price }}">
                                                                        {{ $product->name }}</option>
                                                                @endforeach
                                                            </select></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="prod_id" id="prod_id">
                                            <input type="hidden" name="prod_name" id="prod_name">
                                            <div class="row" id="price_wholeSale">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="prod_stock" style="margin-left: 56px;">Stock</label>
                                                        <input type="text" id="prod_stock" name="prod_stock"
                                                            required="required" class="form-control text-center"
                                                            style="margin-left: 56px;" placeholder="Stock" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="prod_priceWholeSale"
                                                            style="margin-left: 56px;">P. Venta</label>
                                                        <input type="text" id="prod_priceRatail"
                                                            name="prod_priceRatail" required="required"
                                                            class="form-control text-center" placeholder="P. Venta"
                                                            style="margin-left: 56px;" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-8">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="sale_cantidad"
                                                                    style="margin-left: 56px;">Precio unit.</label>
                                                                <input type="text" id="sale_unitprice"
                                                                    name="sale_unitprice" class="form-control text-center"
                                                                    placeholder="Precio unit." style="margin-left: 56px;"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="sale_cantidad"
                                                                    style="margin-left: 56px;">Cantidad</label>
                                                                <input type="text" id="sale_cantidad"
                                                                    name="sale_cantidad" class="form-control text-center"
                                                                    placeholder="Cantidad" style="margin-left: 56px;"
                                                                    readonly>
                                                            </div>
                                                        </div>
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
                                                <input type="hidden" id="cust_nrodocumento" name="cust_nrodocumento">
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
@endsection

@section('css')
    <style>
        table thead {
            background-color: black;
            color: white;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('js/select_product_unidad.js') }}"></script>
    <script src="{{ asset('js/product_add.js') }}"></script>
    <script src="{{ asset('js/employee_select.js') }}"></script>
    <script src="{{ asset('js/consulta_dni.js') }}"></script>
@endsection
