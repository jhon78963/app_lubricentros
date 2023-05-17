$(function () {
    $('#select-pago_año').on('change', añoPagoCambio);
    $('#select-pago_mes').on('change', mesPagoCambio);
    $('#select-empl_id_pago').on('change', pagoCambio);
});

function añoPagoCambio() {
    var año = $(this).val();
    $.get('/api/pagos/meses/' + año, function (data) {
        var html_select = '<option value="">Seleccione mes</option>'
        for (var i = 0; i < data.length; i++)
            html_select += '<option value="' + data[i].eade_fecha + '">' + data[i].Mes + '</option>';
        $('#select-pago_mes').html(html_select);
    });
}

function mesPagoCambio() {
    var mes = $('#select-pago_mes').val();
    var año = $('#select-pago_año').val();
    $("#tabla-pago_personal tbody").children().remove();
    $.get('/api/pagos/diarios/' + mes + '/' + año, function (data) {
        var html_select = '<option value="">Seleccione personal</option>'
        for (var i = 0; i < data.length; i++)
            html_select += '<option value="' + data[i].empl_id + '">' + data[i].empl_fullName + '</option>';
        $('#select-empl_id_pago').html(html_select);
    });
}

function pagoCambio() {
    var empl_id = $('#select-empl_id_pago').val();
    var mes = $('#select-pago_mes').val();
    var año = $('#select-pago_año').val();
    var total_adelanto = 0;
    $("#tabla-pago_personal tbody").children().remove();
    $.get('/api/pagos/personal/' + empl_id + '/' + mes + '/' + año, function (data) {
        var filas;
        if (data.length != 0) {
            for (var i = 0; i < data.length; i++) {
                filas =
                    '<tr id="filas' + i + '">' +
                    '<td class="text-center"">' + data[i].eade_fecha +
                    '</td>' +
                    '<td class="text-center">' + data[i].eade_adelanto +
                    '</td></tr>';
                $("#tabla-pago_personal").append(filas);
                total_adelanto += data[i].eade_adelanto;
            }
            filas = '<tr id="filas' + (data.length + 1) + '">' + '<td class="text-center" style="color: blue;"><b>TOTAL ADELANTOS</b></td>' +
                '<td class="text-center" style="color: blue;"><b>' + total_adelanto + '</b></td></tr>';
            $("#tabla-pago_personal").append(filas);
        } else {
            filas =
                '<tr id="filas' + i + '">' +
                '<td colspan="3" class="text-center">Aún no ha solicitado adelantos</td></tr>';
            $("#tabla-pago_personal").append(filas);
        }
    });
}
