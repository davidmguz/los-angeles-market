<?php
session_start();
include_once "funciones.php";

if(isset($_POST['identificador_cliente'])){
    $identificador = $_POST['identificador_cliente'];
    $cliente = null;

    if(strlen($identificador) == 8){ // Suponiendo que el DNI tiene 8 dígitos
        $cliente = obtenerClientePorDNI($identificador);
    } elseif(strlen($identificador) == 11){ // Suponiendo que el RUC tiene 11 dígitos
        $cliente = obtenerClientePorRUC($identificador);
    }

    if($cliente){
        $_SESSION['clienteVenta'] = $cliente;
        $_SESSION['mensajeClienteNoEncontrado'] = '';
    } else {
        $_SESSION['clienteVenta'] = null;
        $_SESSION['mensajeClienteNoEncontrado'] = "No se encontró el cliente con el identificador proporcionado.";
    }

    header("location: vender.php");
} else {
    header("location: vender.php");
}
?>
