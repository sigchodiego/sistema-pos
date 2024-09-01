<?php

require_once '../models/persona.php';

$persona = new persona();

$idpersona = isset($_POST['idpersona']) && $_POST['idpersona'] != '' ? limpiarCadena($_POST['idpersona']) : false;
$tipo = isset($_POST['tipo_persona']) ? limpiarCadena($_POST['tipo_persona']) : '';
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : '';
$tipo_documento = isset($_POST['tipo_documento']) ? limpiarCadena($_POST['tipo_documento']) : '';
$num_documento = isset($_POST['num_documento']) ? limpiarCadena($_POST['num_documento']) : '';
$direccion = isset($_POST['direccion']) ? limpiarCadena($_POST['direccion']) : '';
$telefono = isset($_POST['telefono']) ? limpiarCadena($_POST['telefono']) : '';
$email = isset($_POST['email']) ? limpiarCadena($_POST['email']) : '';

switch ($_GET['op']) {
    case 'guardaryeditar':
        
        if (empty($idpersona)) {
            $respuesta = $persona->insert($tipo,$nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email);
            echo $respuesta ? "persona registrada" : "La persona no se pudo registrar";
        } else {
            $respuesta = $persona->edit($idpersona,$tipo,$nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email);
            echo $respuesta ? "persona actualizada" : "La persona no se pudo actualizar";
        }
        break;

    case 'eliminar':
        $respuesta = $persona->eliminar($idpersona);
        echo $respuesta ? "persona eliminada" : "La persona no se pudo eliminar";
        break;

    case 'mostrar':
        $respuesta = $persona->mostrar($idpersona);
        echo json_encode($respuesta) ;
        break;

    case 'listarp':
        $respuesta = $persona->listarp();
        $data = array();

        while($resp = $respuesta->fetch_object()){
            $data[] = array(
                '0' => "<button class='btn btn-warning' onclick='mostrar($resp->idpersona)'><i class='fas fa-edit'></i></button>
                <button class='btn btn-danger' onclick='eliminar($resp->idpersona)'><i class='fas fa-times'></i></button>",
                '1' => $resp->nombre,
                '2' => $resp->tipo_documento,
                '3' => $resp->num_documento,
                '4' => $resp->telefono,
                '5' => $resp->email
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
    
    case 'listarc':
        $respuesta = $persona->listarc();
        $data = array();

        while($resp = $respuesta->fetch_object()){
            $data[] = array(
                '0' => "<button class='btn btn-warning' onclick='mostrar($resp->idpersona)'><i class='fas fa-edit'></i></button>
                <button class='btn btn-danger' onclick='eliminar($resp->idpersona)'><i class='fas fa-times'></i></button>",
                '1' => $resp->nombre,
                '2' => $resp->tipo_documento,
                '3' => $resp->num_document,
                '4' => $resp->telefono,
                '5' => $resp->email
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