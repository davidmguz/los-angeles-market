<?php

require './conexion.php';
require './fpdf.php';

$idVenta = isset($_GET['id']) ? $mysqli->real_escape_string($_GET['id']) : 1;

$sqlVenta="SELECT idVenta, fechaVenta, totalVenta FROM venta WHERE idVenta=$idVenta LIMIT 1";
$resultado = $mysqli->query($sqlVenta);
$row_venta = $resultado->fetch_assoc();

$total=$row_venta['totalVenta'];

$sqlDetalle="SELECT cantidad, precio, idProducto, idVenta FROM productos_ventas WHERE id=$idVenta";
$resultadoDetalle = $mysqli->query($sqlDetalle);

$pdf=new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 9);


$pdf->Output();