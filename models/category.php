<?php

require_once '../config/conexion.php';

class Category {
    public function __construct()
    {

    }

    public function insert($name,$description){
        $sql = "INSERT INTO categoria(nombre,descripcion,condicion) VALUES ('$name','$description', 1)";
        return ejecutarConsulta($sql);
    }

    public function edit($idcategory,$name,$description){
        $sql = "UPDATE categoria SET nombre='$name', descripcion='$description' WHERE idcategoria='$idcategory'";
        return ejecutarConsulta($sql);
    }

    public function activar($idcategory){
        $sql = "UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategory'";
        return ejecutarConsulta($sql);
    }
    public function desactivar($idcategory){
        $sql = "UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategory'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idcategory){
        $sql = "SELECT * FROM categoria WHERE idcategoria='$idcategory'";
    }

    public function listar (){
        $sql = "SELECT * FROM cateogria";
        return ejecutarConsulta($sql);
    }
}