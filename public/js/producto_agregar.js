$(document).ready(function () {
    document.getElementById("select-prod_id").focus();
    var i = 1;
    var total_price = 0;
    var total_carrito = 0;


    $('#select-prod_id').keyup(function () {
        var producto_id = document.getElementById("select-prod_id").value;
        var lenght = document.getElementById("select-prod_id").value;
        if (lenght.length == 13) {
            $.get('/api/sizes/mobile/' + producto_id, function (data) {
                $('#prod_stock').val(data.psiz_stock);
                $('#prod_id').val(data.prod_id);
                $('#prod_name').val(data.prod_name);
                $('#pzis_id').val(data.pzis_id);
                $('#size_name').val(data.size_name);
                $('#sale_unitprice').attr("readonly", false);
                $('#sale_cantidad').attr("readonly", false);
                document.getElementById("select-prod_id").value = "";
                document.getElementById("data_product").style.display = "block";
            });
        } else {
            setTimeout(function(){document.getElementById("select-prod_id").value=""},100);
            return false;
        }
    });

    $('#adicionar').click(function () {
        total_carrito = $('#total_save').val();
        if (total_carrito == 0) {
            document.getElementById("total_save").value = 0;
            document.getElementById("total").value = "S/. 0";
            total_price = 0;
        }

        var prod_id = document.getElementById("prod_id").value;

        var prod_name = document.getElementById("prod_name").value;

        var sale_unitprice = document.getElementById("sale_unitprice").value;
        if (sale_unitprice == '' || sale_unitprice <= 0) {
            mostrarMensajeError("Por favor ingrese precio de venta valido");
            return false;
        }

        var sale_quantity = document.getElementById("sale_cantidad").value;
        var prod_stock = document.getElementById("prod_stock").value;
        var size_id = document.getElementById("pzis_id").value;
        var size_name = document.getElementById("size_name").value;
        if (sale_quantity == '' || Number(sale_quantity) == 0 || sale_quantity == null) {
            mostrarMensajeError("Por favor ingrese cantidad del producto");
            return false;
        }
        if (sale_quantity <= 0) {
            mostrarMensajeError("Por favor debe escribir cantidad del producto mayor a 0");
            return false;
        }
        if (Number(sale_quantity) > Number(prod_stock)) {
            mostrarMensajeError("No se tiene tal cantidad de producto solo hay " + prod_stock);
            return false;
        }

        var sale_total_price = sale_quantity * sale_unitprice;

        $('#sale_preciototal').val(sale_total_price);
        var fila = '<tr id="row' + i + '" style="background: white;"><td class="text-center"><input type="hidden"  name="sale_tallas[]" value="' + size_id + '"><input type="hidden"  name="sale_prod_stocks[]" value="' + prod_stock + '"><input type="hidden"  name="sale_prod_ids[]" value="' + prod_id + '">' + size_name + '</td><td class="text-center"><input type="hidden" name="sale_quantities[]" value="' + sale_quantity + '">' + sale_quantity + '</td><td class="text-center">' + prod_name + '</td><td class="text-center"><input type="hidden"  name="sale_unitprices[]" value="' + sale_unitprice + '">' + sale_unitprice + '</td><td class="text-center"><input type="hidden" id="sale_total_price' + i + '" name="sale_total_prices[]" value="' + sale_total_price + '">' + sale_total_price + '</td><td class="text-center"><button type="button" name="remove" id="' + i + '" class="btn_remove"><i class="fas fa-trash"></i></button></td></tr>';
        i++;
        $("#inicio_tabla").hide();
        $('#mytable tr:first').after(fila);
        $("#adicionados").text("");
        document.getElementById("sale_unitprice").value = "";
        document.getElementById("sale_cantidad").value = "";
        total_price = total_price + sale_total_price;
        document.getElementById("total").value = "S/. " + total_price;
        document.getElementById("total_save").value = total_price;
        var efectivo = document.getElementById("sale_efectivo").value;
        if (efectivo != null) {
            var vuelto = efectivo - total_price;
            document.getElementById("vuelto").value = "S/." + vuelto;
            document.getElementById("vuelto_save").value = vuelto;
        }

        total_carrito = $('#total_save').val();
        if (total_carrito == 0) {
            document.getElementById("total_save").value = 0;
            document.getElementById("total").value = "S/. 0";
            total_price = 0;
        }

        $('#prod_stock').val("");
        $('#prod_id').val("");
        $('#prod_name').val("");
        $('#pzis_id').val("");
        $('#size_name').val("");
        $('#sale_unitprice').attr("readonly", true);
        $('#sale_cantidad').attr("readonly", true);
        $("#data_product").hide();
        document.getElementById("select-prod_id").focus();

    });

    $(document).on('click', '.btn_remove', function () {
        var button_id = $(this).attr("id");
        var precio_total = document.getElementById('sale_total_price' + button_id + '').value;
        total_price = total_price - precio_total;
        document.getElementById("total").value = "S/. " + total_price;
        document.getElementById("total_save").value = total_price;
        var efectivo = document.getElementById("sale_efectivo").value;
        vuelto = efectivo - total_price;
        document.getElementById("vuelto").value = "S/. " + vuelto;
        document.getElementById("vuelto_save").value = vuelto;
        $('#row' + button_id + '').remove();
        i--;
        if (total_price == 0) {
            $("#inicio_tabla").show();
        }
    });

    $('#guardar').click(function () {
        var empl_id = document.getElementById("select-empl_id").value;
        if (empl_id == 0) {
            mostrarMensajeError("Por favor seleccione el personal");
            return false;
        }

        var pmet_id = document.getElementById("select-pmet_id").value;
        if (pmet_id == 0) {
            mostrarMensajeError("Por favor seleccione el metodo de pago");
            return false;
        }

        var nFilas = $("#mytable tr").length;
        if (nFilas == 2) {
            mostrarMensajeError("Por favor seleccione mercadería");
            return false;
        }
    });

});

function mostrarMensajeError(mensaje) {
    $(".alert").css('display', 'block');
    $(".alert").removeClass("hidden");
    $(".alert").addClass("alert-danger");
    $(".alert").html("<button type='button' class='close' data close='alert'>×</button>" + "<span><b>Error!</b> " + mensaje + ".</span>");
    $('.alert').delay(5000).hide(400);
}

$('#sale_efectivo').keyup(function () {
    var efectivo = document.getElementById("sale_efectivo").value
    var total = document.getElementById("total_save").value
    var vuelto = efectivo - total;
    document.getElementById("vuelto").value = "S/. " + vuelto;
    document.getElementById("vuelto_save").value = vuelto;
});
