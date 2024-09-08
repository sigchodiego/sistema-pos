<?php

require_once '../models/usuario.php';

$usuario = new Usuario();

$idusuario = isset($_POST['idusuario']) && $_POST['idusuario'] != '' ? limpiarCadena($_POST['idusuario']) : false;
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : '';
$tipo_documento = isset($_POST['tipo_documento']) ? limpiarCadena($_POST['tipo_documento']) : '';
$num_documento = isset($_POST['num_documento']) ? limpiarCadena($_POST['num_documento']) : '';
$direccion = isset($_POST['direccion']) ? limpiarCadena($_POST['direccion']) : '';
$telefono = isset($_POST['telefono']) ? limpiarCadena($_POST['telefono']) : '';
$email = isset($_POST['email']) ? limpiarCadena($_POST['email']) : '';
$cargo = isset($_POST['cargo']) ? limpiarCadena($_POST['cargo']) : '';
$login = isset($_POST['login']) ? limpiarCadena($_POST['login']) : '';
$clave = isset($_POST['clave']) ? limpiarCadena($_POST['clave']) : '';
$imagen = isset($_POST['imagen']) ? limpiarCadena($_POST['imagen']) : '';

switch ($_GET['op']) {
    case 'guardaryeditar':
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagen = $_POST['imagenactual'];
        }else{
            $ext = explode('.', $_FILES['imagen']['name']);
            if($_FILES['imagen']['type'] == 'image/jpg' || $_FILES['imagen']['type'] == 'image/jpeg' || $_FILES['imagen']['type'] == 'image/png'){
                $imagen = round(microtime(true)).'.'.end($ext);
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../files/users/'.$imagen);
            }
        }

        if (empty($idusuario)) {
            $respuesta = $usuario->insert($nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email, $cargo, $login,$clave,$imagen, $_POST['permiso']);
            echo $respuesta ? "usuario registrado" : "El usuario no se pudo registrar";
        } else {
            $respuesta = $usuario->edit($idusuario,$nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email, $cargo, $login,$clave,$imagen, $_POST['permiso']);
            echo $respuesta ? "usuario actualizada" : "El usuario no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $respuesta = $usuario->desactivar($idusuario);
        echo $respuesta ? "usuario desactivado" : "La usuario no se pudo desactivar";
        break;

    case 'actovar':
        $respuesta = $usuario->activar($idusuario);
        echo $respuesta ? "usuario activar" : "El usuario no se pudo activar";
        break;

    case 'mostrar':
        $respuesta = $usuario->mostrar($idusuario);
        echo json_encode($respuesta) ;
        break;

    case 'listar':
        $respuesta = $usuario->listar();
        $data = array();

        while($resp = $respuesta->fetch_object()){
            $data[] = array(
                '0' => ($resp->condicion) ? "<button class='btn btn-warning' onclick='mostrar($resp->idusuario)'><i class='fas fa-edit'></i></button>
                <button class='btn btn-danger' onclick='desactivar($resp->idusuario)'><i class='fas fa-times'></i></button>" : "<button class='btn btn-warning' onclick='mostrar($resp->idusuario)'><i class='fas fa-edit'></i></button>
                <button class='btn btn-primary' onclick='activar($resp->idusuario)'><i class='fas fa-times'></i></button>",
                '1' => $resp->nombre,
                '2' => $resp->tipo_documento,
                '3' => $resp->num_documento,
                '4' => $resp->telefono,
                '5' => $resp->email,
                '6' => $resp->login,
                '7' => "<img src='../files/users'".$resp->imagen."' height='50px' width='50px' />",
                '8' => $resp->condicion ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-secondary'>Inactivo</span>",
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