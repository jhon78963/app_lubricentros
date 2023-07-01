$(function () {
    $('#select-sale_año').on('change', añoCambio);
    $('#select-sale_mes').on('change', mesCambio);
    $('#select-nro_sale_año').on('change', añoVentaCambio);
    $('#select-nro_sale_mes').on('change', mesVentaCambio);
    $('#select-empl_id_sale').on('change', ventaCambio);
});

function añoCambio() {
    var año = $(this).val();

    $.get('/api/sales/meses/' + año, function (data) {
        var html_select = '<option value="">Seleccione mes</option>'
        for (var i = 0; i < data.length; i++)
            html_select += '<option value="' + data[i].sale_paymentDate + '">' + data[i].Mes + '</option>';
        $('#select-sale_mes').html(html_select);
    });
}

function mesCambio() {
    var mes = $('#select-sale_mes').val();
    var año = $('#select-sale_año').val();
    var ventas_totales = 0;
    var compras_totales = 0;
    var ganancias_totales;
    $.get('/api/sales/diarias/' + año + '/' + mes, function (data) {
        for (var i = 0; i < data.length; i++) {
            ventas_totales += Number(data[i].sdet_totalprice);
            compras_totales += Number(data[i].prod_purchasePrice);
        }
        ganancias_totales = ventas_totales - compras_totales;
        document.getElementById("sale_total").value = "S/ " + ventas_totales;
        document.getElementById("purchase_total").value = "S/ " + compras_totales;
        document.getElementById("ganancias_totales").value = "S/ " + ganancias_totales;
    });
}

function añoVentaCambio() {
    var año = $(this).val();
    $('#nro_sales').val("");
    $('#nro_sales_total').val("");
    $.get('/api/sales/meses/' + año, function (data) {
        if (año !=0) {
            var html_select = '<option value="0">Seleccione mes</option>'
            for (var i = 0; i < data.length; i++)
                html_select += '<option value="' + data[i].sale_paymentDate + '">' + data[i].Mes + '</option>';
            $('#select-nro_sale_mes').html(html_select);
        } else {
            var html_select = '<option value="0">Seleccione mes</option>'
            $('#select-nro_sale_mes').html(html_select);

            var html_select1 = '<option value="0">Seleccione personal</option>'
            $('#select-empl_id_sale').html(html_select1);
        }

    });

}

function mesVentaCambio() {
    var mes = $('#select-nro_sale_mes').val();
    $('#nro_sales').val("");
    $('#nro_sales_total').val("");
    $.get('/api/sales/mensuales/' + mes, function (data) {
        if (mes !=0) {
            var html_select = '<option value="0">Seleccione personal</option>'
            for (var i = 0; i < data.length; i++)
                html_select += '<option value="' + data[i].employee_id + '">' + data[i].empl_fullName + '</option>';
            $('#select-empl_id_sale').html(html_select);
        } else {
            var html_select = '<option value="0">Seleccione personal</option>'
            $('#select-empl_id_sale').html(html_select);
        }

    });
}

function ventaCambio() {
    var empl_id = $('#select-empl_id_sale').val();
    var mes = $('#select-nro_sale_mes').val();
    var año = $('#select-nro_sale_año').val();
    $('#nro_sales').val("");
    $('#nro_sales_total').val("");

    if (empl_id != 0) {
        $.get('/api/sale/numero/' + empl_id + '/employee/' + mes + '/' + año, function (data) {
            $('#nro_sales').val(data);
        });

        $.get('/api/sale/total/' + empl_id + '/employee/' + mes + '/' + año, function (data) {
            $('#nro_sales_total').val("S/ " + data);
        });
    } else {
        return false;
    }


}
