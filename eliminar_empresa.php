<?php
$id_Empresa = $_GET['id'];
if (!$id_Empresa) {
    echo 'No se ha seleccionado el cliente';
    exit;
}
include_once "funciones.php";

$resultado = eliminarEmpresa($id_Empresa);


header("Location: empresas.php");
?>