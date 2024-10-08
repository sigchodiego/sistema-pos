var tabla;

function init() {
    mostrarelformulario(false);
    listar();

    $('#formulario').on('submit', function (e) {
        guardaryeditar(e);
    });

    $.post('../ajax/article.php?op=selectCategoria', function (e) {
        $('#idcategoria').html(e);
    })
}

function limpiar() {
    $('#idarticulo').val('');
    $('#nombre').val('');
    $('#idcategoria').val('');
    $('#stock').val('');
    $('#descripcion').val('');
    $('#codigo').val('');
    $('#imagen').val('');
    $('#imagenactual').val('');
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
            url: '../ajax/article.php?op=listar',
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
        url: '../ajax/article.php?op=guardaryeditar',
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

function mostrar(idarticulo) {
    $.post('../ajax/article.php?op=mostrar', { idarticulo: idarticulo }, function (data, status) {
        data = JSON.parse(data);
        let img = data.imagen == '' ? "../public/dist/img/empty.png" : '../files/articles/' + data.imagen;
        $('#nombre').val(data.nombre);
        $('#descripcion').val(data.descripcion);
        $('#idcategoria').val(data.idcategoria);

        $('#idarticulo').val(data.idarticulo);
        $('#nombre').val(data.nombre);
        $('#idcategoria').val(data.idcategoria);
        $('#stock').val(data.stock);
        $('#descripcion').val(data.descripcion);
        $('#codigo').val(data.codigo);
        $('#condicion').val(data.condicion);
        $('#imagenmuestra').show();
        $('#imagenmuestra').attr('src', img);
        $('#imagenactual').val(data.imagen);
        generarbarcode();
        mostrarelformulario(true);
    });
}

function desactivar(idarticulo) {
    bootbox.confirm("¿Está seguro de desactivar la categoría?", function (result) {
        if (result) {
            $.post('../ajax/article.php?op=desactivar', { idarticulo: idarticulo }, function (e) {
                bootbox.alert(e);
                $('#tablalistado').DataTable().ajax.reload();
            })
        }
    });
}

function activar(idarticulo) {
    bootbox.confirm("¿Está seguro de activar la categoría?", function (result) {
        if (result) {
            $.post('../ajax/article.php?op=activar', { idarticulo: idarticulo }, function (e) {
                bootbox.alert(e);
                $('#tablalistado').DataTable().ajax.reload();
            })
        }
    });
}

function generarbarcode() {
    const codigo = $("#codigo").val();
    JsBarcode('#barcode', codigo);
    $("#print").show();
}


$(document).ready(function () {
    init();
});