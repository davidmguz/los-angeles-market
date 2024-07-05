<?php

define("PASSWORD_PREDETERMINADA", "Jeampierre");
define("HOY", date("Y-m-d"));

function iniciarSesion($usuario, $password){
    $sentencia = "SELECT  idColaborador, Usuario FROM colaboradores WHERE Usuario  =?";
    $resultado = select($sentencia, [$usuario]);
    if($resultado){
        $usuario = $resultado[0];
        $verificaPass = verificarPassword($usuario->idColaborador, $password);
        if($verificaPass) return $usuario;
    }
}

#PROBANDO LOGIN
function iniciarSesion2($usuario, $password){
    $sentencia = "SELECT id, Usuario FROM colaboradores WHERE Usuario  = ?";
    $resultado = select($sentencia, [$usuario]);
    if($resultado){
        $usuario = $resultado[0];
        $verificaPass = verificarPassword($usuario->id, $password);
        if($verificaPass) return $usuario;
    }
}

function verificarPassword($idUsuario, $password){
    $sentencia = "SELECT password FROM colaboradores WHERE idColaborador = ?";
    $contrasenia = select($sentencia, [$idUsuario])[0]->password;
    $verifica = password_verify($password, $contrasenia);
    if($verifica) return true;
}


function cambiarPassword($idUsuario, $password){
    $nueva = password_hash($password, PASSWORD_DEFAULT);
    $sentencia = "UPDATE usuarios SET password = ? WHERE id = ?";
    return editar($sentencia, [$nueva, $idUsuario]);
}

function eliminarUsuario($id){
    $sentencia = "DELETE FROM usuarios WHERE id = ?";
    return eliminar($sentencia, $id);
}

function editarUsuario($usuario, $nombre, $telefono, $direccion, $id){
    $sentencia = "UPDATE usuarios SET usuario = ?, nombre = ?, telefono = ?, direccion = ? WHERE id = ?";
    $parametros = [$usuario, $nombre, $telefono, $direccion, $id];
    return editar($sentencia, $parametros);
}

function obtenerUsuarioPorId($id){
    $sentencia = "SELECT id, usuario, nombre, telefono, direccion FROM usuarios WHERE id = ?";
    return select($sentencia, [$id])[0];
}

function obtenerUsuarios(){
    $sentencia = "SELECT id, usuario, nombre, telefono, direccion FROM usuarios";
    return select($sentencia);
}

function registrarUsuario($usuario, $nombre, $telefono, $direccion, $contrasena){
    $password = password_hash(PASSWORD_PREDETERMINADA, PASSWORD_DEFAULT);
    $sentencia = "INSERT INTO usuarios (usuario, nombre, telefono, direccion, password) 
    VALUES (?,?,?,?,?)";
    $parametros = [$usuario, $nombre, $telefono, $direccion, $password];
    return insertar($sentencia, $parametros);
}





function eliminarCliente($idPersona){
    $sentencia = "DELETE FROM persona WHERE idPersona = ?";
    return eliminar($sentencia, $idPersona);
}

function eliminarEmpresa($id_Empresa){
    $sentencia = "DELETE FROM empresa WHERE id_Empresa = ?";
    return eliminar($sentencia, $id_Empresa);
}

function eliminarProveedor($id_Proveedor){
    $sentencia = "DELETE FROM proveedores WHERE id_Proveedor = ?";
    return eliminar($sentencia, $id_Proveedor);
}

function editarCliente($DNI_Persona, $Nombres, $PrimerApellido, $SegundoApellido,$Telefonocli, $direccioncli, $emailcli,$idPersona){
    $sentencia = "UPDATE persona SET DNI_Persona = ?, Nombres = ?, PrimerApellido = ?, SegundoApellido=?, Telefonocli=?,direccioncli=?,emailcli=? WHERE idPersona = ?";
    $parametros = [$DNI_Persona, $Nombres, $PrimerApellido, $SegundoApellido,$Telefonocli, $direccioncli, $emailcli,$idPersona];
    return editar($sentencia, $parametros);
}

