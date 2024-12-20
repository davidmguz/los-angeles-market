<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
include_once "sesion.php";

if(empty($_SESSION['usuario'])) header("location: login.php");
$nombreProducto = (isset($_POST['nombreProducto'])) ? $_POST['nombreProducto'] : null;

$productos = obtenerProductos($nombreProducto);

$cartas = [
    ["titulo" => "No. Productos - General", "icono" => "fa fa-box", "total" => count($productos), "color" => "#3578FE"],
    ["titulo" => "Suma total de productos", "icono" => "fa fa-shopping-cart", "total" => obtenerNumeroProductos(), "color" => "#4F7DAF"],
    ["titulo" => "Total inventario", "icono" => "fa fa-money-bill", "total" => "S/.". obtenerTotalInventario(), "color" => "#1FB824"],
    ["titulo" => "Ganancia", "icono" => "fa fa-wallet", "total" => "S/.". calcularGananciaProductos(), "color" => "#D55929"],
];
?>
<div class="container mt-3">
    <h1>
        <a class="btn btn-success btn-lg" href="agregar_producto.php">
            <i class="fa fa-plus"></i>
            Agregar
        </a>
        Productos
    </h1>
    <?php include_once "cartas_totales.php"; ?>

    <form action="" method="post" class="input-group mb-3 mt-3">
        <input autofocus name="nombreProducto" type="text" class="form-control" placeholder="Escribe el nombre o código del producto que deseas buscar" aria-label="Nombre producto" aria-describedby="button-addon2">
        <button type="submit" name="buscarProducto" class="btn btn-primary" id="button-addon2">
            <i class="fa fa-search"></i>
            Buscar
        </button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio compra</th>
                <th>Precio venta</th>
                <th>Ganancia</th>
                <th>Existencia</th>
                <th>FechaVencimiento</th>
                <th>Descripcion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($productos as $producto){
            ?>
                <tr>
                    <td><?= $producto->codigo; ?></td>
                    <td><?= $producto->nombreProd; ?></td>
                    <td><?= 'S/. '.$producto->precioCompra; ?></td>
                    <td><?= 'S/. '.$producto->precioVenta; ?></td>
                    <td><?= 'S/. '. floatval($producto->precioVenta - $producto->precioCompra); ?></td>
                    <td><?= $producto->existencia; ?></td>
                   <td><?= $producto->fechavencimiento; ?></td> 
                   <td><?= $producto->descricpionProd; ?></td>
                   
                    
                    <td>
                        <a class="btn btn-info" href="editar_producto.php?id=<?= $producto->idProducto; ?>">
                            <i class="fa fa-edit"></i>
                            Editar
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="eliminar_producto.php?id=<?= $producto->idProducto; ?>">
                            <i class="fa fa-trash"></i>
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
