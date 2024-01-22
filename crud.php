<!-- El inicio de seccion del usuario (admin o usuario) -->
<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
?>






<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/tarjeta.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/formularios.css"> -->
    <title>Resguardos internos</title>
</head>

<body>
    <?php include('includes/header.php'); ?>
    <h1>RESGUARDO INTERNO</h1>

    <form action="guardar.php" method="post">
        <h2>Registro</h2>
        <div class="grupo">
            <label for="">Área Resguardante</label>
            <input type="text" name="" id="">

            <button name="submit">Registrar</button>
        </div>
    </form>

</body>

</html>