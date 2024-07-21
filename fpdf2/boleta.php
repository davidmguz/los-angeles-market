<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './conexion.php';
require './fpdf.php';

define('MONEDA', 'S/.');

$idVenta = isset($_GET['id']) ? $mysql->real_escape_string($_GET['id']) : 57;

$sqlVenta="SELECT idVenta, fechaVenta, totalVenta FROM venta WHERE idVenta=$idVenta LIMIT 1";
$resultado = $mysql->query($sqlVenta);
$row_venta = $resultado->fetch_assoc();

$total=$row_venta['totalVenta'];

$sqlDetalle="SELECT venta.idVenta, venta.fechaVenta, venta.totalVenta, productoventas.cantidad, productoventas.preciototal, 
producto.nombreProd, producto.descricpionProd, producto.precioVenta from venta 
INNER JOIN productoventas on venta.idVenta=productoventas.fk_idventa
INNER JOIN producto on producto.idProducto=productoventas.fk_idproducto
WHERE venta.idVenta=$idVenta";
$resultadoDetalle = $mysql->query($sqlDetalle);

$pdf=new FPDF('P', 'mm', array(80, 200));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Image('img/logo.png', 19, -7, 40);
$pdf->Ln(18);

$pdf->MultiCell(70, 5, 'Minimarket Los Angeles', 0, 'C');
$pdf->Ln(1);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 5, mb_convert_encoding('N° venta:', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(15, 5, $row_venta['idVenta'], 0, 1, 'L');

$pdf->Cell(70, 2, '-------------------------------------------------------------------------', 0, 1, 'L');

$pdf->Cell(10, 4, 'Cant. ', 0, 0, 'L');
$pdf->Cell(30, 4, mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(15, 4, 'Precio ', 0, 0, 'L');
$pdf->Cell(15, 4, 'Importe ', 0, 1, 'L');

$pdf->Cell(70, 2, '-------------------------------------------------------------------------', 0, 1, 'L');

$totalProductos=0;
$pdf->SetFont('Arial', '', 7);

while($row_producto=$resultadoDetalle->fetch_assoc()){
    $importe=$row_producto['preciototal'];
    #$totalProducto += $row_producto['cantidad'];

    $pdf->Cell(10, 4, $row_producto['cantidad'], 0, 0, 'L');
    
    $yInicio=$pdf->GetY();
    $pdf->MultiCell(30, 4, mb_convert_encoding($row_producto['nombreProd'], 'ISO-8859-1', 'UTF-8'), 0, 'L');
    $yFin=$pdf->GetY();

    $pdf->SetXY(45, $yInicio);

    $pdf->Cell(15, 4, MONEDA. ' ' . $row_producto['precioVenta'], 0, 0, 'L');
    $pdf->Cell(15, 4, MONEDA. '' . $row_producto['preciototal'], 0, 1, 'L');

    $pdf->SetY($yFin);
}

$pdf->Ln();

#$pdf->Cell(70, 4, mb_convert_encoding("Número de productos vendidos:", 'ISO-8859-1', 'UTF-8') . $totalProducto, 0, 1, 'L');

$pdf->Output();