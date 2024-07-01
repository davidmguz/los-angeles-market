<?php
session_start();
$id = $_GET['id'];
$producto = $_SESSION['lista'];

foreach ($producto as $key => $producto) {
	if($producto->id == $id){
		unset($producto[$key]);
	}
}

$_SESSION['lista'] = $producto;
header("location: vender.php");
?>