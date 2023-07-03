<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket de Venta</title>
    <style>
        @page {
            size: 105mm 160mm;
            /* Ancho y alto del ticket */
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 10px;
            line-height: 1.4;
            text-align: center;
        }

        .header {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .body {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 10px;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            border-bottom: 1px #ccc;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-name {
            flex: 1;
            text-align: left;
        }

        .item-quantity,
        .item-price {
            flex: 0.3;
            text-align: left;
        }

        .subtotal-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            border-top: 1px;
            padding-top: 5px;
        }

        .total-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 10px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }

        .table-row {
            border-bottom: 1px solid #000;
        }

        .total-label {
            font-weight: bold;
            flex: 1;
            text-align: right;
        }

        .total-value {
            font-weight: bold;
            flex: 0.5;
            text-align: right;
            white-space: pre-line;
        }

        text {
            display: none;
        }
    </style>
</head>

<body>
    <div class="header">NOVEDADES MARITEX</div>
    <div class="info">
        <strong>Mercado Mayorista Puesto C-74</strong>
        <br>
        <strong>Trujillo - La Libertad</strong>
        <br>
        <strong>Cel: 900057350</strong>
        <br>
        <strong>Email: novedadesmaritex@gmail.com</strong>
    </div>

    <div class="total-row"></div>

    <div class="header">NOTA DE VENTA ELECTRÓNICA</div>
    <div class="body">
        N001 - {{ $nro_venta }}
        <br>
        Fecha de emisión: {{ $fecha }}
        <br>
        Señor(a): {{ $clie_nombre }}
        <br>
        @if ($clie_dni != null)
            {{ $clie_dni }}
        @endif
    </div>

    <div class="total-row"></div>

    <div class="item-row table-row">
        <div class="item-quantity" style="font-weight: bold;">Cant.</div>
        <div class="item-name" style="font-weight: bold;">Descripción</div>
        <div class="item-price" style="font-weight: bold;">Precio</div>
        <div class="item-price" style="font-weight: bold;">Importe</div>
    </div>
    <div class="table-row">
        @foreach ($productos as $producto)
            <div class="item-row">
                <div class="item-quantity" style="font-weight: bold;">{{ $producto->sdet_quantity }}</div>
                <div class="item-name" style="font-weight: bold;">{{ $producto->prod_name }}</div>
                <div class="item-price" style="font-weight: bold;">S/ {{ $producto->sdet_unitprice }}</div>
                <div class="item-price" style="font-weight: bold;">S/ {{ $producto->sdet_totalprice }}</div>
            </div>
        @endforeach
    </div>
    <div style="margin-top: 10px;">
        <div class="subtotal-row">
            <div class="total-label">SubTotal:</div>
            <div class="total-value">S/ {!! number_format((float) $op_grabada, 2) !!}</div>
        </div>
        <div class="subtotal-row">
            <div class="total-label">IGV (18%):</div>
            <div class="total-value">{!! number_format((float) $igv, 2) !!}</div>
        </div>
        <div class="subtotal-row">
            <div class="total-label">TOTAL:</div>
            <div class="total-value">{!! number_format((float) $total, 2) !!}</div>
        </div>
    </div>

    <div class="total-row"></div>

    <div class="body" style="text-align: left; font-weight: bold;">
        SON: {{ $enLetras->numletras($total, 'SOLES') }}
    </div>

    <div class="total-row"></div>

    <div class="body" style="margin-bottom: 5px;">
        <div style="margin-top: 10px; font-weight: bold;">
            Pago: {{ $metodo }}
            <br>
            Atendido por: {{ $empl_nombre }}
            <br>

            Gracias por su compra
            <br>
        </div>

        <div style="margin-top: 10px">
            {!! DNS2D::getBarcodeSVG($codebar, 'QRCODE') !!}
        </div>

    </div>


</body>

</html>
