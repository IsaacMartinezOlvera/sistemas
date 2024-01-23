<?php
session_start();

if (!isset($_SESSION['tipo_usuario']) || !isset($_SESSION['categoria_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
$categoria_usuario = $_SESSION['categoria_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIF | Inicio</title>
    <link rel="stylesheet" type="text/css" href="assets/css/tarjeta.css">

    <?php include('includes/header.php'); ?>
</head>
<body>

    <?php if ($tipo_usuario == 1) { ?>
        <?php include('cards.php'); ?>
    <?php } elseif ($tipo_usuario == 2) { ?>
        <p>Bienvenido, usuario.</p>
        <?php include('card.php'); ?>
    <?php } ?>

    <a href="logout.php">Cerrar sesión</a>
</body>
</html>

