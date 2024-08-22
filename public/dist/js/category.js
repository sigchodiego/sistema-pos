var tabla;

function init() {
    mostrarelformulario(false);
    listar();
}

function limpiar() {
    $('#nombre').val('');
    $('#descripcion').val('');
    $('#idcategoria').val('');
}

function mostrarelformulario(x) {
    limpiar();
    if (x) {
        $('#listadoregistros').hide();
        $('#formularioregistros').show();
        $('#btnguardar').prop('disabled', false);
        $('#btnagregar').hide();
    } else {
        $('#listadoregistros').show();
        $('#formularioregistros').hide();
        $('#btnagregar').show();
    }
}

function cancelarFormulario() {
    limpiar();
    mostrarelformulario(false);
}

function listar() {
    tabla = $('#tablalistado').dataTable({
        'aProcessing': true,
        'aServerSide': true,
        dom: 'Bftrip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        'ajax': {
            url: '../ajax/category.php?op=listar',
            type: 'get',
            dataType: 'json',
            error: function (e) {
                console.log(e.responseText);
            }
        },
        'bDestroy': true,
        'iDisplayLength': 5,
        'order': [[0, 'desc']]
    });
}

init();