function editarEmpresa($RUC, $NombreEmpresa, $TelefonoEmpresa, $DireccionEmpresa,$EmailEmpresa,$id_Empresa){
    $sentencia = "UPDATE empresa SET RUC = ?, NombreEmpresa = ?, TelefonoEmpresa = ?, DireccionEmpresa=?, EmailEmpresa=? WHERE id_Empresa = ?";
    $parametros = [$RUC, $NombreEmpresa, $TelefonoEmpresa, $DireccionEmpresa,$EmailEmpresa,$id_Empresa];
    return editar($sentencia, $parametros);
}

function editarProveedor($RUC_Prov, $NombreEmpresa,$Condicion,$Estado, $telefono_Proveedor, $Direccion_Proveedor,$EmailProv,$id_Proveedor){
    $sentencia = "UPDATE proveedores SET RUC_Prov = ?, NombreEmpresa = ?,Condicion =?, Estado=?, telefono_Proveedor = ?, Direccion_Proveedor=?, EmailProv=? WHERE id_Proveedor = ?";
    $parametros = [$RUC_Prov, $NombreEmpresa,$Condicion,$Estado, $telefono_Proveedor, $Direccion_Proveedor,$EmailProv,$id_Proveedor];
    return editar($sentencia, $parametros);
}

function obtenerClientePorId($idPersona){
    $sentencia = "SELECT * FROM persona WHERE idPersona = ?";
    $cliente = select($sentencia, [$idPersona]);
    if($cliente) return $cliente[0];
}

function obtenerEmpresaPorId($id_Empresa){
    $sentencia = "SELECT * FROM empresa WHERE id_Empresa = ?";
    $cliente = select($sentencia, [$id_Empresa]);
    if($cliente) return $cliente[0];
}

function obtenerProveedorPorId($id_Proveedor){
    $sentencia = "SELECT * FROM proveedores WHERE id_Proveedor = ?";
    $cliente = select($sentencia, [$id_Proveedor]);
    if($cliente) return $cliente[0];
}

function obtenerClientes(){
    $sentencia = "SELECT * FROM persona";
    return select($sentencia);
}

function obtenerProveedores(){
    $sentencia = "SELECT * FROM proveedores";
    return select($sentencia);
}

function obtenerEmpresas(){
    $sentencia = "SELECT * FROM empresa";
    return select($sentencia);
}

function registrarCliente($dni, $nombre, $apellidopat, $apellidomat, $telefono, $direccion, $email){
    $sentencia = "INSERT INTO persona (DNI_Persona, Nombres, PrimerApellido, SegundoApellido,Telefonocli, direccioncli, emailcli) VALUES (?,?,?,?,?,?,?)";
    $parametros = [$dni, $nombre, $apellidopat, $apellidomat, $telefono, $direccion, $email];
    return insertar($sentencia, $parametros);
}

function registrarEmpresa($ruc, $nombre, $telefono, $direccion, $email){
    $sentencia = "INSERT INTO empresa (RUC, NombreEmpresa, TelefonoEmpresa, DireccionEmpresa, EmailEmpresa) VALUES (?,?,?,?,?)";
    $parametros = [$ruc, $nombre, $telefono, $direccion, $email];
    return insertar($sentencia, $parametros);
}

function registrarProveedor($ruc, $nombre,$condicion,$estado, $telefono, $direccion, $email){
    $sentencia = "INSERT INTO proveedores (RUC_Prov, NombreEmpresa,Condicion,Estado, telefono_Proveedor, Direccion_Proveedor, EmailProv) VALUES (?,?,?,?,?,?,?)";
    $parametros = [$ruc, $nombre,$condicion,$estado, $telefono, $direccion, $email];
    return insertar($sentencia, $parametros);
}

function obtenerNumeroVentas(){
    $sentencia = "SELECT IFNULL(COUNT(*),0) AS total FROM ventas";
    return select($sentencia)[0]->total;
}

