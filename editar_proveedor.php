<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$id_Proveedor = $_GET['id'];
if (!$id_Proveedor) {
    echo 'No se ha seleccionado la empresa';
    exit;
}
include_once "funciones.php";
$empresa = obtenerProveedorPorId($id_Proveedor);

if (!$empresa) {
    echo 'Empresa no encontrado';
    exit;
}

if(isset($_POST['editar'])){
    $id_Proveedor=$_POST['idproveedor'];
    $RUC_Prov=$_POST['ruc'];
    $NombreEmpresa = $_POST['nombreempresa'];
    $Condicion = $_POST['condicion'];
    $Estado = $_POST['estado'];
    $telefono_Proveedor = $_POST['telefonoproveedor'];
    $Direccion_Proveedor = $_POST['direccionproveedor'];
    $EmailProv = $_POST['emailproveedor'];
   
    if( empty($id_Proveedor)
    ||empty($RUC_Prov)
    || empty($NombreEmpresa) 
    || empty($Condicion) 
    || empty($Estado) 
    || empty($telefono_Proveedor) 
    || empty($Direccion_Proveedor)
    || empty($EmailProv)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    $resultado = editarProveedor($RUC_Prov, $NombreEmpresa,$Condicion,$Estado, $telefono_Proveedor, $Direccion_Proveedor,$EmailProv,$id_Proveedor);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Información del empresa actualizada con éxito.
        </div>';
        // Redirigir después de la actualización para limpiar el formulario
        
        header("Location: proveedores.php");
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
            <label for="idproveedor" class="form-label">Se muestra el ID</label>
            <input type="text" name="idproveedor" class="form-control" value="<?php echo htmlspecialchars($empresa->id_Proveedor); ?>" id="idproveedor" placeholder="Este es el dni de la persona"readonly>
        </div>
        <div class="mb-3">
            <label for="ruc" class="form-label">Se muestra el RUC</label>
            <input type="text" name="ruc" class="form-control" value="<?php echo htmlspecialchars($empresa->RUC_Prov); ?>" id="ruc" placeholder="Este es el dni de la persona"readonly>
        </div>
        <div class="mb-3">
            <label for="nombreempresa" class="form-label">Se muestra el Nombre de la Empresa</label>
            <input type="text" name="nombreempresa" class="form-control" value="<?php echo htmlspecialchars($empresa->NombreEmpresa); ?>" id="nombreempresa" placeholder="Ej. 2111568974"readonly>
        </div>
        <div class="mb-3">
            <label for="condicion" class="form-label">Condicion</label>
            <input type="text" name="condicion" class="form-control" value="<?php echo htmlspecialchars($empresa->Condicion); ?>" id="condicion" placeholder="Ej. 2111568974"readonly>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" name="estado" class="form-control" value="<?php echo htmlspecialchars($empresa->Estado); ?>" id="estado" placeholder="Ej. 2111568974"readonly>
        </div>
        <div class="mb-3">
            <label for="direccionproveedor" class="form-label">Direccion</label>
            <input type="text" name="direccionproveedor" class="form-control" value="<?php echo htmlspecialchars($empresa->Direccion_Proveedor); ?>" id="direccionproveedor" placeholder="Ej. 76894456"readonly>
        </div>
        <div class="mb-3">
            <label for="telefonoproveedor" class="form-label">Telefono </label>
            <input type="text" name="telefonoproveedor" class="form-control" value="<?php echo htmlspecialchars($empresa->telefono_Proveedor); ?>" id="telefonoproveedor" placeholder="Ej. Av Collar 1005 Col Las Cruces">
        </div>
        
        <div class="mb-3">
            <label for="emailproveedor" class="form-label">Email </label>
            <input type="text" name="emailproveedor" class="form-control" value="<?php echo htmlspecialchars($empresa->EmailProv); ?>" id="emailproveedor" placeholder="Ej. 76894456">
        </div>
        
        <div class="text-center mt-3">
            <input type="submit" name="editar" value="Guardar Cambios" class="btn btn-primary btn-lg">
            <a href="proveedores.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
        </div>
    </form>
</div>
