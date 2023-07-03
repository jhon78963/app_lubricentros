$(document).ready(function () {
    document.getElementById("select-prod_id").focus();
    $('#select-prod_id').keyup(function () {
        var producto_id = document.getElementById("select-prod_id").value;
        var lenght = document.getElementById("select-prod_id").value;
        if (lenght.length == 13) {
            $.get('/api/product/search/' + producto_id, function (data) {
                $('#prod_stock').val(data.stock);
                $('#prod_priceRatail').val(data.sale_price);
                $('#prod_id').val(data.id);
                $('#prod_name').val(data.name);
                $('#sale_unitprice').attr("readonly", false);
                $('#sale_cantidad').attr("readonly", false);
                document.getElementById("select-prod_id").value = "";
            });
        } else {
            setTimeout(function(){document.getElementById("select-prod_id").value=""},100);
            return false;
        }
    });
});
