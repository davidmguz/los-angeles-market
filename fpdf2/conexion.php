<?php

$mysql=new mysqli("localhost", "usuario", "password", "ventas_php");
if($mysql->connect_error) {
    echo 'Error de conexion: ' . $mysql->connect_error;
    exit;
}