<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
include('includes/conexion.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>DIF | Usuarios registrados</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>

    <?php include('includes/header.php'); ?>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Usuarios registrados</h1>



        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM usuarios";
                    $resultado = mysqli_query($conexion, $query);
                    while ($row = mysqli_fetch_array($resultado)) {
                    ?>
                        <tr>
                            <td data-label="Nombre"><?php echo $row['FullName'] ?> </td>
                            <td data-label="Correo"><?php echo $row['EmailId'] ?></td>
                            <td data-label="Cargo">
                                <?php
                                $cargo = ($row['Puesto'] == 1) ? 'Admin' : 'Usuario';
                                echo $cargo;
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>