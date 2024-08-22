<?php

require_once '../models/category.php';

$category = new Category();

$idcategory = isset($_POST['idcategory']) ? limpiarCadena($_POST['idcategory']) : '';
$name = isset($_POST['name']) ? limpiarCadena($_POST['name']) : '';
$description = isset($_POST['description']) ? limpiarCadena($_POST['description']) : '';

switch ($_GET['op']) {
    case 'guardaryeditar':
        if (!empty($idcategory)) {
            $respuesta = $category->insert($name, $description);
            echo $respuesta ? "Categoria registrada" : "La categoria no se pudo registrar";
        } else {
            $respuesta = $category->edit($idcategory,$name, $description);
            echo $respuesta ? "Categoria actualizada" : "La categoria no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $respuesta = $category->desactivar($idcategory);
        echo $respuesta ? "Categoria desactivada" : "La categoria no se pudo desactivar";
        break;

    case 'activar':
        $respuesta = $category->activar($idcategory);
        echo $respuesta ? "Categoria activada" : "La categoria no se pudo activar";
        break;

    case 'mostrar':
        $respuesta = $category->mostrar($idcategory);
        echo json_encode($respuesta) ;
        break;

    case 'listar':
        $respuesta = $category->listar();
        $data = array();

        while($resp = $respuesta->fetch_object()){
            $data[] = array(
                '0' => $resp->idcategoria,
                '1' => $resp->nombre,
                '2' => $resp->descripcion,
                '3' => $resp->condicion,
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