<?php

require_once '../config/conexion.php';

class Usuario {
    public function __construct()
    {

    }

    public function insert($nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email, $cargo, $login,$clave,$imagen,$permisos){
        $sql = "INSERT INTO usuario(nombre,tipo_documento,num_documento,direccion, telefono, email, cargo, login, clave, imagen,condicion) VALUES ('$nombre','$tipo_documento','$num_documento','$direccion', '$telefono', '$email', '$cargo', '$login','$clave','$imagen', '1')";
        
        $idusuarionew = ejecutarConsulta_retornarID($sql);
        
        $num_elementos = 0;
        $sw = true;

        while ($num_elementos < count($permisos)) {
            $sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuarionew','$permisos[$num_elementos]')";
            ejecutarConsulta($sql) or $sw = false;
            $num_elementos++;
        }

        return $sw;
    }

    public function edit($idusuario,$nombre,$tipo_documento,$num_documento,$direccion, $telefono, $email, $cargo, $login,$clave,$imagen,$permisos){
        $sql = "UPDATE usuario SET idusuario='$idusuario',nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion', telefono='$telefono', email='$email', cargo='$cargo',login='$login', clave='$clave', imagen='$imagen' WHERE idusuario='$idusuario'";
        ejecutarConsulta($sql);
        $sqldel = "DELETE FROM usuario_permiso WHERE idusuario = '$idusuario'";
        ejecutarConsulta($sqldel);

        $num_elementos = 0;
        $sw = true;

        while ($num_elementos < count($permisos)) {
            $sql_detalle = "INSERT INTO usuario_permiso(idusuario, idpermiso) VALUES('$idusuario','$permisos[$num_elementos]')";
            ejecutarConsulta($sql) or $sw = false;
            $num_elementos++;
        }

        return $sw;
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

    public function verificar($login, $clave){
        $sql = "
        SELECT *
        FROM 
            usuario 
        WHERE 
            login = '$login'
        AND
            clave = '$clave' 
        AND 
            condicion='1'";
        return ejecutarConsulta($sql);
    }

}