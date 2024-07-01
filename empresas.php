<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$clientes = obtenerEmpresas();
?>
<div class="container">
    <h1>
        <a class="btn btn-success btn-lg" href="agregar_empresa.php">
            <i class="fa fa-plus"></i>
            Agregar
        </a>
        Empresas
    </h1>
    <table class="table">
        <thead>
            <tr>
                <th>RUC</th>
                <th>Nombre de la Empresa</th>
                <th>Telefono de la Empresa</th>
                <th>Direccion de la Empresa</th>
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
                    <td><?php echo $cliente->RUC; ?></td>
                    <td><?php echo $cliente->NombreEmpresa; ?></td>
                    <td><?php echo $cliente->TelefonoEmpresa; ?></td>
                    <td><?php echo $cliente->DireccionEmpresa; ?></td>
                    <td><?php echo $cliente->EmailEmpresa; ?></td>
                    <td>
                        <a class="btn btn-info" href="editar_empresa.php?id=<?php echo $cliente->id_Empresa;?>">
                            <i class="fa fa-edit"></i>
                            Editar
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="eliminar_empresa.php?id=<?php echo $cliente->id_Empresa;?>">
                            <i class="fa fa-trash"></i>
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>