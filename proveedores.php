<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$clientes = obtenerProveedores();
?>
<div class="container">
    <h1>
        <a class="btn btn-success btn-lg" href="agregar_proveedor.php">
            <i class="fa fa-plus"></i>
            Agregar
        </a>
        Proveedor
    </h1>
    <table class="table">
        <thead>
            <tr>
                <th>idProv</th>
                <th>RUC</th>
                <th>Nombre de la empresa</th>
                <th>Condicion</th>
                <th>Estado</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Email</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($clientes as $cliente){
            ?>
                <tr>
                    <td><?php echo $cliente->id_Proveedor; ?></td>
                    <td><?php echo $cliente->RUC_Prov; ?></td>
                    <td><?php echo $cliente->NombreEmpresa; ?></td>
                    <td><?php echo $cliente->Condicion; ?></td>
                    <td><?php echo $cliente->Estado; ?></td>
                    <td><?php echo $cliente->telefono_Proveedor; ?></td>
                    <td><?php echo $cliente->Direccion_Proveedor; ?></td>
                    <td><?php echo $cliente->EmailProv; ?></td>
                    <td>
                        <a class="btn btn-info" href="editar_proveedor.php?id=<?php echo $cliente->id_Proveedor;?>">
                            <i class="fa fa-edit"></i>
                            Editar
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="eliminar_proveedor.php?id=<?php echo $cliente->id_Proveedor;?>">
                            <i class="fa fa-trash"></i>
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>