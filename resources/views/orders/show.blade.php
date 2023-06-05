@extends('layout.template')

@section('title')
    <title>
        ZeroGRUPS | Pedidos</title>
@endsection

@section('content')
    <div class="card">
        <!-- Main content -->
        <div class="card-body">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Lubricentros C&D
                        <small class="float-right">Fecha: {{ $date }}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    De
                    <address>
                        <strong>Lubricentro C&D</strong><br>
                        13006, AV. AMERICA SUR NRO. 1034 URB. PALERMO<br>
                        Trujillo 13006<br>
                        Celular: +51 939998491<br>
                        Email: lubricentrosCyD@gmail.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Pedido {{ $num_compra }}</b><br>
                    <br>
                    <b>Fecha de pedido:</b> {{ Carbon\Carbon::parse($order->date_order)->format('d/m/Y') }}<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cant.</th>
                                <th>Mercadería</th>
                                <th>Código</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_details as $order_detail)
                                <tr>
                                    <td>{{ $order_detail->quantity }}</td>
                                    <td>{{ $order_detail->product_name }}</td>
                                    <td>{{ $order_detail->product_id }}</td>
                                    <td>S/. {{ $order_detail->unit_price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">

                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Monto a Pagar</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>S/. {{ $order->total_payment }}</td>
                            </tr>
                            <tr>
                                <th>IGV (18%)</th>
                                <td>S/. 0</td>
                            </tr>
                            <tr>
                                <th>Envío:</th>
                                <td>S/. 0</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>S/. {{ $order->total_payment }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    {{-- <a href="{{ route('sales.print', $sale->sale_id) }}" rel="noopener" target="_blank"
                    class="btn btn-info"><i class="fas fa-print"></i> Print</a> --}}
                    <a href="{{ route('products.index') }}" class="btn btn-default float-right" style="margin-right: 5px;">
                        <i class="fas fa-reply fa-lg mr-2"></i> Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
