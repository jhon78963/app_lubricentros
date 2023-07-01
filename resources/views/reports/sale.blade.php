@extends('layout.template')

@section('title')
    <title>Lubricentro | Reportes</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Gestión de<b> Almacén</b></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Ventas <b>Mensuales</b></h2>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-6">
                                    <select name="sale_año" id="select-sale_año" class="form-control text-center">
                                        <option value="0">seleccione año</option>
                                        @foreach ($año_ventas as $año_venta)
                                            <option value="{{ $año_venta->sale_paymentDate }}">
                                                {{ $año_venta->sale_paymentDate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="sale_mes" id="select-sale_mes" class="form-control text-center">
                                        <option value="0">Seleccione mes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Total Ventas</label>
                                        <input type="text" name="sale_total" id="sale_total"
                                            class="form-control text-center">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="">Total Compras</label>
                                    <input type="text" name="purchase_total" id="purchase_total"
                                        class="form-control text-center">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Ganancias Totales</label>
                                        <input type="text" name="ganancias_totales" id="ganancias_totales"
                                            class="form-control text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Número de Ventas <b>Mensuales</b></h2>
                        </div>
                        <div class="card-body">
                            <form id="form">
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <select name="sale_año" id="select-nro_sale_año" class="form-control text-center">
                                            <option value="0">seleccione año</option>
                                            @foreach ($año_ventas as $año_venta)
                                                <option value="{{ $año_venta->sale_paymentDate }}">
                                                    {{ $año_venta->sale_paymentDate }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <select name="sale_mes" id="select-nro_sale_mes" class="form-control text-center">
                                            <option value="0">Seleccione mes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-8" style="padding-left: 0;">
                                        <div class="form-group">
                                            <select name="empl_id" id="select-empl_id_sale"
                                                class="form-control text-center">
                                                <option value="0">Seleccione empleado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Nro Total Ventas</label>
                                            <input type="text" name="nro_sales" id="nro_sales"
                                                class="form-control text-center">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="">Total Ventas</label>
                                        <input type="text" name="nro_sales_total" id="nro_sales_total"
                                            class="form-control text-center">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Ventas <b>Mensuales</b></h2>
                        </div>
                        <div class="card-body">
                            <canvas id="chart-ventas_mensuales"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Ventas <b>Diarias</b></h2>
                        </div>
                        <div class="card-body">
                            <canvas id="chart-ventas_diarias"></canvas>
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

        #tabla-pago_personal tbody td:eq(0) {
            text-align: left;
        }

        #tabla-pago_personal tbody td {
            text-align: center;
        }

        #tabla-pago_personal {
            width: 100%;
            margin: 0 auto;
        }

        .centrar {
            text-align: center;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('js/select_venta_mes.js') }}"></script>
    <script src="{{ asset('js/select_pagos_mes.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ventasPorMes = @json($ventasPorMes);

        var dataVentasPorMes = {
            labels: ventasPorMes.map(venta => venta.month + '-' + venta.year),
            datasets: [{
                label: 'Ventas por mes',
                data: ventasPorMes.map(venta => venta.monto),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        var config = {
            responsive: true,
            plugins: {
                filler: {
                    propagate: false,
                },
            },
            interaction: {
                intersect: false,
            }
        };


        var ctx2 = document.getElementById('chart-ventas_mensuales').getContext('2d');
        var chartVentasPorMes = new Chart(ctx2, {
            type: 'bar',
            data: dataVentasPorMes,
            options: config
        });
    </script>

    <script>
        var ventasPorDia = @json($ventasPorDia);

        var dataVentasPorDia = {
            labels: ventasPorDia.map(venta => venta.fecha),
            datasets: [{
                label: 'Ventas por día',
                data: ventasPorDia.map(venta => venta.monto),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        var config = {
            responsive: true,
            plugins: {
                filler: {
                    propagate: false,
                }
            },
            interaction: {
                intersect: false,
            },
        };

        var ctx = document.getElementById('chart-ventas_diarias').getContext('2d');
        var chartVentasPorDia = new Chart(ctx, {
            type: 'bar',
            data: dataVentasPorDia,
            options: config
        });
    </script>
@endsection
