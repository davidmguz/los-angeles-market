<?php
$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el usuario';
    exit;
}
include_once "funciones.php";

$resultado = eliminarUsuario($id);


header("Location: usuarios.php");
?>