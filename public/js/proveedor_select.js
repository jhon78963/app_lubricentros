$(function () {
    $('#select-prov_id_pago').on('change', pagoChange);
});

function pagoChange() {
    var prov_id = $(this).val();
    var total_pago = 0;
    document.getElementById("pago").value = "";
    $("#tabla-pago_proveedor tbody").children().remove();
    $.get('/api/proveedores/' + prov_id, function (data) {
        var filas;
        if (data.length != 0) {
            for (var i = 0; i < data.length; i++) {
                filas =
                    '<tr id="filas' + i + '">' +
                    '<td class="text-center"">' + data[i].ppag_fecha +
                    '</td>' +
                    '<td class="text-center">' + data[i].ppag_pago +
                    '</td></tr>';
                $("#tabla-pago_proveedor").append(filas);
                total_pago += data[i].ppag_pago;
            }
            filas = '<tr id="filas' + (data.length + 1) + '">' + '<td class="text-center" style="color: blue;"><b>TOTAL ADELANTOS</b></td>' +
                '<td class="text-center" style="color: blue;"><b>' + total_pago + '</b></td></tr>';
            $("#tabla-pago_proveedor").append(filas);
        } else {
            filas =
                '<tr id="filas' + i + '">' +
                '<td colspan="3" class="text-center">Aún no ha solicitado adelantos</td></tr>';
            $("#tabla-pago_proveedor").append(filas);
        }


        $.get('/api/proveedores/cuenta/' + prov_id, function (datas) {
            document.getElementById("cuenta_save").value = datas.prov_cuenta;
            document.getElementById("cuenta").value = "S/. " + datas.prov_cuenta;
            document.getElementById("saldo_save").value = datas.prov_cuenta - total_pago;
            document.getElementById("saldo_guardar").value = datas.prov_cuenta - total_pago;
            document.getElementById("saldo").value = "S/. " + (datas.prov_cuenta - total_pago);
        });
    });

}

$('#pago').keyup(function () {
    var saldo = document.getElementById("saldo_guardar").value;
    var pago = document.getElementById("pago").value;
    var pago_total = saldo - pago;
    document.getElementById("saldo").value = "S/. " + (saldo - pago);
    document.getElementById("saldo_save").value = pago_total;
    saldo = saldo_save;
});
