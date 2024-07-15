<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$categorias = obtenerCategorias2();
$proveedores = obtenerProveedores2();
?>
<div class="container">
    <h3>Agregar producto</h3>
    <form method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre o descripción</label>
            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ej. Papas">
        </div>
        <div class="row">
            <div class="col">
                <label for="compra" class="form-label">Precio compra</label>
                <input type="number" name="compra" step="any" id="compra" class="form-control" placeholder="Precio de compra">
            </div>
            <div class="col">
                <label for="venta" class="form-label">Precio venta</label>
                <input type="number" name="venta" step="any" id="venta" class="form-control" placeholder="Precio de venta">
            </div>
            <div class="col">
                <label for="existencia" class="form-label">Existencia</label>
                <input type="number" name="existencia" step="any" id="existencia" class="form-control" placeholder="Existencia">
            </div>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción">
        </div>
        <div class="row">
            <div class="col">
                <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" placeholder="Fecha de vencimiento">
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
            <input type="number" name="codigo" class="form-control" id="codigo" placeholder="Escribe el código de barras del producto">
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            <a class="btn btn-danger btn-lg" href="productos.php">
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

    $resultado = registrarProducto($codigo, $nombre, $compra, $venta, $existencia, $descripcion, $fecha_vencimiento, $categoria, $proveedor);
    if($resultado){
        echo '
        <div class="alert alert-success mt-3" role="alert">
            Producto registrado con éxito.
        </div>';
    }
}
?>
