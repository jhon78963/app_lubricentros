$('#select-cust_dni').keyup(function () {
    var cust_dni = $('#select-cust_dni').val();
    if (cust_dni.length == 8) {
        $.get('/api/consulta-dni/' + cust_dni, function (data) {
            $('#form-customer').show();
            $('#cust_apellidoPaterno').val(data.apellidoPaterno);
            $('#cust_apellidoMaterno').val(data.apellidoMaterno);
            $('#cust_name').val(data.nombres);
            $('#cust_nrodocumento').val(data.numeroDocumento);
        });
    } else {
        $('#form-customer').hide();
        $('#cust_apellidoPaterno').val("");
        $('#cust_apellidoMaterno').val("");
        $('#cust_name').val("");
        $('#cust_nrodocumento').val("");
    }
});
