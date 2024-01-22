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

    <form action="guardar.php" method="post" enctype="multipart/form-data">
        <h2>Registro</h2>
        <div class="grupo">
            <label for="">Consecutivo No:</label>
            <input type="text" name="consecutivo" id="">


        </div>

        <div class="grupo">
            <label for="">Área Resguardante:</label>
            <input type="text" name="area" id="">


        </div>

        <div class="grupo">
            <label for="">Selecciona una imagen:</label>
            <input type="file" name="imagen" id="">
        </div>

        <div class="grupo">
            <label for="">Descripción:</label>
            <input type="text" name="descripcion" id="">
        </div>

        <div class="grupo">
            <label for="">Características Generales:</label>
            <input type="text" name="caracteristicas" id="">
        </div>

        <div class="grupo">
            <label for="">Marca:</label>
            <input type="text" name="marca" id="">
        </div>

        <div class="grupo">
            <label for="">Modelo:</label>
            <input type="text" name="modelo" id="">
        </div>

        <div class="grupo">
            <label for="">NO. De Serie:</label>
            <input type="text" name="serie" id="">
        </div>

        <div class="grupo">
            <label for="">Color:</label>
            <input type="text" name="color" id="">
        </div>

        <div class="grupo">
            <label for="">Usuario Responsable:</label>
            <input type="text" name="usuario" id="">
        </div>

        <!-- me quede aqui -->
        <div class="grupo">
            <label for="">Observaciones:</label>
            <input type="text" name="usuario" id="">
        </div>


        <div>
            <button name="submit">Registrar</button>
        </div>
    </form>

</body>

</html>