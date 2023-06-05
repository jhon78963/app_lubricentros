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
            $('#prod_id').val(data.id);
            $('#prod_name').val(data.name);
            $('#prod_priceWholeSale').val(data.sale_price);
            $('#prod_purchasePrice').val(data.purchase_price);
            $('#cate_id').val(data.category_id).trigger('change');
            $('#prod_name').attr("readonly", true);
            $('#cate_id').attr("disabled", true);
        } else {
            $('#prod_name').attr("readonly", false);
            $('#prod_priceWholeSale').attr("readonly", false);
            $('#prod_purchasePrice').attr("readonly", false);
            $('#cate_id').attr("disabled", false);
            $('#prod_name').val("");
            $('#cate_id').val(0).trigger('change');;
        }
    });
    var i = 0;
    $.get("/api/product/" + producto_id, function (data) {
        var cabecera = document.getElementById("cabecera");
        if (cabecera !== null) {
            $("#product-detail tbody").children().remove();
        }
        if (data.id != undefined) {
            var filas = '<tr id="filaz' + data.id + '">' +
                '<td class="text-center"><input type="hidden" name="idproducts[]" value="' + data.id + '"><input type="hidden" name="codesproducts[]" value="' + data.code_bar + '">' + data.code_bar +
                '</td><td class="text-center"><input type="hidden" name="nameproducts[]" value="' + data.name + '">' + data.name +
                '</td><td class="text-center"><input class="form-control text-center" name="productstocks[]" required="required">' +
                '</td><td class="text-center"> <a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="quitar(' + data.id + ')">Quitar</a></td></tr>';
        } else {
            var filas = '<tr id="filaz' + (i+1) + '">' +
                '<td class="text-center"><input class="form-control text-center" name="newcodesproducts[]" required="required"></td>' +
                '<td class="text-center"><input class="form-control text-center" name="newnameproducts[]" required="required"></td>' +
                '<td class="text-center"><input class="form-control text-center" name="newproductstocks[]" required="required"></td>' +
                '<td class="text-center"><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="quitar(' + (i+1) + ')">Quitar</a></td></tr>';
        }
        $("#product-detail").append(filas);
        i = i + 1;
        console.log(i);
    });
}

function quitar(item) {
    $('#filaz' + item).remove();
}

function limpiar() {
    $("#product-detail tbody").children().remove();
    var filas = '<tr><td class="text-center" colspan="4" id="cabecera">Seleccione productos</td></tr>';
    $("#product-detail").append(filas);
}
