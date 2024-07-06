<?php
session_start();
$id = $_GET['idProducto'];
$listaProductos = $_SESSION['lista'];

foreach ($listaProductos as $key => $producto) {
    if ($producto->idProducto == $id) {
        if ($producto->cantidad > 1) {
            // Si la cantidad es mayor a 1, reduce la cantidad en 1
            $listaProductos[$key]->cantidad -= 1;
        } else {
            // Si la cantidad es 1, elimina el producto del arreglo
            unset($listaProductos[$key]);
        }
        break; // Detener el bucle una vez encontrado y actualizado/eliminado el producto
    }
}

// Reindexar el array para evitar índices vacíos
$_SESSION['lista'] = array_values($listaProductos);
header("location: vender.php");
?>