function obtenerNumeroUsuarios(){
    $sentencia = "SELECT IFNULL(COUNT(*),0) AS total FROM usuarios";
    return select($sentencia)[0]->total;
}

function obtenerNumeroClientes(){
    $sentencia = "SELECT IFNULL(COUNT(*),0) AS total FROM clientes";
    return select($sentencia)[0]->total;
}


function obtenerVentasPorUsuario(){
    $sentencia = "SELECT SUM(ventas.total) AS total, usuarios.usuario, COUNT(*) AS numeroVentas 
    FROM ventas
    INNER JOIN usuarios ON usuarios.id = ventas.idUsuario
    GROUP BY ventas.idUsuario
    ORDER BY total DESC";
    return select($sentencia);
}

function obtenerVentasPorCliente(){
    $sentencia = "SELECT SUM(ventas.total) AS total, IFNULL(clientes.nombre, 'MOSTRADOR') AS cliente,
    COUNT(*) AS numeroCompras
    FROM ventas
    LEFT JOIN clientes ON clientes.id = ventas.idCliente
    GROUP BY ventas.idCliente
    ORDER BY total DESC";
    return select($sentencia);
}

function obtenerProductosMasVendidos(){
    $sentencia = "SELECT SUM(productos_ventas.cantidad * productos_ventas.precio) AS total, SUM(productos_ventas.cantidad) AS unidades,
    productos.nombre FROM productos_ventas INNER JOIN productos ON productos.id = productos_ventas.idProducto
    GROUP BY productos_ventas.idProducto
    ORDER BY total DESC
    LIMIT 10";
    return select($sentencia);
}

function obtenerTotalVentas($idUsuario = null){
    $parametros = [];
    $sentencia = "SELECT IFNULL(SUM(total),0) AS total FROM ventas";
    if(isset($idUsuario)){
        $sentencia .= " WHERE idUsuario = ?";
        array_push($parametros, $idUsuario);
    }
    $fila = select($sentencia, $parametros);
    if($fila) return $fila[0]->total;
}

function obtenerTotalVentasHoy($idUsuario = null){
    $parametros = [];
    $sentencia = "SELECT IFNULL(SUM(total),0) AS total FROM ventas WHERE DATE(fecha) = CURDATE() ";
    if(isset($idUsuario)){
        $sentencia .= " AND idUsuario = ?";
        array_push($parametros, $idUsuario);
    }
    $fila = select($sentencia, $parametros);
    if($fila) return $fila[0]->total;
}

function obtenerTotalVentasSemana($idUsuario = null){
    $parametros = [];
    $sentencia = "SELECT IFNULL(SUM(total),0) AS total FROM ventas  WHERE WEEK(fecha) = WEEK(NOW())";
    if(isset($idUsuario)){
        $sentencia .= " AND  idUsuario = ?";
        array_push($parametros, $idUsuario);
    }
    $fila = select($sentencia, $parametros);
    if($fila) return $fila[0]->total;
}

function obtenerTotalVentasMes($idUsuario = null){
    $parametros = [];
    $sentencia = "SELECT IFNULL(SUM(total),0) AS total FROM ventas  WHERE MONTH(fecha) = MONTH(CURRENT_DATE()) AND YEAR(fecha) = YEAR(CURRENT_DATE())";
    if(isset($idUsuario)){
        $sentencia .= " AND  idUsuario = ?";
        array_push($parametros, $idUsuario);
    }
    $fila = select($sentencia, $parametros);
    if($fila) return $fila[0]->total;
}

function calcularTotalVentas($ventas){
    $total = 0;
    foreach ($ventas as $venta) {
        $total += $venta->total;
    }
    return $total;
}

function calcularProductosVendidos($ventas){
    $total = 0;
    foreach ($ventas as $venta) {
        foreach ($venta->productos as $producto) {
            $total += $producto->cantidad;
        }
    }
    return $total;
}

