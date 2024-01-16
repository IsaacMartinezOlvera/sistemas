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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIF | </title>
</head>
<body>
<?php include('includes/header.php'); ?>
<form action="add_subcategory.php" method="POST">
    <input type="text" name="category_name" placeholder="Añade el nombre de la categoria (dirección)">
    <input type="submit" value="Añadir">
</form>

    
</body>
</html>