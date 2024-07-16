<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$id = $_GET['id'];
if (!$id) {
    echo 'No se ha seleccionado el producto';
    exit;
}
include_once "funciones.php";
$producto = obtenerProductoPorId($id);
$categorias = obtenerCategorias2();
$proveedores = obtenerProveedores2();
?>

<div class="container">
    <h3>Editar producto</h3>
    <form method="post">
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre o descripción</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $producto->nombreProd;?>" id="nombre" placeholder="Ej. Papas">
        </div>
        
        <div class="row">
            <div class="col">
                <label for="compra" class="form-label">Precio compra</label>
                <input type="number" name="compra" step="any" value="<?php echo $producto->precioCompra;?>" id="compra" class="form-control" placeholder="Precio de compra" aria-label="">
            </div>
            <div class="col">
                <label for="venta" class="form-label">Precio venta</label>
                <input type="number" name="venta" step="any" value="<?php echo $producto->precioVenta;?>" id="venta" class="form-control" placeholder="Precio de venta" aria-label="">
            </div>
            <div class="col">
                <label for="existencia" class="form-label">Existencia</label>
                <input type="number" name="existencia" step="any" value="<?php echo $producto->existencia;?>" id="existencia" class="form-control" placeholder="Existencia" aria-label="">
            </div>
            <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $producto->descricpionProd;?>" placeholder="Descripción">
        </div>
        <div class="row">
            <div class="col">
                <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control"value="<?php echo $producto->fechavencimiento;?>" placeholder="Fecha de vencimiento">
            </div> 
            
            <div class="col">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-select" name="categoria" id="categoria">
                    <option selected value="">Selecciona una categoría</option>
                    <?php foreach($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria->idCategoria; ?>"><?php echo $categoria->categoria; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col">
                <label for="proveedor" class="form-label">Proveedor</label>
                <select class="form-select" name="proveedor" id="proveedor">
                    <option selected value="">Selecciona un proveedor</option>
                    <?php foreach($proveedores as $proveedor) { ?>
                        <option value="<?php echo $proveedor->id_Proveedor; ?>"><?php echo $proveedor->NombreEmpresa; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="codigo" class="form-label">Código de barras</label>
            <input type="number" name="codigo" class="form-control" value="<?php echo $producto->codigo;?>"id="codigo" placeholder="Escribe el código de barras del producto">
        </div>
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            
            </input>
            <a href="productos.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
        </div>
    </form>
</div>
<?php
if(isset($_POST['registrar'])){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $compra = $_POST['compra'];
    $venta = $_POST['venta'];
    $existencia = $_POST['existencia'];
    $descripcion = $_POST['descripcion'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $categoria = $_POST['categoria'];
    $proveedor = $_POST['proveedor'];

    if(empty($codigo) || empty($nombre) || empty($compra) || empty($venta) || empty($existencia) || empty($descripcion) || empty($fecha_vencimiento) || empty($categoria) || empty($proveedor)) {
        echo '
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    }
    
    include_once "funciones.php";
    $resultado = editarProducto($codigo, $nombre, $compra, $venta, $existencia, $descripcion, $fecha_vencimiento, $categoria, $proveedor, $id);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Información del producto registrada con éxito.
        </div>';
    }
    
}
?>