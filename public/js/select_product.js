$(function () {
    $('#select-prod_id').on('change', productChange);
    $('#select_prod_id').on('change', productOrderChange);
    $('#prod_name').attr("readonly", false);
    $('#prod_priceWholeSale').attr("readonly", false);
    $('#prod_purchasePrice').attr("readonly", false);
    $('#prod_priceRatail').attr("readonly", false);
    $('#prod_priceMinRatail').attr("readonly", false);
    $('#cate_id').attr("disabled", false);

});

function productChange() {
    var producto_id = $(this).val();
    if (!producto_id) {
        $('#sale_unitprice').attr("readonly", true);
        $('#sale_cantidad').attr("readonly", true);
        document.getElementById("sale_unitprice").value = "";
        document.getElementById("sale_cantidad").value = "";
        return null;
    } else {
        $('#sale_unitprice').attr("readonly", false);
        $('#sale_cantidad').attr("readonly", false);
        document.getElementById("sale_unitprice").value = "";
        document.getElementById("sale_cantidad").value = "";
    }

    $.get('/api/product/' + producto_id, function (data) {
        $('#prod_id').val(data.prod_id);
        $('#prod_name').val(data.prod_name);
        $('#prod_priceWholeSale').val(data.prod_priceWholeSale);
        $('#prod_stock').val(data.prod_stock);
    });
}

function productOrderChange() {
    var producto_id = $(this).val();
    $.get('/api/product/' + producto_id, function (data) {
        if (producto_id != 0) {
            $('#prod_id').val(data.prod_id);
            $('#prod_name').val(data.prod_name);
            $('#prod_priceWholeSale').val(data.prod_priceWholeSale);
            $('#prod_purchasePrice').val(data.prod_purchasePrice);
            $('#prod_priceRatail').val(data.prod_priceRatail);
            $('#prod_priceMinRatail').val(data.prod_priceMinRatail);
            $('#cate_id').val(data.cate_id);
            $('#prod_name').attr("readonly", true);
            $('#prod_priceWholeSale').attr("readonly", false);
            $('#prod_purchasePrice').attr("readonly", false);
            $('#prod_priceRatail').attr("readonly", false);
            $('#prod_priceMinRatail').attr("readonly", false);
            $('#cate_id').attr("disabled", true);
        } else {
            $('#prod_name').attr("readonly", false);
            $('#prod_priceWholeSale').attr("readonly", false);
            $('#prod_purchasePrice').attr("readonly", false);
            $('#prod_priceRatail').attr("readonly", false);
            $('#prod_priceMinRatail').attr("readonly", false);
            $('#cate_id').attr("disabled", false);
            $('#prod_name').val("");
            $('#prod_priceWholeSale').val("");
            $('#prod_purchasePrice').val("");
            $('#prod_priceRatail').val("");
            $('#prod_priceMinRatail').val("");
            $('#cate_id').val(0);
        }
    });

    $.get("/api/sizes/orders/" + producto_id, function (data) {
        $("#size_detail tbody").children().remove();
        var filas =
            '<tr><th class="text-center" scope="col">Talla</th><th class="text-center" scope="col">Stock</th><th class="text-center" scope="col">Opción</th></tr>';
        for (var i = 0; i < data.length; i++) {
            if (data[i].psiz_code != null) {
                filas =
                '<tr id="filaz' + i + '">' +
                '<td class="text-center"><input name="sizecodes[]" class="form-control text-center" value = "' + data[i].psiz_code + '" > ' +
                '</td><td class="text-center"><input type="hidden" name="idproducts[]" value="' + data[i].prod_id + '"><input type="hidden" name="idsizes[]" value="' + data[i].size_id + '"><input type="hidden" name="idpsizes[]" value="' +
                data[i].pzis_id +
                '">' +
                data[i].size_name +
                '</td><td class="text-center"><input class="form-control text-center" value="0" name="sizestocks[]">' +
                '</td><td class="text-center"> <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="quitars(' + i + ')">Quitar</a>' +
                "</td></tr>";
            $("#size_detail").append(filas);
            } else {
                filas =
                '<tr id="filaz' + i + '">' +
                '<td class="text-center"><input name="sizecodes[]" class="form-control text-center"> ' +
                '</td><td class="text-center"><input type="hidden" name="idproducts[]" value="' + data[i].prod_id + '"><input type="hidden" name="idsizes[]" value="' + data[i].size_id + '"><input type="hidden" name="idpsizes[]" value="' +
                data[i].pzis_id +
                '">' +
                data[i].size_name +
                '</td><td class="text-center"><input class="form-control text-center" value="0" name="sizestocks[]">' +
                '</td><td class="text-center"> <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="quitars(' + i + ')">Quitar</a>' +
                "</td></tr>";
            $("#size_detail").append(filas);

            }
        }
    });
}

function quitars(item) {
    $('#filaz' + item).remove();
    index--;
}
