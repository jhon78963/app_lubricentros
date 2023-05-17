$(function () {
    $('#select-pmet_id').on('change', methodChange);
});

function methodChange() {
    var pmet_id = $(this).val();
    if (pmet_id == 1) {
        $('#sale_efectivo').attr("readonly", false);
        $("#form_efectivo").show();
        $("#form_yape").hide();
        $("#form_transferencia").hide();
        return null;
    } else if (pmet_id == 2) {
        $('#sale_efectivo').attr("readonly", false);
        document.getElementById("sale_efectivo").value = "";
        $("#form_efectivo").hide();
        $("#form_yape").hide();
        $("#form_transferencia").hide();
        return null;
    } else if (pmet_id == 3) {
        $('#sale_efectivo').attr("readonly", true);
        document.getElementById("sale_efectivo").value = "";
        $("#form_efectivo").hide();
        $("#form_yape").show();
        $("#form_transferencia").hide();
        return null;
    } else if (pmet_id == 4) {
        $('#sale_efectivo').attr("readonly", true);
        document.getElementById("sale_efectivo").value = "";
        $("#form_efectivo").hide();
        $("#form_yape").hide();
        $("#form_transferencia").show();
        return null;
    } else {
        $('#sale_efectivo').attr("readonly", true);
        document.getElementById("sale_efectivo").value = "";
        $("#form_efectivo").hide();
        $("#form_yape").hide();
        $("#form_transferencia").hide();
        return null;
    }
}
