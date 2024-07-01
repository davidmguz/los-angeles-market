<?php
$id_Proveedor = $_GET['id'];
if (!$id_Proveedor) {
    echo 'No se ha seleccionado el cliente';
    exit;
}
include_once "funciones.php";

$resultado = eliminarProveedor($id_Proveedor);


header("Location: proveedores.php");
?>