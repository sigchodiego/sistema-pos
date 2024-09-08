var tabla;

function init() {
    mostrarelformulario(false);
    listar();

    $('#formulario').on('submit', function (e) {
        guardaryeditar(e);
    });

    $('#imagenmuestra').hide();

    $.post('../ajax/usuarios.php?op=permisos&id=', function (e) {
        $('#permisos').html(e);
    })
}

function limpiar() {
    $('#nombre').val('');
    $('#num_documento').val('');
    $('#direccion').val('');
    $('#telefono').val('');
    $('#email').val('');
    $('#cargo').val('');
    $('#login').val('');
    $('#clave').val('');
    $('#imagenmuestra').val('');
    $('#imagenactual').val('');
    $('#idusuario').val('');
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
            url: '../ajax/usuarios.php?op=listar',
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
        url: '../ajax/usuarios.php?op=guardaryeditar',
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

function mostrar(idusuario) {
    $.post('../ajax/usuarios.php?op=mostrar', { idusuario: idusuario }, function (data, status) {
        data = JSON.parse(data);
        let img = data.imagen == '' ? "../public/dist/img/empty.png" : '../files/usuarios/' + data.imagen;
        $('#idusuario').val(data.idusuario);
        $('#nombre').val(data.nombre);
        $('#tipo_documento').val(data.tipo_documento);
        $('#tipo_documento').selectpicker('refresh');
        $('#num_documento').val(data.num_documento);
        $('#direccion').val(data.direccion);
        $('#telefono').val(data.telefono);
        $('#email').val(data.email);
        $('#cargo').val(data.cargo);
        $('#login').val(data.login);
        $('#clave').val(data.clave);
        $('#clave').val(data.clave);
        $('#imagenmuestra').show();
        $('#imagenmuestra').attr('src', img);
        $('#imagenactual').val(data.imagen);

        $.post('../ajax/usuarios.php?op=permisos&id=' + data.idusuario, function (e) {
            $('#permisos').html(e);
        })

        mostrarelformulario(true);
    });
}

function desactivar(idusuario) {
    bootbox.confirm("¿Está seguro de desactivar al usuario?", function (result) {
        if (result) {
            $.post('../ajax/usuarios.php?op=desactivar', { idusuario: idusuario }, function (e) {
                bootbox.alert(e);
                $('#tablalistado').DataTable().ajax.reload();
            })
        }
    });
}

function activar(idusuario) {
    bootbox.confirm("¿Está seguro de activar al usuario?", function (result) {
        if (result) {
            $.post('../ajax/usuarios.php?op=activar', { idusuario: idusuario }, function (e) {
                bootbox.alert(e);
                $('#tablalistado').DataTable().ajax.reload();
            })
        }
    });
}


$(document).ready(function () {
    init();
});