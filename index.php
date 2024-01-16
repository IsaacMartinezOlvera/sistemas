<?php
session_start();
include ('includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para obtener la información del usuario
    $consulta = "SELECT * FROM usuarios WHERE FullName = ? AND Passwo = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        $_SESSION['tipo_usuario'] = $fila['Puesto'];
        header('Location: dashboard.php');
        exit();
    } else {
        $mensaje_error = 'Credenciales incorrectas';
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
    <title>DIF | Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/tarjeta.css">
</head>
<body>
<<<<<<< HEAD
    <h2>Login para iniciar sesión</h2>
=======
    <h1>Inicia seccion</h1>
    <h2>Login</h2>
>>>>>>> dcad0d64c009c785754fc3b1b4eb642ff139e104
    <?php if (isset($mensaje_error)) { ?>
        <p style="color: red;"><?php echo $mensaje_error; ?></p>
    <?php } ?>

    <div class="contenedor">
        <div class="tarjeta">
            <div class="contenido">
                <img src="assets/img/DIF2.png" alt="dif">
                <form method="post" action="">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" required>
                    <br>
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" required>
                    <br>
                    <button type="submit">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>