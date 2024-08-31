<?php

require_once '../models/article.php';

$article = new Article();

$idarticle = isset($_POST['idarticulo']) && $_POST['idarticulo'] != '' ? limpiarCadena($_POST['idarticulo']) : false;
$idcategory = isset($_POST['idcategoria']) && $_POST['idcategoria'] != '' ? limpiarCadena($_POST['idcategoria']) : false;
$code = isset($_POST['codigo']) ? limpiarCadena($_POST['codigo']) : '';
$name = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : '';
$stock = isset($_POST['stock']) ? limpiarCadena($_POST['stock']) : '';
$description = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : '';
$image = isset($_POST['imagen']) ? limpiarCadena($_POST['imagen']) : '';

switch ($_GET['op']) {
    case 'guardaryeditar':
        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
            $imagen = $_POST['imagenactual'];
        }else{
            $ext = explode('.', $_FILES['imagen']['name']);
            if($_FILES['imagen']['type'] == 'image/jpg' || $_FILES['imagen']['type'] == 'image/jpeg' || $_FILES['imagen']['type'] == 'image/png'){
                $imagen = round(microtime(true)).'.'.end($ext);
                move_uploaded_file($_FILES['imagen']['tmp_name'], '../files/articles/'.$imagen);
            }
        }
        
        if (empty($idarticle)) {
            $respuesta = $article->insert($idcategory,$code,$name,$stock, $description,$image);
            echo $respuesta ? "Artículo registrado" : "El artículo no se pudo registrar";
        } else {
            $respuesta = $article->edit($idarticle,$idcategory,$code,$name,$stock, $description,$imagen);
            echo $respuesta ? "Artículo actualizado" : "El artículo no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $respuesta = $article->desactivar($idarticle);
        echo $respuesta ? "Artículo desactivado" : "El artículo no se pudo desactivar";
        break;

    case 'activar':
        $respuesta = $article->activar($idarticle);
        echo $respuesta ? "Artículo activado" : "El artículo no se pudo activar";
        break;

    case 'mostrar':
        $respuesta = $article->mostrar($idarticle);
        echo json_encode($respuesta) ;
        break;

    case 'selectCategoria':
        require_once '../models/category.php';
        $categoryObj = new Category();
        $categories = $categoryObj->listar();
        while($reg = $categories->fetch_object()){
            echo '<option value="'.$reg->idcategoria.'">'.$reg->nombre.'</option>';
        }
        break;

    case 'listar':
        $respuesta = $article->listar();
        $data = array();

        while($resp = $respuesta->fetch_object()){
            $data[] = array(
                '0' => ($resp->condicion) ? "<button class='btn btn-warning' onclick='mostrar($resp->idarticulo)'><i class='fas fa-edit'></i></button>
                <button class='btn btn-danger' onclick='desactivar($resp->idarticulo)'><i class='fas fa-times'></i></button>" :
                "<button class='btn btn-warning' onclick='mostrar($resp->idarticulo)'><i class='fas fa-edit'></i></button>
                <button class='btn btn-success' onclick='desactivar($resp->idarticulo)'><i class='fas fa-check'></i></button>",
                '1' => $resp->nombre,
                '2' => $resp->categoria,
                '3' => $resp->codigo,
                '4' => $resp->stock,
                '5' => "<img src='../files/articles/$resp->imagen' height='50px' width='50px' />",
                '6' => $resp->condicion ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-secondary'>Inactivo</span>",
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