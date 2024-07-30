<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './conexion.php';
require './fpdf.php';
require '../helpers/NumeroALetras.php';

define('MONEDA', 'S/.');
define('MONEDA_LETRA', 'Soles');
define('MONEDA_DECIMAL', 'Centavos');

#$idVenta = isset($_GET['id']) ? $mysql->real_escape_string($_GET['id']) : 57;
$idVenta = $_SESSION['idVenta'];
#$sqlIdVentaMax="SELECT MAX(idVenta) AS maximo FROM venta";
#$resul = $mysql->query($sqlIdVentaMax);
#$row_id = $resul ->fetch_assoc();
#$idVenta=$row_id['maximo'];

$sqlVenta="SELECT idVenta, DATE_FORMAT(fechaVenta, '%d/%m/%y') as fecha_venta, DATE_FORMAT(fechaVenta, '%H:%i') as hora, totalVenta FROM venta WHERE idVenta=$idVenta LIMIT 1";
$resultado = $mysql->query($sqlVenta);
$row_venta = $resultado->fetch_assoc();

$total=number_format($row_venta['totalVenta'], 2, '.', ',');

$sqlDetalle="SELECT venta.idVenta, DATE_FORMAT(venta.fechaVenta, '%d/%m/%y') as fecha_venta,
DATE_FORMAT(venta.fechaVenta, '%H:%i') as hora,   
venta.totalVenta, productoventas.cantidad, productoventas.preciototal, 
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
    $totalProductos += $row_producto['cantidad'];

    $pdf->Cell(10, 4, $row_producto['cantidad'], 0, 0, 'L');
    
    $yInicio=$pdf->GetY();
    $pdf->MultiCell(30, 4, mb_convert_encoding($row_producto['nombreProd'] . $row_producto['descricpionProd'], 'ISO-8859-1', 'UTF-8'), 0, 'L');
    $yFin=$pdf->GetY();

    $pdf->SetXY(45, $yInicio);

    $pdf->Cell(15, 4, MONEDA. ' ' . $row_producto['precioVenta'], 0, 0, 'L');
    $pdf->Cell(15, 4, MONEDA. '' . $row_producto['preciototal'], 0, 1, 'L');

    $pdf->SetY($yFin);

}

$pdf->Ln();

$pdf->Cell(70, 4, mb_convert_encoding("Número de productos: ", 'ISO-8859-1', 'UTF-8') . $totalProductos, 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);

$pdf->Cell(70, 5, 'Total: ' . MONEDA . ' ' . $total, 0, 1, 'R');

$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(70, 4, 'Son ' . NumeroALetras::convertir($total, MONEDA_LETRA, MONEDA_DECIMAL), 0, 'L');

$pdf->Ln();

$pdf->Cell(35, 5, 'Fecha: ' . $row_venta['fecha_venta'], 0, 0, 'C');
$pdf->Cell(35, 5, 'Hora: ' . $row_venta['hora'], 0, 0, 'C');

$pdf->Ln(10);

$pdf->MultiCell(70, 5, 'AGRADECEMOS SU PREFERENCIA, VUELVA PRONTO!!!', 0, 'C');

$pdf->Output();