<?php
session_start();
include_once "funciones.php";

if (empty($_SESSION['usuario'])) {
    header("location: login.php");
    exit();
}

$listaProductos = $_SESSION['lista'];
$total = calcularTotalLista($listaProductos);
$idCliente = isset($_SESSION['clienteVentaId']) ? $_SESSION['clienteVentaId'] : null;

if (!$idCliente) {
    echo "Error: Cliente no encontrado.";
    exit();
}

try {
    if (registrarVenta2($listaProductos, $total, $idCliente)) {
        // Limpia la lista de productos y cliente de la sesión después de registrar la venta
        unset($_SESSION['lista']);
        unset($_SESSION['clienteVentaId']);
        header("location: index.php");
    } else {
        echo "Error al registrar la venta. Inténtelo de nuevo.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
