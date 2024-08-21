var tabla;

function init() {
    mostrarFormulario(false);
    listar();
}

function limpiar() {
    $('#nombre').val('');
    $('#descripcion').val('');
    $('#idcategoria').val('');
}

function mostrarFormulario(x) {
    limpiar();
    if (x) {
        $('#listadoRegistros').hide();
        $('#formularioRegistros').show();
        $('#btnGuardar').prop('disabled', false);
        $('#btnAgregar').hide();
    } else {
        $('#listadoRegistros').show();
        $('#formularioRegistros').hide();
        $('#btnAgregar').show();
    }
}

function cancelarFormulario() {
    limpiar();
    mostrarFormulario(false);
}

function listar() {
    tabla = $('#tablaListado').dataTable({
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
            url: '../ajax/categoria.php?op=listar',
            type: 'get',
            dataType: 'json',
            error: function () {
                console.log(e.responseText);
            }
        },
        'bDestroy': true,
        'iDisplayLength': 5,
        'order': [[0, 'desc']]
    });
}

init();