function obtenerGananciaVentas($ventas){
    $total = 0;
    foreach ($ventas as $venta) {
        foreach ($venta->productos as $producto) {
            $total += $producto->cantidad * ($producto->precio - $producto->compra);
        }
    }
    return $total;
}

function obtenerVentas($fechaInicio, $fechaFin, $cliente, $usuario){
    $parametros = [];
    $sentencia  = "SELECT ventas.*, usuarios.usuario, IFNULL(clientes.nombre, 'MOSTRADOR') AS cliente
    FROM ventas 
    INNER JOIN usuarios ON usuarios.id = ventas.idUsuario
    LEFT JOIN clientes ON clientes.id = ventas.idCliente";

    if(isset($usuario)){
        $sentencia .= " WHERE ventas.idUsuario = ?";
        array_push($parametros, $usuario);
        $ventas = select($sentencia, $parametros);
        return agregarProductosVendidos($ventas);
    }

    if(isset($cliente)){
        $sentencia .= " WHERE ventas.idCliente = ?";
        array_push($parametros, $cliente);
        $ventas = select($sentencia, $parametros);
        return agregarProductosVendidos($ventas);
    }

    if(empty($fechaInicio) && empty($fechaFin)){
        $sentencia .= " WHERE DATE(ventas.fecha) = ? ";
        array_push($parametros, HOY);
        $ventas = select($sentencia, $parametros);
        return agregarProductosVendidos($ventas);
    }

    if(isset($fechaInicio) && isset($fechaFin)){
        $sentencia .= " WHERE DATE(ventas.fecha) >= ? AND DATE(ventas.fecha) <= ?";
        array_push($parametros, $fechaInicio, $fechaFin);
    }

    $ventas = select($sentencia, $parametros);
   
    return agregarProductosVendidos($ventas);
}

function agregarProductosVendidos($ventas){
    foreach($ventas as $venta){
        $venta->productos = obtenerProductosVendidos($venta->id);
    }
    return $ventas;
}

function obtenerProductosVendidos($idVenta){
    $sentencia = "SELECT productos_ventas.cantidad, productos_ventas.precio, productos.nombre,
    productos.compra
    FROM productos_ventas
    INNER JOIN productos ON productos.id = productos_ventas.idProducto
    WHERE idVenta  = ? ";
    return select($sentencia, [$idVenta]);
}

function registrarVenta($productos, $idUsuario, $idCliente, $total){
    $sentencia =  "INSERT INTO venta (fechaVenta, totalVenta, idUsuario, idCliente) VALUES (?,?,?,?)";
    $parametros = [date("Y-m-d H:i:s"), $total, $idUsuario, $idCliente];

    $resultadoVenta = insertar($sentencia, $parametros);
    if($resultadoVenta){
        $idVenta = obtenerUltimoIdVenta();
        $productosRegistrados = registrarProductosVenta($productos, $idVenta);
        return $resultadoVenta && $productosRegistrados;
    }
}

function registrarProductosVenta($productos, $idVenta){
    $sentencia = "INSERT INTO productoventas (cantidad, preciototal, fk_idproducto, fk_idventa) VALUES (?,?,?,?)";
    foreach ($productos as $producto ) {
        $parametros = [$producto->cantidad, $producto->venta, $producto->id, $idVenta];
        insertar($sentencia, $parametros);
        descontarProductos($producto->id, $producto->cantidad);
    }
    return true;
}

function descontarProductos($idProducto, $cantidad){
    $sentencia =  "UPDATE productos SET existencia  = existencia - ? WHERE id = ?";
    $parametros = [$cantidad, $idProducto];
    return editar($sentencia, $parametros);
}

function obtenerUltimoIdVenta(){
    $sentencia  = "SELECT id FROM ventas ORDER BY id DESC LIMIT 1";
    return select($sentencia)[0]->id;
}

function calcularTotalLista($lista){
    $total = 0;
    foreach($lista as $producto){
        $total += floatval($producto->precioVenta * $producto->cantidad);
    }
    return $total;
}

