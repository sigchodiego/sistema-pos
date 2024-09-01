<?php

require_once '../config/conexion.php';

class Permisos {
    public function __construct()
    {

    }

    public function listar(){
        $sql = "SELECT * FROM permiso";
        return ejecutarConsulta($sql);
    }

}