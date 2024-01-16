<?php
session_start();

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: index.php');
    exit();
}

include('includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Hash de la contraseña (puedes utilizar algoritmos más seguros)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Consulta SQL para insertar un nuevo usuario
    $consulta = "INSERT INTO usuarios (FullName, Passwo, Puesto) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("ssi", $nombre, $hashed_password, $tipo_usuario);

    if ($stmt->execute()) {
        echo "Usuario registrado correctamente.";
        // Puedes redirigir a otra página si lo deseas
        // header('Location: otra_pagina.php');
        // exit();
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registrar Nuevo Usuario</h2>

    <!-- Formulario para registrar un nuevo usuario -->
    <form method="post" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <label for="tipo_usuario">Tipo de Usuario:</label>
        <select name="tipo_usuario" required>
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
