<?php
$idCategoria = $_GET['id'];
if (!$idCategoria) {
    echo 'No se ha seleccionado el producto';
    exit;
}
include_once "funciones.php";

$resultado = eliminarCategoria($idCategoria);


header("Location: categorias.php");
?>