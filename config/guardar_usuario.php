<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];

include('../includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $tipo_usuario = $_POST['tipo_usuario'];

    if (empty($nombre) || empty($password) || empty($email) || empty($tipo_usuario)) {
        // !mostrando mensaje de que los campos deben estar llenos
        $_SESSION['mensaje_error'] = "Por favor, completa todos los campos.";
        header('Location: ../tu_formulario.php');
        exit();
    } else {
        // Hash de la contraseña (puedes utilizar algoritmos más seguros)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Consulta SQL para insertar un nuevo usuario
        $consulta = "INSERT INTO usuarios (FullName, Passwo, Puesto, EmailId) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($consulta);
        $stmt->bind_param("ssis", $nombre, $hashed_password, $tipo_usuario, $email);

        // Mostrar un mensaje si se registró correctamente
        if ($stmt->execute()) {
            $_SESSION['registro_exitoso'] = true;
            // Puedes redirigir a otra página si lo deseas
            header('Location: ../registro_usuario.php');
            exit();
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }

        $stmt->close();
        $conexion->close();
    }
}