function agregarProductoALista($producto, $listaProductos){
    if($producto->existencia < 1) return $listaProductos;
    $producto->cantidad = 1;
    
    $existe = verificarSiEstaEnLista($producto->id, $listaProductos);

    if(!$existe){
        array_push($listaProductos, $producto);
    } else{
        $existenciaAlcanzada = verificarExistencia($producto->id, $listaProductos, $producto->existencia);
        
        if($existenciaAlcanzada)return $listaProductos;

        $listaProductos = agregarCantidad($producto->id, $listaProductos);
        }
        
    return $listaProductos;
    
}

function verificarExistencia($idProducto, $listaProductos, $existencia){
    foreach($listaProductos as $producto){
        if($producto->id == $idProducto){
           if($existencia <= $producto->cantidad) return true; 
        }
    }
    return false;
}

function verificarSiEstaEnLista($idProducto, $listaProductos){
    foreach($listaProductos as $producto){
        if($producto->id == $idProducto){
            return true;
        }
    }
    return false;
}

function agregarCantidad($idProducto, $listaProductos){
    foreach($listaProductos as $producto){
        if($producto->id == $idProducto){
            $producto->cantidad++;
        }
    }
    return $listaProductos;
}

function obtenerProductoPorCodigo($codigo){
    $sentencia = "SELECT * FROM producto WHERE codigo = ?";
    $producto = select($sentencia, [$codigo]);
    if($producto) return $producto[0];
    return [];
}

function obtenerNumeroProductos(){
    $sentencia = "SELECT IFNULL(SUM(existencia),0) AS total FROM productos";
    $fila = select($sentencia);
    if($fila) return $fila[0]->total;
}

function obtenerTotalInventario(){
    $sentencia = "SELECT IFNULL(SUM(existencia * venta),0) AS total FROM productos";
    $fila = select($sentencia);
    if($fila) return $fila[0]->total;
}

function calcularGananciaProductos(){
    $sentencia = "SELECT IFNULL(SUM(existencia*venta) - SUM(existencia*compra),0) AS total FROM productos";
    $fila = select($sentencia);
    if($fila) return $fila[0]->total;
}

function eliminarProducto($id){
    $sentencia = "DELETE FROM producto WHERE idProducto = ?";
    return eliminar($sentencia, $id);
}

function eliminarCategoria($idCategoria){
    $sentencia = "DELETE FROM categorias WHERE idCategoria = ?";
    return eliminar($sentencia, $idCategoria);
}

function editarProducto($codigo, $nombre, $compra, $venta, $existencia, $descripcion, $fecha_vencimiento, $categoria, $proveedor, $id){
    $sentencia = "UPDATE producto SET codigo = ?, nombreProd = ?, precioCompra = ?, precioVenta = ?, existencia = ?,descricpionProd = ?,fechavencimiento = ?,fk_idcategoria=?, fk_idproveedor=? WHERE idProducto = ?";
    $parametros = [$codigo, $nombre, $compra, $venta, $existencia, $descripcion, $fecha_vencimiento, $categoria, $proveedor, $id];
    return editar($sentencia, $parametros);
}

function editarCategoria( $idCategoria, $categoria){
    $sentencia = "UPDATE categorias SET  categoria = ? WHERE idCategoria = ?";
    $parametros = [ $categoria,$idCategoria];
    return editar($sentencia, $parametros);
}

function obtenerProductoPorId($id){
    $sentencia = "SELECT * FROM producto WHERE idProducto = ?";
    return select($sentencia, [$id])[0];
}

function obtenerCategoriaPorId($idCategoria){
    $sentencia = "SELECT * FROM categorias WHERE idCategoria = ?";
    return select($sentencia, [$idCategoria])[0];
}

function obtenerProductos($busqueda = null){
    $parametros = [];
    $sentencia = "SELECT * FROM producto ";
    if(isset($busqueda)){
        $sentencia .= " WHERE nombre LIKE ? OR codigo LIKE ?";
        array_push($parametros, "%".$busqueda."%", "%".$busqueda."%"); 
    } 
    return select($sentencia, $parametros);
}

