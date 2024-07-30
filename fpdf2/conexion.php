<?php

$servername = "ventas-php.c5syycss4ofr.us-east-2.rds.amazonaws.com";
$username = "root";
$port = 3306;
$password = "ventas1234";
$dbname = "ventas_php";

// Crear conexión
$mysql = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($mysql->connect_error) {
    echo 'Error de conexion: ' . $mysql->connect_error;
    exit;
}

// Resto del código
