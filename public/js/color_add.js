var index = 0;
var colores = [];

$('#btnSubmit').attr("disabled", true);
function addcolor() {
    colordata = document.getElementById('color_id').value.split('_');
    for (c in colores) {
        if (colordata[0] == colores[c]) {
            alert("Color ya Seleccionado");
            return false;
        }
    }
    colores[index] = colordata[0];
    fila = '<tr id="filac' + index + '"><td class="text-center"><input type="hidden" name="idcolors[]" value="' + colordata[0] + '">' + colordata[0] + '</td><td class="text-center">' + colordata[1] + '</td><td class="text-center"><input class="text-center" name="colorstocks[]"></td><td class="text-center"><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="quitarc(' + index + ')">Quitar</a></td></tr>';
    $('#color_detail').append(fila);
    evaluar();
}

function quitarc(item) {
    $('#filac' + item).remove();
    index--;
    colores[item] = "";
}

function evaluar() {
    if (index > 0)
        $('#btnSubmit').attr("disabled", false);
    else
        $('#btnSubmit').attr("disabled", true);
}
