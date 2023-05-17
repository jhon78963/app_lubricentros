var index = 0;
var codigos = [];

$('#btnSubmit').attr("disabled", true);
function addsize() {
    sizedata = document.getElementById('size_id').value.split('_');
    codigos[index] = sizedata[0];
    index = sizedata[0];
    fila = '<tr id="filaz' + index + '"><td class="text-center"><input type="text" class="form-control" name="codesizes[]"></td><td class="text-center"><input type="hidden" name="idsizes[]" value="' + sizedata[0] + '">' + sizedata[1] + '</td><td class="text-center"><input class="form-control text-center" name="sizestocks[]"></td><td class="text-center"><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="quitars(' + index + ')">Quitar</a></td></tr>';
    $('#size_detail').append(fila);
    evaluar();
}

function editsize() {
    sizedata = document.getElementById('size_id').value.split('_');
    codigos[index] = sizedata[0];
    index = sizedata[0];
    fila = '<tr id="filaz' + index + '"><td class="text-center"><input type="text" class="form-control text-center" name="newcodesizes[]"></td><td class="text-center"><input type="hidden" name="newidsizes[]" value="' + sizedata[0] + '">' + sizedata[1] + '</td><td class="text-center"><input class="form-control text-center" name="newsizestocks[]"></td><td class="text-center"><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="quitars(' + index + ')">Quitar</a></td></tr>';
    $('#size_detail').append(fila);
    evaluar();
}

function addsizeOrder() {
    sizedata = document.getElementById('size_id').value.split('_');
    prod_id = document.getElementById('select_prod_id').value;
    codigos[index] = sizedata[0];
    index = sizedata[0];
    fila = '<tr id="filaz' + index + '"><td class="text-center"><input type="text" class="form-control text-center" name="newcodesizes[]"></td><td class="text-center"><input type="hidden" name="newidsizes[]" value="' + sizedata[0] + '">' + sizedata[1] + '</td><td class="text-center"><input class="form-control text-center" name="newsizestocks[]"></td><td class="text-center"><a href="javascript:void(0)" class="btn btn-default btn-xs" onclick="quitars(' + index + ')">Quitar</a></td></tr>';
    $('#size_detail').append(fila);
    evaluar();
}


function quitars(item) {
    $('#filaz' + item).remove();
    index--;
    codigos[item] = null;
}

function evaluar() {
    if (index > 0)
        $('#btnSubmit').attr("disabled", false);
    else
        $('#btnSubmit').attr("disabled", true);
}
