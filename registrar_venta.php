<?php
include_once "sesion.php";
include_once "funciones.php";
include_once "encabezado.php";
include_once "navbar.php";

// Iniciar la sesión si no se ha hecho
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar que el usuario esté autenticado
if (empty($_SESSION['usuario'])) {
    header("location: login.php");
    exit();
}

// Verificar que la lista de productos esté definida y no esté vacía
if (!isset($_SESSION['lista']) || empty($_SESSION['lista'])) {
    echo "Error: No hay productos en la lista.";
    exit();
}

$listaProductos = $_SESSION['lista'];
$total = calcularTotalLista($listaProductos);

// Verificar que el cliente esté definido
$idCliente = isset($_SESSION['clienteVentaId']) ? $_SESSION['clienteVentaId'] : null;
if (!$idCliente) {
    echo "Error: Cliente no encontrado.";
    exit();
}

try {
    // Registrar la venta y obtener el idVenta
    $idVenta = registrarVenta2($listaProductos, $total, $idCliente);
    if ($idVenta) {
        // Limpiar la lista de productos y cliente de la sesión después de registrar la venta
        unset($_SESSION['lista']);
        unset($_SESSION['clienteVentaId']);
        // Redirigir a la generación de la boleta pasando el idVenta
        header("location: ./fpdf2/boleta.php?idVenta=$idVenta");
        exit(); // Asegurar que se termine la ejecución después de redirigir
    } else {
        echo "Error al registrar la venta. Inténtelo de nuevo.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
