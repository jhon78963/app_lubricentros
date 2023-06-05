@extends('layout.template')

@section('title')
    <title>ZeroGRUPS | Ingreso Producto</title>
@endsection

@section('contenido')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Ingreso de<b> Mercadería</b></h2>
        </div>

        <div class="card-body">
            <div class="alert hidden" role="alert" style="display:none;"></div>
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
                            aria-controls="home" aria-selected="true">Lista de Compras</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="product-tab" data-toggle="tab" href="#product" role="tab"
                            aria-controls="profile" aria-selected="false">Ingresar Mercadería</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
                        <h3></h3>
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
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Total</th>
                                                <th data-priority="2" class="text-center">Acciones</th>
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
                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-5">
                                    <section class="content">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <h3 class="card-title">Mercadería</h3>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="date" name="orde_Date" id="orde_Date"
                                                            class="form-control text-center" required>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <select name="prod_id" id="select_prod_id"
                                                        class="form-control text-center selectProduct">
                                                        <option value="0">Nueva Mercadería</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->prod_id }}">
                                                                {{ $product->prod_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Categoría</label>
                                                            <select name="cate_id" id="cate_id"
                                                                class="form-control text-center" required>
                                                                <option value="0">Seleccione ...</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->cate_id }}">
                                                                        {{ $category->cate_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Mercadería</label>
                                                            <input type="text" class="form-control" id="prod_name"
                                                                name="prod_name" required readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Precio de Compra</label>
                                                            <input type="text" class="form-control text-center"
                                                                id="prod_purchasePrice" name="prod_purchasePrice" required
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Precio x Mayor</label>
                                                            <input type="text" class="form-control text-center"
                                                                id="prod_priceWholeSale" name="prod_priceWholeSale"
                                                                required readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputEmail1">Precio x Unidad</label>
                                                                    <input type="text" class="form-control text-center"
                                                                        id="prod_priceRatail" name="prod_priceRatail"
                                                                        required readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="exampleInputEmail1">Precio Mín x Unidad</label>
                                                                    <input type="text" class="form-control text-center"
                                                                        id="prod_priceMinRatail"
                                                                        name="prod_priceMinRatail" required readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                            <!-- Button trigger modal -->
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#addsizes">
                                                                Agregar Talla</button>
                                                            <table id="size_detail"
                                                                class="table table-striped table-bordered"
                                                                style="margin: 0 auto; width:100%;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center" scope="col">Código</th>
                                                                        <th class="text-center" scope="col">Talla</th>
                                                                        <th class="text-center" scope="col">Stock</th>
                                                                        <th class="text-center" scope="col">Opción</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

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
            </div>
            <!--fin container-->
        </div>
    </div>
@endsection
