<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'dbsistema');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_ENCODE', 'utf8');
define('SYSTEM_NAME', 'POS_SYSTEM');

function asset($path) {
    $path = "/sistema-pos/public/$path";
    return $path;
}