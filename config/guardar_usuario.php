<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}


include('../includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar campos vacíos
    if (empty($_POST['nombre']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['tipo_usuario'])) {
        $_SESSION['mensaje_error'] = "Por favor, completa todos los campos.";
        header('Location: ../registro_direccion.php');
        exit();
    }

    // Asignar valores a variables
    $nombre = $_POST['nombre'];
    $puesto = $_POST['puesto'];

    // Validación adicional si es necesario
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensaje_error'] = "Por favor, ingresa un correo electrónico válido.";
        header('Location: ../registro_usuario.php');
        exit();
    }

    // Obtener el valor del tipo de registro (dirección, coordinación o servicio)
    $tipo_registro = $_POST['tipo_registro'];

    // Inicializar variables para almacenar el identificador y nombre
    $identificador = null;
    $nombre_subsub = null;


    // Consultar el nombre correspondiente al identificador
    $stmt_nombre = $conexion->prepare($consulta_nombre);
    $stmt_nombre->bind_param("i", $identificador);
    $stmt_nombre->execute();
    $stmt_nombre->bind_result($nombre_subsub);
    $stmt_nombre->fetch();
    $stmt_nombre->close();

    // Verificar si el correo electrónico ya está registrado
    $consulta_email_existente = "SELECT * FROM usuarios WHERE EmailId = ?";
    $stmt_email_existente = $conexion->prepare($consulta_email_existente);
    $stmt_email_existente->bind_param("s", $email);
    $stmt_email_existente->execute();
    $result_email_existente = $stmt_email_existente->get_result();

    if ($result_email_existente->num_rows > 0) {
        $_SESSION['mensaje_error'] = "El correo electrónico ya está registrado. Por favor, utiliza otro.";
        header('Location: ../registro_usuario.php');
        exit();
    }

    $stmt_email_existente->close();

    // Hash de la contraseña (puedes utilizar algoritmos más seguros)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Consulta SQL parametrizada para prevenir inyecciones SQL
    $consulta = "INSERT INTO usuarios_direccion (FullName, Puesto) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($consulta);

    // Manejo de errores para la preparación de la consulta
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $conexion->error);
    }

    // Asignar parámetros y ejecutar la consulta
    $stmt->bind_param("ssisss", $nombre, $hashed_password, $puesto);

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
