<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if (empty($_SESSION['usuario'])) header("location: login.php");

$roles = obtenerRoles2();
$persona = null;
$dni = '';

if (isset($_POST['buscar'])) {
    $dni = $_POST['dni'];
    $persona = obtenerPersonaPorDNI2($dni);
}
?>

<div class="container">
    <h3>Agregar usuario</h3>
    <form method="post">
        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="number" name="dni" class="form-control" min="1000000" max="99999999" id="dni" placeholder="Escribe el DNI del usuario" value="<?php echo htmlspecialchars($dni); ?>">
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="buscar" value="Buscar" class="btn btn-primary btn-lg">
        </div>
    </form>

    <?php if ($persona): ?>
    <form method="post">
        <div class="mb-3">
            <label for="usuario" class="form-label">Nombre de colaborador</label>
            <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Escribe el nombre de usuario. Ej. Paco">
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo htmlspecialchars($persona->Nombres); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" id="telefono" value="<?php echo htmlspecialchars($persona->PrimerApellido); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" id="direccion" value="<?php echo htmlspecialchars($persona->SegundoApellido); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="text" name="contrasena" class="form-control" id="contrasena" placeholder="abc@£“">
        </div>
        <div class="mb-3">
            <label for="roles" class="form-label">Rol</label>
            <select name="fk_idRoles" id="roles" class="form-select">
                <?php foreach ($roles as $rol): ?>
                <option value="<?php echo htmlspecialchars($rol->idRoles); ?>"><?php echo htmlspecialchars($rol->Descripcion); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text-center mt-3">
            <input type="hidden" name="fk_idPersona" value="<?php echo htmlspecialchars($persona->DNI_Persona); ?>">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            <a href="usuarios.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> Cancelar
            </a>
        </div>
    </form>
    <?php endif; ?>
</div>

<?php
if (isset($_POST['registrar'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $fk_idRoles = $_POST['fk_idRoles'];
    $fk_idPersona = $_POST['fk_idPersona'];

    if (empty($usuario) || empty($contrasena)) {
        echo '
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    }

    $resultado = registrarColaborador($usuario, $contrasena, $fk_idPersona, $fk_idRoles);
    if ($resultado) {
        echo '
        <div class="alert alert-success mt-3" role="alert">
            Usuario registrado con éxito.
        </div>';
    }
}
?>
