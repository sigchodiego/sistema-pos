<?php

require_once '../models/permisos.php';

$permisos = new Permisos();

$idpermisos = isset($_POST['idpermisos']) && $_POST['idpermisos'] != '' ? limpiarCadena($_POST['idpermisos']) : false;

switch ($_GET['op']) {

    case 'listar':
        $respuesta = $permisos->listar();
        $data = array();

        while($resp = $respuesta->fetch_object()){
            $data[] = array(
                '0' => "<button class='btn btn-warning' onclick='mostrar($resp->idpermiso)'><i class='fas fa-edit'></i></button>
                <button class='btn btn-danger' onclick='eliminar($resp->idpermiso)'><i class='fas fa-times'></i></button>",
                '1' => $resp->nombre,
            );
        }

        $result = array(
            "echo" => 1,
            "totalrecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "data" => $data
        );

        echo json_encode($result);

        break;
}