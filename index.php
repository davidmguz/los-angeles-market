<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
include_once "sesion.php";

// Verificar si el usuario está autenticado
if(empty($_SESSION['usuario'])) {
    header("location: login.php");
    exit();
}

// Asegúrate de que todas las funciones están definidas y manejan errores adecuadamente
$cartas = [
    ["titulo" => "Total ventas", "icono" => "fa fa-money-bill", "total" => "S/. " . obtenerTotalVentas(), "color" => "#A71D45"],
    ["titulo" => "Ventas hoy", "icono" => "fa fa-calendar-day", "total" => "S/. " . obtenerTotalVentasHoy(), "color" => "#2A8D22"],
    ["titulo" => "Ventas semana", "icono" => "fa fa-calendar-week", "total" => "S/. " . obtenerTotalVentasSemana(), "color" => "#223D8D"],
    ["titulo" => "Ventas mes", "icono" => "fa fa-calendar-alt", "total" => "S/. " . obtenerTotalVentasMes(), "color" => "#D55929"],
];

$totales = [
    ["nombre" => "Total productos", "total" => obtenerNumeroProductos(), "imagen" => "img/productos.png"],
    ["nombre" => "Ventas registradas", "total" => obtenerNumeroVentas(), "imagen" => "img/ventas.png"],
    ["nombre" => "Usuarios registrados", "total" => obtenerNumeroUsuarios(), "imagen" => "img/usuarios.png"],
    ["nombre" => "Clientes registrados", "total" => obtenerNumeroClientes(), "imagen" => "img/clientes.png"],
];

$ventasUsuarios = obtenerVentasPorUsuario();
$ventasClientes = obtenerVentasPorCliente();
$productosMasVendidos = obtenerProductosMasVendidos();
?>

<div class="container">
    <div class="alert alert-info" role="alert">
        <h1>Hola, <?= htmlspecialchars($_SESSION['usuario']) ?></h1>
    </div>
    <div class="card-deck row mb-2">
        <?php foreach($totales as $total){ ?>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img class="img-thumbnail" src="<?= htmlspecialchars($total['imagen']) ?>" alt="">
                        <h4 class="card-title">
                            <?= htmlspecialchars($total['nombre']) ?>
                        </h4>
                        <h2><?= htmlspecialchars($total['total']) ?></h2>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php include_once "cartas_totales.php" ?>

    <div class="row mt-2">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>Ventas por usuarios</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre usuario</th>
                                <th>Número ventas</th>
                                <th>Total ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ventasUsuarios as $usuario) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($usuario->Usuario) ?></td>
                                    <td><?= htmlspecialchars($usuario->numeroVentas) ?></td>
                                    <td>S/. <?= htmlspecialchars($usuario->totalVenta) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>5 mejores ventas</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre cliente</th>
                                <th>Número compras</th>
                                <th>Total ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ventasClientes as $cliente) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($cliente->cliente) ?></td>
                                    <td><?= htmlspecialchars($cliente->numeroCompras) ?></td>
                                    <td>S/. <?= htmlspecialchars($cliente->total) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h4>10 Productos más vendidos</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Unidades vendidas</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productosMasVendidos as $producto) { ?>
                <tr>
                    <td><?= htmlspecialchars($producto->nombreProd) ?></td>
                    <td><?= htmlspecialchars($producto->unidades) ?></td>
                    <td>S/. <?= htmlspecialchars($producto->total) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
