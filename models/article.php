<?php

require_once '../config/conexion.php';

class Article {
    public function __construct()
    {

    }

    public function insert($name,$description){
        $sql = "INSERT INTO articulo(idcategoria, codigo,nombre,stock,descripcion, imagen, condicion) VALUES ('$name','$description', 1)";
        return ejecutarConsulta($sql);
    }

    public function edit($idcategory,$name,$description){
        $sql = "UPDATE articulo SET nombre='$name', descripcion='$description' WHERE idcategoria='$idcategory'";
        return ejecutarConsulta($sql);
    }

    public function activar($idcategory){
        $sql = "UPDATE articulo SET condicion='1' WHERE idcategoria='$idcategory'";
        return ejecutarConsulta($sql);
    }
    public function desactivar($idcategory){
        $sql = "UPDATE articulo SET condicion='0' WHERE idcategoria='$idcategory'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idcategory){
        $sql = "SELECT * FROM articulo WHERE idcategoria='$idcategory'";
        return ejecutarConsultaUnica($sql);
    }

    public function listar(){
        $sql = "SELECT * FROM articulo";
        return ejecutarConsulta($sql);
    }
}