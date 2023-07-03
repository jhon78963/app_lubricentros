<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Venta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>


    <div class="row">
        <div class="col-12">
            <h4>
                <i class="fas fa-globe"></i> Lubricentros C&D
                <b>Venta {{ $num_venta }}</b>
                <small class="float-right">Fecha: {{ $date }}</small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row">
        <div class="col-4">
            De
            <address>
                <strong>Lubricentros C&D</strong><br>
                13006, Av. America<br>
                Trujillo 13006<br>
                Celular: +51 990638706<br>
                Email: lubricentrosc&d@gmail.com
            </address>
            <b>Fecha de pago:</b> {{ Carbon\Carbon::parse($sale->date_payment)->format('d/m/Y') }}<br>
            <b>Metodo de Pago:</b> Contado
        </div>
    </div>
    <br>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
