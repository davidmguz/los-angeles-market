<?php

$servername = "localhost";
$username = "root";
$port = 3307;
$password = "";
$dbname = "ventas_php";

$mysql=new mysqli($servername, $username, $password, $dbname, $port);
if($mysql->connect_error) {
    echo 'Error de conexion: ' . $mysql->connect_error;
    exit;
}