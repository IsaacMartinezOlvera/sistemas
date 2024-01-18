<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];

include('../includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar campos vacíos
    if (empty($_POST['nombre']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['tipo_usuario'])) {
        $_SESSION['mensaje_error'] = "Por favor, completa todos los campos.";
        header('Location: ../registro_usuario.php');
        exit();
    }

    // Asignar valores a variables
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Validación adicional si es necesario
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensaje_error'] = "Por favor, ingresa un correo electrónico válido.";
        header('Location: ../registro_usuario.php');
        exit();
    }

    // Hash de la contraseña (puedes utilizar algoritmos más seguros)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Consulta SQL parametrizada para prevenir inyecciones SQL
    $consulta = "INSERT INTO usuarios (FullName, Passwo, Puesto, EmailId) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("ssis", $nombre, $hashed_password, $tipo_usuario, $email);

    // Mostrar un mensaje si se registró correctamente
    if ($stmt->execute()) {
        $_SESSION['registro_exitoso'] = true;
        header('Location: ../registro_usuario.php');
        exit();
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
