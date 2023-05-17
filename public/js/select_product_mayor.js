$(function () {
    $('#select-prod_id').on('change', productChange);

});

function productChange() {
    var producto_id = $(this).val();
    if (producto_id == 0) {
        $('#sale_unitprice').attr("readonly", true);
        $('#sale_cantidad').attr("readonly", true);
        $('#sale_talla').attr("readonly", true);
        document.getElementById("sale_unitprice").value = "";
        document.getElementById("sale_cantidad").value = "";
        document.getElementById("sale_talla").value = "";
        document.getElementById("prod_stock").value = "";
        document.getElementById("prod_priceWholeSale").value = "";
        return null;
    } else {
        $('#sale_unitprice').attr("readonly", false);
        $('#sale_cantidad').attr("readonly", false);
        $('#sale_talla').attr("readonly", false);
        document.getElementById("sale_unitprice").value = "";
        document.getElementById("sale_cantidad").value = "";
        document.getElementById("sale_talla").value = "";
        document.getElementById("prod_stock").value = "";
        document.getElementById("prod_priceWholeSale").value = "";
    }

    $.get('/api/product/' + producto_id, function (data) {
        $('#prod_stock').val(data.prod_stock);
        $('#prod_id').val(data.prod_id);
        $('#prod_name').val(data.prod_name);
        $('#prod_priceWholeSale').val(data.prod_priceWholeSale);
        $('#prod_stock').val(data.prod_stock);
    });

    $.get("/api/sizes/" + producto_id, function (data) {
        var html_select = '<option value="0">Tallas</option>'
        for (var i = 0; i < data.length; i++)
            html_select += '<option value="' + data[i].pzis_id + "_" + data[i].size_name + '">' + data[i].size_name + '</option>';
        $('#sale_talla').html(html_select);
    });
}
