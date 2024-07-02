<?php
$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el producto';
    exit;
}
include_once "funciones.php";

$resultado = eliminarProducto($id);


header("Location: productos.php");
?>