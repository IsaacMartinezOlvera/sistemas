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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIF | Añadir Dirección</title>
    <link rel="stylesheet" href="assets/css/tarjeta.css">
</head>
<body>
<?php include('includes/header.php'); ?>
<div class="contenedor">

<form action="add_category.php" method="POST" class="tarjeta contenido">
<label>Dirección<span style="color:red;">*</span></label>

    <input type="text" name="category_name" placeholder="Añade el nombre de la categoria (dirección)">
    <input type="submit" value="Añadir">
</form>
</div>

    
</body>
</html>