<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$id_Empresa = $_GET['id'];
if (!$id_Empresa) {
    echo 'No se ha seleccionado la empresa';
    exit;
}
include_once "funciones.php";
$empresa = obtenerEmpresaPorId($id_Empresa);

if (!$empresa) {
    echo 'Empresa no encontrado';
    exit;
}

if(isset($_POST['editar'])){
    $id_Empresa=$_POST['idempresa'];
    $RUC=$_POST['ruc'];
    $NombreEmpresa = $_POST['nombreempresa'];
    $TelefonoEmpresa = $_POST['telefonoempresa'];
    $DireccionEmpresa = $_POST['direccionempresa'];
    $EmailEmpresa = $_POST['emailempresa'];
   
    if( empty($id_Empresa)
    ||empty($RUC)
    || empty($NombreEmpresa) 
    || empty($TelefonoEmpresa) 
    || empty($DireccionEmpresa)
    || empty($EmailEmpresa)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    $resultado = editarEmpresa($RUC, $NombreEmpresa, $TelefonoEmpresa, $DireccionEmpresa,$EmailEmpresa,$id_Empresa);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Información del empresa actualizada con éxito.
        </div>';
        // Redirigir después de la actualización para limpiar el formulario
        
        header("Location: empresas.php");
        exit();
    } else {
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Hubo un problema al actualizar la información de la empresa.
        </div>';
    }
}

?>
<div class="container">
    <h3>Editar empresa</h3>
    <form method="post">
    <div class="mb-3">
            <label for="idempresa" class="form-label">Se muestra el ID</label>
            <input type="text" name="idempresa" class="form-control" value="<?php echo htmlspecialchars($empresa->id_Empresa); ?>" id="idempresa" placeholder="Este es el dni de la persona"readonly>
        </div>
        <div class="mb-3">
            <label for="ruc" class="form-label">Se muestra el RUC</label>
            <input type="text" name="ruc" class="form-control" value="<?php echo htmlspecialchars($empresa->RUC); ?>" id="ruc" placeholder="Este es el dni de la persona"readonly>
        </div>
        <div class="mb-3">
            <label for="nombreempresa" class="form-label">Se muestra el Nombre de la Empresa</label>
            <input type="text" name="nombreempresa" class="form-control" value="<?php echo htmlspecialchars($empresa->NombreEmpresa); ?>" id="nombreempresa" placeholder="Ej. 2111568974"readonly>
        </div>
        <div class="mb-3">
            <label for="direccionempresa" class="form-label">Se muestra la direccion de la empresa</label>
            <input type="text" name="direccionempresa" class="form-control" value="<?php echo htmlspecialchars($empresa->DireccionEmpresa); ?>" id="direccionempresa" placeholder="Ej. 76894456"readonly>
        </div>
        <div class="mb-3">
            <label for="telefonoempresa" class="form-label">Telefono de la empresa</label>
            <input type="text" name="telefonoempresa" class="form-control" value="<?php echo htmlspecialchars($empresa->TelefonoEmpresa); ?>" id="telefonoempresa" placeholder="Ej. Av Collar 1005 Col Las Cruces">
        </div>
        
        <div class="mb-3">
            <label for="emailempresa" class="form-label">Email de la empresa</label>
            <input type="text" name="emailempresa" class="form-control" value="<?php echo htmlspecialchars($empresa->EmailEmpresa); ?>" id="emailempresa" placeholder="Ej. 76894456">
        </div>
        
        <div class="text-center mt-3">
            <input type="submit" name="editar" value="Guardar Cambios" class="btn btn-primary btn-lg">
            <a href="empresas.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
        </div>
    </form>
</div>
