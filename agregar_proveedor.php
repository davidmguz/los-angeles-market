<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "sesion.php";

if(empty($_SESSION['usuario'])) header("location: login.php");

if (isset($_POST['buscar'])) {
    $ruc = $_POST['ruc'];
    if (!empty($ruc)) {
        $empresa = buscarEmpresaPorRUC($ruc);
    }
}
// Comandos

function buscarEmpresaPorRUC($ruc) {
    $token = 'apis-token-7410.rcjsAzQ2MeFkxq92XKMITNsQhkfO4bZC';
    
    // Iniciar llamada a API
    $curl = curl_init();
    
    // Buscar ruc sunat
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $ruc,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Referer: http://apis.net.pe/api-ruc',
        'Authorization: Bearer ' . $token
      ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    
    // Datos de empresas según padron reducido
    return json_decode($response, true);
}
?>

<div class="container">
    <h3>Agregar proveedor</h3>
    <form method="post">
        <div class="mb-3">
            <label for="ruc" class="form-label">RUC</label>
            <div class="input-group">
                <input type="number" name="ruc" class="form-control" min="10000000000" max="99999999999" id="ruc" placeholder="Ej. 20698753468" value="<?php echo isset($_POST['ruc']) ? htmlspecialchars($_POST['ruc']) : ''; ?>">
                <button type="submit" name="buscar" class="btn btn-info">Buscar</button>
            </div>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Escribe el nombre de la empresa" value="<?php echo isset($empresa['razonSocial']) ? htmlspecialchars($empresa['razonSocial']) : ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="condicion" class="form-label">Condicion</label>
            <input type="text" name="condicion" class="form-control" id="condicion" placeholder="Escribe el nombre de la empresa" value="<?php echo isset($empresa['condicion']) ? htmlspecialchars($empresa['condicion']) : ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" name="estado" class="form-control" id="estado" placeholder="Escribe el nombre de la empresa" value="<?php echo isset($empresa['estado']) ? htmlspecialchars($empresa['estado']) : ''; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" id="direccion" placeholder="Ej. Av Collar 1005 Col Las Cruces" value="<?php echo isset($empresa['direccion']) ? htmlspecialchars($empresa['direccion']) : ''; ?>"readonly>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Ej. 2111568974" min="100000000" max="999999999">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Ej. juan@gmail.com">
        </div>
        <div class="text-center mt-3">
            <input type="submit" name="registrar" value="Registrar" class="btn btn-primary btn-lg">
            <a href="proveedores.php" class="btn btn-danger btn-lg">
                <i class="fa fa-times"></i> 
                Cancelar
            </a>
           
        </div>
    </form>
</div>

<?php
if (isset($_POST['registrar'])) {
    $ruc = $_POST['ruc'];
    $nombre = $_POST['nombre'];
    $condicion = $_POST['condicion'];
    $estado = $_POST['estado'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = !empty($_POST['email']) ? $_POST['email'] : null;

    if (empty($ruc) 
    || empty($nombre) 
    || empty($condicion)
    || empty($estado)
    || empty($telefono) 
    || empty($direccion)
    || empty($email) ) {
        echo '
        <div class="alert alert-danger mt-3" role="alert">
            Debes completar todos los datos.
        </div>';
        return;
    } 
    
    include_once "funciones.php";
    $resultado = registrarProveedor($ruc, $nombre,$condicion,$estado, $telefono, $direccion, $email);
    if ($resultado) {
        echo '
        <div class="alert alert-success mt-3" role="alert">
            Empresa registrada con éxito.
        </div>';
    }
}
?>
