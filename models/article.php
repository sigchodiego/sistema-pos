<?php

require_once '../config/conexion.php';

class Article {
    public function __construct()
    {

    }

    public function insert($idcategory,$code,$name,$stock, $description,$image){
        $sql = "INSERT INTO articulo(idcategoria, codigo,nombre,stock,descripcion, imagen, condicion) VALUES ('$idcategory','$code','$name','$stock', '$description','$image', '1')";
        return ejecutarConsulta($sql);
    }

    public function edit($idarticle,$idcategory,$code,$name,$stock, $description,$image){
        $sql = "UPDATE articulo SET idcategoria='$idcategory', codigo='$code', nombre='$name', stock='$stock', descripcion='$description', imagen='$image' WHERE idarticulo='$idarticle'";
        return ejecutarConsulta($sql);
    }

    public function activar($idarticle){
        $sql = "UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticle'";
        return ejecutarConsulta($sql);
    }
    public function desactivar($idarticle){
        $sql = "UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticle'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idarticle){
        $sql = "SELECT * FROM articulo WHERE idarticulo='$idarticle'";
        return ejecutarConsultaUnica($sql);
    }

    public function listar(){
        $sql = "SELECT * FROM articulo";
        return ejecutarConsulta($sql);
    }
}