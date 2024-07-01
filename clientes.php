<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();

if(empty($_SESSION['usuario'])) header("location: login.php");

$clientes = obtenerClientes();
?>
<div class="container">
    <h1>
        <a class="btn btn-success btn-lg" href="agregar_cliente.php">
            <i class="fa fa-plus"></i>
            Agregar Persona
        </a>
      
    </h1>
    <table class="table">
        <thead>
            <tr>
            <th>ID</th>
                <th>DNI</th>
                <th>NOMBRE</th>
                <th>P.APELLIDO</th>
                <th>S.APELLIDO</th>
                <th>TELEFONO</th>
                <th>DIRECCION</th>
                <th>EMAIL</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($clientes as $cliente){
            ?>
                <tr>
                <td><?php echo $cliente->idPersona; ?></td>
                    <td><?php echo $cliente->DNI_Persona; ?></td>
                    <td><?php echo $cliente->Nombres; ?></td>
                    <td><?php echo $cliente->PrimerApellido; ?></td>
                    <td><?php echo $cliente->SegundoApellido; ?></td>
                    <td><?php echo $cliente->Telefonocli; ?></td>
                    <td><?php echo $cliente->direccioncli; ?></td>
                    <td><?php echo $cliente->emailcli; ?></td>
                    <td>
                        <a class="btn btn-info" href="editar_cliente.php?id=<?php echo $cliente->idPersona;?>">
                            <i class="fa fa-edit"></i>
                            Editar
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="eliminar_cliente.php?id=<?php echo $cliente->idPersona;?>">
                            <i class="fa fa-trash"></i>
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>