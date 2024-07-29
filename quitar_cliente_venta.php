<?php
include_once "sesion.php";
$_SESSION['clienteVenta'] = "";
header("location: vender.php");
?>