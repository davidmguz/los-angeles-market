<?php
session_start();
include_once "funciones.php";

if(isset($_SESSION['clienteVenta'])){
    $cliente = $_SESSION['clienteVenta'];

    // Determinar si es DNI o RUC basado en la longitud
    $fk_dni = strlen($cliente->idCliente) == 8 ? $cliente->idCliente : null;
    $fk_ruc = strlen($cliente->idCliente) == 11 ? $cliente->idCliente : null;

    // Insertar en la tabla clienteventa
    $sentencia = "INSERT INTO clienteventa (fk_dni, fk_ruc) VALUES (?, ?)";
    $parametros = [$fk_dni, $fk_ruc];

    if(insertar($sentencia, $parametros)){
        $_SESSION['clienteVentaId'] = obtenerUltimoIdCliente(); // Cambiado el nombre de la función para mayor claridad
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

function obtenerUltimoIdCliente() {
    $bd = conectarBaseDatos();
    $sentencia = "SELECT MAX(idCliente) AS id FROM clienteventa";
    $respuesta = $bd->query($sentencia);
    return $respuesta->fetchColumn();
}
?>
