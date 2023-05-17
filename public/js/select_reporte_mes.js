$(function () {
    $('#select-gasto_año').on('change', añoCambio);
    $('#select-gasto_mes').on('change', mesCambio);
});

function añoCambio() {
    var año = $(this).val();

    $.get('/api/sales/meses/' + año, function (data) {
        var html_select = '<option value="">Seleccione mes</option>'
        for (var i = 0; i < data.length; i++)
            html_select += '<option value="' + data[i].sale_paymentDate + '">' + data[i].Mes + '</option>';
        $('#select-gasto_mes').html(html_select);
    });
}

function mesCambio() {
    var año = $('#select-gasto_año').val();
    var mes = $('#select-gasto_mes').val();
    var ventas_totales = 0;
    var compras_totales = 0;
    var propios_totales = 0;
    var puesto_totales = 0;
    var ganancias_totales = 0;
    var gastos_totales = 0;
    var utilidad = 0;

    $.get('/api/sales/diarias/' + año + '/' + mes, function (data) {
        for (var i = 0; i < data.length; i++) {
            ventas_totales += Number(data[i].sdet_totalprice);
            compras_totales += Number(data[i].prod_purchasePrice);
        }
        ganancias_totales = ventas_totales - compras_totales;
        utilidad += Number(ganancias_totales);
        document.getElementById("sale_total").value = "S/. " + ventas_totales;
        document.getElementById("purchase_total").value = "S/. " + compras_totales;
        document.getElementById("ganancias_totales").value = "S/. " + ganancias_totales;
        document.getElementById("ganancias_totales_value").value = ganancias_totales;
        $('#g_totales').val("S/ " + utilidad);
    });

    $.get('/api/reporte/gastos/propios/' + año + '/' + mes, function (data) {
        for (var i = 0; i < data.length; i++) {
            propios_totales += Number(data[i].gasto_monto);
            gastos_totales += Number(data[i].gasto_monto);
        }
        document.getElementById("gastos_propios").value = "S/. " + propios_totales;
        document.getElementById("gastos_propios_value").value = propios_totales;
        document.getElementById("gastos_totales").value = "S/. " + gastos_totales;
        document.getElementById("gastos_totales_value").value = gastos_totales;
        utilidad -= Number(propios_totales);
        $('#g_totales').val("S/ " + utilidad);
    });

    $.get('/api/reporte/gastos/puesto/' + año + '/' + mes, function (data) {
        for (var i = 0; i < data.length; i++) {
            puesto_totales += Number(data[i].puesto_dinero);
            gastos_totales += Number(data[i].puesto_dinero);
        }
        document.getElementById("gastos_puestos").value = "S/. " + puesto_totales;
        document.getElementById("gastos_puestos_value").value = puesto_totales;
        document.getElementById("gastos_totales").value = "S/. " + gastos_totales;
        document.getElementById("gastos_totales_value").value = gastos_totales;
        utilidad -= Number(puesto_totales);
        $('#g_totales').val("S/ " + utilidad);
    });
}
