<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$idCategoria = $_GET['id'];
if (!$idCategoria) {
    echo 'No se ha seleccionado la categoria';
    exit;
}
include_once "funciones.php";
$categoria = obtenerCategoriaPorId($idCategoria);
?>

<div class="container">
    <h3>Editar categoria</h3>
    <form method="post">
        <div class="mb-3">
            <label for="idCategoria" class="form-label">Código de la categoria</label>
            <input type="text" name="idCategoria" class="form-control" value="<?php echo $categoria->idCategoria;?>" idCategoria="idCategoria" placeholder="Escribe el código de barras del producto">
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Nombre o descripción</label>
            <input type="text" name="categoria" class="form-control" value="<?php echo $categoria->categoria;?>" idCategoria="categoria" placeholder="Ej. Papas">
        </div>
        
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            
            </input>
            <a href="categorias.php" class="btn btn-warning btn-lg">
                <i class="fa fa-times"></i> 
                Regresar
            </a>
        </div>
    </form>
</div>
<?php
if(isset($_POST['registrar'])){
    $idCategoria = $_POST['idCategoria'];
    $categoria = $_POST['categoria'];
    
    if(empty($idCategoria) 
    || empty($categoria) ){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    include_once "funciones.php";
    $resultado = editarCategoria($idCategoria, $categoria);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Información del producto registrada con éxito.
        </div>';
    }
    
}
?>