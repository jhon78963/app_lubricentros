@extends('layout.template')

@section('title')
    <title>Lubricentro | Ventas</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
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
                        <strong>Lubricentros C&D</strong><br>
                        13006, Av. America<br>
                        Trujillo 13006<br>
                        Celular: +51 990638706<br>
                        Email: lubricentrosc&d@gmail.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Venta {{ $num_venta }}</b><br>
                    <br>
                    <b>Fecha de pago:</b> {{ Carbon\Carbon::parse($sale->date_payment)->format('d/m/Y') }}<br>
                    <b>Metodo de Pago:</b> Contado
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
                                <th class="text-center">Cant.</th>
                                <th class="text-center">Mercadería</th>
                                <th class="text-center">Cod. #</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale_details as $sale_detail)
                                <tr>
                                    <td class="text-center">{{ $sale_detail->quantity }}</td>
                                    <td class="text-center">{{ $sale_detail->name }}</td>
                                    <td class="text-center">{{ $sale_detail->id }}</td>
                                    <td class="text-center">S/. {{ $sale_detail->totalprice }}</td>
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
                    <p class="lead">Monto Pagado
                        {{ Carbon\Carbon::parse($sale->date_payment)->format('d/m/Y') }}</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>S/. {{ $sale->total_payment }}</td>
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
                                <td>S/. {{ $sale->total_payment }}</td>
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
                    <a href="{{ route('sales.pdf', $sale->id) }}" rel="noopener" target="_blank" class="btn btn-info"><i
                            class="fas fa-print"></i>
                        Print</a>
                    <a href="{{ route('sales.index') }}" class="btn btn-default float-right" style="margin-right: 5px;">
                        <i class="fas fa-reply fa-lg mr-2"></i> Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
