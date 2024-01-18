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
    <title>DIF | Inicio</title>
    <?php include('includes/header.php'); ?>
</head>
<body>

    <?php if ($tipo_usuario == 1) { ?>
        <?php include('cards.php'); ?>
        <!-- <a href="registro_usuario.php">Registrar Usuario</a> -->
    <?php } elseif ($tipo_usuario == 2) { ?>
        <p>Bienvenido, usuario.</p>
        <!-- Contenido específico para usuarios -->
    <?php } ?>

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
