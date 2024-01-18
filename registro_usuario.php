<?php
//!iniciar la seccion
session_start();






//!para dectectar el tipo de usuario

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
    <link rel="stylesheet" href="assets/css/style.css">
    <title>DIF | Registro de Usuario</title>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <h2>Registrar Nuevo Usuario</h2>

    <?php
    // Verifica si existe la variable de sesión y si es true
    if (isset($_SESSION['registro_exitoso']) && $_SESSION['registro_exitoso']) {
    echo '<p class="mensaje_exitoso">¡Registro exitoso! Se ha registrado correctamente.</p>';
    // Limpia la variable de sesión para evitar mostrar el mensaje nuevamente en futuras visitas
    unset($_SESSION['registro_exitoso']);
    }
    ?>

    <!-- Formulario para registrar un nuevo usuario -->
    <form method="post" action="config/guardar_usuario.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" >

        <label for="nombre">Correo electronico:</label>
        <input type="text" name="email" >


        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" >
        <br>
        <label for="tipo_usuario">Tipo de Usuario:</label>
        <select name="tipo_usuario" >
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
        </select>
        <br>
        <button type="submit">Registrar Usuario</button>
    </form>

    <br>
    <a href="dashboard.php">Volver al Dashboard</a>
</body>

</html>