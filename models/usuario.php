<?php

require_once '../config/conexion.php';

class Usuario {
    public function __construct()
    {

    }

    public function insert($nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email, $cargo, $login,$clave,$imagen){
        $sql = "INSERT INTO usuario(nombre,tipo_documento,num_documento,direccion, telefono, email, cargo, login, clave, imagen) VALUES ('$nombre','$tipo_documento','$num_documento','$direccion', '$telefono', '$email', '$cargo', '$login','$clave','$imagen')";
        return ejecutarConsulta($sql);
    }

    public function edit($idusuario,$nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email, $cargo, $login,$clave,$imagen){
        $sql = "UPDATE usuario SET idusuario='$idusuario',nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion', telefono='$telefono', email='$email', cargo='$cargo',login='$login', clave='$clave', imagen='$imagen' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($idusuario){
        $sql = "UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function activar($idusuario){
        $sql = "UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($idusuario){
        $sql = "SELECT * FROM usuario WHERE idusuario='$idusuario'";
        return ejecutarConsultaUnica($sql);
    }

    public function listar(){
        $sql = "SELECT * FROM usuario";
        return ejecutarConsulta($sql);
    }

    public function listarmarcados($idusuario){
        $sql = "SELECT * FROM usuario_permiso WHERE idusuario='$idusuario'";
        return ejecutarConsulta($sql);
    }
}