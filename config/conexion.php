<?php

require_once 'global.php';

$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

mysqli_query($con, 'SET NAMES "'.DB_ENCODE.'"');

if(mysqli_connect_errno()){
    print("Falló la conexión a la base de datos: %s\n".mysqli_connect_error());
    exit;
}

function ejecutarConsulta($sql){
    global $con;
    $query = $con->query($sql);
    return $query;
}

function ejecutarConsultaUnica($sql){
    global $con;
    $query = $con->query($sql);
    $row = $query->fetch_assoc();
    return $row;
}

function ejecutarConsulta_retornarID($sql){
    global $con;
    $query = $con->query($sql);
    return $con->insert_id;
}

function limpiarCadena($str){
    global $con;
    $str = mysqli_real_escape_string($con, trim($str));
    return htmlspecialchars($str);
}