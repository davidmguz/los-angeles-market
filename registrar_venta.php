<?php
session_start();
include_once "funciones.php";

if(empty($_SESSION['usuario'])) header("location: login.php");

$listaProductos = $_SESSION['lista'];
$total = calcularTotalLista($listaProductos);

$clienteVentaId = isset($_SESSION['clienteVentaId']) ? $_SESSION['clienteVentaId'] : null;

if(registrarVenta2($listaProductos, $total, $clienteVentaId)){
    unset($_SESSION['lista']);
    unset($_SESSION['clienteVenta']);
    unset($_SESSION['clienteVentaId']);
    echo '
    <div class="alert alert-success mt-3" role="alert">
        Venta registrada con éxito.
        <a href="vender.php">Regresar</a>
    </div>';
} else {
    echo '
    <div class="alert alert-danger mt-3" role="alert">
        Hubo un problema al registrar la venta.
        <a href="vender.php">Regresar</a>
    </div>';
}
?>
