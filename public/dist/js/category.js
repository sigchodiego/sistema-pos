var tabla;

function init() {
    mostrarelformulario(false);
    listar();

    $('#formulario').on('submit', function (e) {
        guardaryeditar(e);
    });
}

function limpiar() {
    $('#nombre').val('');
    $('#descripcion').val('');
    $('#idcategoria').val('');
}

function mostrarelformulario(x) {
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

function cancelarformulario() {
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

function guardaryeditar(e) {
    e.preventDefault();
    $('#btnGuardar').prop('disabled', true);
    var formData = new FormData($('#formulario')[0]);

    $.ajax({
        url: '../ajax/category.php?op=guardaryeditar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarelformulario(false);
            $('#tablalistado').DataTable().ajax.reload()
        }
    });
    limpiar();
}

function mostrar(idcategoria) {
    $.post('../ajax/category.php?op=mostrar', { idcategoria: idcategoria }, function (data, status) {
        data = JSON.parse(data);
        $('#nombre').val(data.nombre);
        $('#descripcion').val(data.descripcion);
        $('#idcategoria').val(data.idcategoria);
        mostrarelformulario(true);
    });
}

$(document).ready(function () {
    init();
});