$(function () {
    $('#select-prod_id').on('change', productChange);

});

function productChange() {
    var sale_talla = document.getElementById("select-prod_id").value.split("_");
    var producto_id = sale_talla[0];

    if (producto_id == 0) {
        $('#sale_unitprice').attr("readonly", true);
        $('#sale_cantidad').attr("readonly", true);
        document.getElementById("sale_unitprice").value = "";
        document.getElementById("sale_cantidad").value = "";
        document.getElementById("prod_stock").value = "";
        document.getElementById("prod_priceRatail").value = "";
        return null;
    } else {
        $('#sale_unitprice').attr("readonly", false);
        $('#sale_cantidad').attr("readonly", false);
        document.getElementById("sale_unitprice").value = "";
        document.getElementById("sale_cantidad").value = "";
        document.getElementById("prod_stock").value = "";
        document.getElementById("prod_priceRatail").value = "";
    }

    $.get('/api/product/' + producto_id, function (data) {
        $('#prod_stock').val(data.stock);
        $('#prod_id').val(data.id);
        $('#prod_name').val(data.name);
        $('#prod_priceRatail').val(data.sale_price);
    });
}
