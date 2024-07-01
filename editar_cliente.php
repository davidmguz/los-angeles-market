<?php
include_once "encabezado.php";
include_once "navbar.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$idPersona = $_GET['id'];
if (!$idPersona) {
    echo 'No se ha seleccionado el cliente';
    exit;
}
include_once "funciones.php";
$cliente = obtenerClientePorId($idPersona);

if (!$cliente) {
    echo 'Cliente no encontrado';
    exit;
}

if(isset($_POST['editar'])){
    $idPersona=$_POST['idpersona'];
    $DNI_Persona=$_POST['dni'];
    $Nombres = $_POST['nombres'];
    $PrimerApellido = $_POST['primerapellido'];
    $SegundoApellido = $_POST['segundoapellido'];
    $Telefonocli = $_POST['telefono'];
    $direccioncli = $_POST['direccion'];
    $emailcli = $_POST['email'];
    if( empty($idPersona)
    ||empty($DNI_Persona)
    || empty($Nombres) 
    || empty($PrimerApellido) 
    || empty($SegundoApellido)
    || empty($Telefonocli)
    || empty($direccioncli)
    || empty($emailcli)){
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    $resultado = editarCliente($DNI_Persona, $Nombres, $PrimerApellido, $SegundoApellido,$Telefonocli, $direccioncli, $emailcli,$idPersona);
    if($resultado){
        echo'
        <div class="alert alert-success mt-3" role="alert">
            Información del cliente actualizada con éxito.
        </div>';
        // Redirigir después de la actualización para limpiar el formulario
        
        header("Location: clientes.php");
        exit();
    } else {
        echo'
        <div class="alert alert-danger mt-3" role="alert">
            Hubo un problema al actualizar la información del cliente.
        </div>';
    }
}

?>
<div class="container">
    <h3>Editar cliente</h3>
    <form method="post">
    <div class="mb-3">
            <label for="idpersona" class="form-label">Se muestra el ID</label>
            <input type="text" name="idpersona" class="form-control" value="<?php echo htmlspecialchars($cliente->idPersona); ?>" id="idPersona" placeholder="Este es el dni de la persona"readonly>
        </div>
        <div class="mb-3">
            <label for="dni" class="form-label">Se muestra el DNI</label>
            <input type="text" name="dni" class="form-control" value="<?php echo htmlspecialchars($cliente->DNI_Persona); ?>" id="dni" placeholder="Este es el dni de la persona"readonly>
        </div>
        <div class="mb-3">
            <label for="nombres" class="form-label">Se muestra el nombre</label>
            <input type="text" name="nombres" class="form-control" value="<?php echo htmlspecialchars($cliente->Nombres); ?>" id="nombres" placeholder="Ej. 2111568974"readonly>
        </div>
        <div class="mb-3">
            <label for="primerapellido" class="form-label">Se muestra el primer apellido</label>
            <input type="text" name="primerapellido" class="form-control" value="<?php echo htmlspecialchars($cliente->PrimerApellido); ?>" id="primerapellido" placeholder="Ej. Av Collar 1005 Col Las Cruces"readonly>
        </div>
        <div class="mb-3">
            <label for="segundoapellido" class="form-label">Se muestra el segundo apellido</label>
            <input type="text" name="segundoapellido" class="form-control" value="<?php echo htmlspecialchars($cliente->SegundoApellido); ?>" id="segundoapellido" placeholder="Ej. 76894456"readonly>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($cliente->Telefonocli); ?>" id="telefono" placeholder="Ej. 76894456">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" name="direccion" class="form-control" value="<?php echo htmlspecialchars($cliente->direccioncli); ?>" id="direccion" placeholder="Ej. 76894456">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($cliente->emailcli); ?>" id="email" placeholder="Ej. zzz@gmail.com">
        </div>

        <div class="text-center mt-3">
            <input type="submit" name="editar" value="Guardar Cambios" class="btn btn-primary btn-lg">
            <a href="clientes.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
        </div>
    </form>
</div>
