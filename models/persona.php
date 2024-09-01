<?php

require_once '../config/conexion.php';

class Article {
    public function __construct()
    {

    }

    public function insert($tipo_persona,$nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email){
        $sql = "INSERT INTO persona(tipo_persona,nombre,tipo_documento,num_documento,direccion, telefono, email) VALUES ('$tipo_persona','$nombre','$tipo_documento','$num_documento','$direccion', '$telefono', '$email')";
        return ejecutarConsulta($sql);
    }

    public function edit($idpersona,$tipo_persona,$nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email){
        $sql = "UPDATE persona SET tipo_persona='$tipo_persona',nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion', telefono='$telefono', email='$email' WHERE idpersona='$idpersona'";
        return ejecutarConsulta($sql);
    }

    public function eliminar($idpersona){
        $sql = "DELETE FROM persona WHERE idpersona='$idpersona'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idpersona){
        $sql = "SELECT * FROM persona WHERE idpersona='$idpersona'";
        return ejecutarConsultaUnica($sql);
    }

    public function listarp(){
        $sql = "SELECT * FROM persona WHERE tipo_persona='proveedor'";
        return ejecutarConsulta($sql);
    }

    public function listarc(){
        $sql = "SELECT * FROM persona WHERE tipo_persona='cliente'";
        return ejecutarConsulta($sql);
    }
}