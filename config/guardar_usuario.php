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

    // Obtener el valor del tipo de registro (dirección, coordinación o servicio)
    $tipo_registro = $_POST['tipo_registro'];

    // Inicializar variables para almacenar el identificador y nombre
    $identificador = null;
    $nombre_subsub = null;

    // Obtener el identificador y nombre según el tipo de registro
    if ($tipo_registro == 'direccion') {
        $identificador = $_POST['subcategoria'];
        $consulta_nombre = "SELECT nombre_categoria FROM subcategoria WHERE identificador_categoria = ?";
    } elseif ($tipo_registro == 'coordinacion') {
        $identificador = $_POST['subcategoria'];
        $consulta_nombre = "SELECT nombre_subcategoria FROM subcategoria WHERE identificador = ?";
    } elseif ($tipo_registro == 'servicio') {
        $identificador = $_POST['subcategoria'];
        $consulta_nombre = "SELECT nombre_subsub FROM subsub WHERE identificador = ?";
    }

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
    $consulta = "INSERT INTO usuarios (FullName, Passwo, Puesto, EmailId, NombreCategoria) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($consulta);

    // Manejo de errores para la preparación de la consulta
    if (!$stmt) {
        die('Error en la preparación de la consulta: ' . $conexion->error);
    }
        $stmt->bind_param("ssiss", $nombre, $hashed_password, $tipo_usuario, $email, $nombre_subsub);

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