function obtenerCategorias($busqueda = null){
    $parametros = [];
    $sentencia = "SELECT * FROM categorias ";
    if(isset($busqueda)){
        $sentencia .= " WHERE nombre LIKE ? OR codigo LIKE ?";
        array_push($parametros, "%".$busqueda."%", "%".$busqueda."%"); 
    } 
    return select($sentencia, $parametros);
}

function registrarProducto($codigo, $nombre, $compra, $venta, $existencia, $descripcion, $fecha_vencimiento, $categoria, $proveedor) {
    $pdo = conectarBaseDatos();
    $sentencia = "INSERT INTO producto (codigo, nombreProd, precioCompra, precioVenta, existencia, descricpionProd, fechavencimiento, fk_idcategoria, fk_idproveedor) VALUES (?,?,?,?,?,?,?,?,?)";
    $parametros = [$codigo, $nombre, $compra, $venta, $existencia, $descripcion, $fecha_vencimiento, $categoria, $proveedor];
    $stmt = $pdo->prepare($sentencia);
    return $stmt->execute($parametros);
}


function registrarCategoria($categoria){
    $sentencia = "INSERT INTO categorias(categoria) VALUES (?)";
    $parametros = [$categoria];
    return insertar($sentencia, $parametros);
}

function select($sentencia, $parametros = []){
    $bd = conectarBaseDatos();
    $respuesta = $bd->prepare($sentencia);
    $respuesta->execute($parametros);
    return $respuesta->fetchAll();
}

function insertar($sentencia, $parametros ){
    $bd = conectarBaseDatos();
    $respuesta = $bd->prepare($sentencia);
    return $respuesta->execute($parametros);
}

function eliminar($sentencia, $id ){
    $bd = conectarBaseDatos();
    $respuesta = $bd->prepare($sentencia);
    return $respuesta->execute([$id]);
}

function editar($sentencia, $parametros ){
    $bd = conectarBaseDatos();
    $respuesta = $bd->prepare($sentencia);
    return $respuesta->execute($parametros);
}

function conectarBaseDatos() {
    $host = "localhost";
    $port = "3307"; // Cambiado a 3307
    $db   = "ventas_php";
    $user = "root";
    $pass = "";
    $charset = 'utf8mb4';

    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset"; // Añadido port
    try {
         $pdo = new \PDO($dsn, $user, $pass, $options);
         return $pdo;
    } catch (\PDOException $e) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}


function obtenerCategorias2() {
    $pdo = conectarBaseDatos();
    $stmt = $pdo->query("SELECT idCategoria, categoria FROM categorias");
    return $stmt->fetchAll();
}

function obtenerProveedores2() {
    $pdo = conectarBaseDatos();
    $stmt = $pdo->query("SELECT id_Proveedor, NombreEmpresa FROM proveedores");
    return $stmt->fetchAll();
}

function obtenerPersonaPorDNI2($dni) {
    $pdo = conectarBaseDatos();
    $sentencia = $pdo->prepare("SELECT * FROM persona WHERE DNI_Persona = ?");
    $sentencia->execute([$dni]);
    return $sentencia->fetch(PDO::FETCH_OBJ);
}

function obtenerRoles2() {
    $pdo = conectarBaseDatos();
    $sentencia = $pdo->query("SELECT * FROM roles");
    return $sentencia->fetchAll(PDO::FETCH_OBJ);
}

function registrarColaborador($usuario, $contrasena, $fk_idPersona, $fk_idRoles){
    $password = password_hash($contrasena, PASSWORD_DEFAULT);
    $sentencia = "INSERT INTO colaboradores (Usuario, password, fk_idPersona, fk_idRoles) VALUES (?,?,?,?)";
    $parametros = [$usuario, $password, $fk_idPersona, $fk_idRoles];
    return insertar($sentencia, $parametros);
}
