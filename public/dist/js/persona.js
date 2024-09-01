var tabla;

function init() {
    mostrarelformulario(false);
    listar();

    $('#formulario').on('submit', function (e) {
        guardaryeditar(e);
    });

    $.post('../ajax/persona.php?op=selectCategoria', function (e) {
        $('#idcategoria').html(e);
    })
}

function limpiar() {
    $('#idpersona').val('');
    $('#nombre').val('');
    $('#tipo_documento').val('');
    $('#num_documento').val('');
    $('#telefono').val('');
    $('#email').val('');
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
            url: '../ajax/persona.php?op=listarp',
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
        url: '../ajax/persona.php?op=guardaryeditar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            mostrarelformulario(false);
            $('#tablalistado').DataTable().ajax.reload();
        }
    });
    limpiar();
}

function mostrar(idpersona) {
    $.post('../ajax/persona.php?op=mostrar', { idpersona: idpersona }, function (data, status) {
        data = JSON.parse(data);
        let img = data.imagen == '' ? "../public/dist/img/empty.png" : '../files/personas/' + data.imagen;
        $('#idpersona').val(data.idpersona);
        $('#nombre').val(data.nombre);
        $('#tipo_documento').val(data.tipo_documento);
        $('#num_documento').val(data.num_documento);
        $('#telefono').val(data.telefono);
        $('#email').val(data.email);
        mostrarelformulario(true);
    });
}

function eliminar(idpersona) {
    bootbox.confirm("¿Está seguro de eliminar la persona?", function (result) {
        if (result) {
            $.post('../ajax/persona.php?op=eliminar', { idpersona: idpersona }, function (e) {
                bootbox.alert(e);
                $('#tablalistado').DataTable().ajax.reload();
            })
        }
    });
}


$(document).ready(function () {
    init();
});