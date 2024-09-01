var tabla;

function init() {
    listar();
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
            url: '../ajax/permisos.php?op=listar',
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

function eliminar(idpermisos) {
    bootbox.confirm("¿Está seguro de eliminar la permisos?", function (result) {
        if (result) {
            $.post('../ajax/permisos.php?op=eliminar', { idpermisos: idpermisos }, function (e) {
                bootbox.alert(e);
                $('#tablalistado').DataTable().ajax.reload();
            })
        }
    });
}


$(document).ready(function () {
    init();
});