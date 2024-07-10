<?php
session_start();
include_once "funciones.php";

if(isset($_SESSION['clienteVenta'])){
    $cliente = $_SESSION['clienteVenta'];

    $fk_dni = strlen($cliente->idCliente) == 8 ? $cliente->idCliente : null;
    $fk_ruc = strlen($cliente->idCliente) == 11 ? $cliente->idCliente : null;

    $sentencia = "INSERT INTO clienteventa (fk_dni, fk_ruc) VALUES (?, ?)";
    $parametros = [$fk_dni, $fk_ruc];

    if(insertar($sentencia, $parametros)){
        $_SESSION['clienteVentaId'] = obtenerUltimoId();
        header("location: vender.php");
    } else {
        echo '
        <div class="alert alert-danger mt-3" role="alert">
            Hubo un problema al confirmar el cliente.
            <a href="vender.php">Regresar</a>
        </div>';
    }
} else {
    header("location: vender.php");
}
?>
