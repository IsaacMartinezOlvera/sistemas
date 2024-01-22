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
    <link rel="stylesheet" type="text/css" href="assets/css/tarjeta.css"> <!-- Agrega esta línea para incluir el CSS -->
    <title>DIF | Registro de Usuario</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
    }

    .tarjeta.contenido {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .tarjeta.contenido label {
        display: block;
        margin-bottom: 5px;
    }

    .tarjeta.contenido input,
    .tarjeta.contenido select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    .tarjeta.contenido .btn-regresar {
        margin-top: 20px;
    }

    /* Estilos adicionales para mejorar la apariencia del formulario */
    .tarjeta.contenido select {
        cursor: pointer;
    }

    .tarjeta.contenido input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .tarjeta.contenido input[type="submit"]:hover {
        background-color: #45a049;
    }

    /* Añadir estilos para el encabezado si es necesario */
    /* .header {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
} */
</style>


<body>
    <?php include('includes/header.php'); ?>
    <div class="container">

    <h2>Registrar Nuevo Usuario</h2>

    <?php
    //!los campos deben llenarse
    if (isset($_SESSION['mensaje_error'])) {
        echo '<p class="mensaje_llenar">' . $_SESSION['mensaje_error'] . '</p>';
        // Limpia el mensaje de error para que no se muestre en futuras visitas
        unset($_SESSION['mensaje_error']);
    }
    // Verifica si existe la variable de sesión y si es true
    if (isset($_SESSION['registro_exitoso']) && $_SESSION['registro_exitoso']) {
        echo '<p class="mensaje_exitoso">¡Registro exitoso! Se ha registrado correctamente.</p>';
        // Limpia la variable de sesión para evitar mostrar el mensaje nuevamente en futuras visitas
        unset($_SESSION['registro_exitoso']);
    }
    ?>

    <!-- Formulario para registrar un nuevo usuario -->
    <form method="post" action="config/guardar_usuario.php" class="tarjeta contenido" onsubmit="return validarFormulario()">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="nombre">Correo electronico:</label>
        <input type="text" name="email" id="email" require>


        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" require>
        <br>
        <label for="tipo_registro">Selecciona:</label>
        <select name="tipo_registro" id="tipo_registro" class="form-control" onchange="mostrarCampo()" required>
            <option value="" disabled selected>Selecciona una opción</option>
            <option value="direccion">Dirección</option>
            <option value="coordinacion">Coordinación</option>
            <option value="servicio">Servicio</option>
        </select>

        <div id="campo_direccion" style="display: none;">
            <!-- Contenido del campo de dirección -->
            <label>Escoge la dirección<span style="color:red;">*</span></label>
            <select name="subcategoria" class="form-control" onchange="getSubcategorias(this.value)">
                <option value="" disabled selected>Selecciona una Dirección</option>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sistemas";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }

                $query_direccion = "SELECT DISTINCT nombre_categoria, identificador_categoria FROM subcategoria";
                $result_direccion = mysqli_query($conn, $query_direccion);

                while ($row_direccion = mysqli_fetch_assoc($result_direccion)) {
                    echo "<option value='" . $row_direccion['identificador_categoria'] . "'>" . $row_direccion['nombre_categoria'] . "</option>";
                }

                mysqli_close($conn);
                ?>
            </select>
        </div>

        <div id="campo_coordinacion" style="display: none;">
            <!-- Contenido del campo de coordinación -->
            <label>Escoge la coordinación<span style="color:red;">*</span></label>
            <select name="subcategoria" class="form-control" onchange="getSubcategorias(this.value)">
                <option value="" disabled selected>Selecciona una coordinación</option>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sistemas";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }

                $query_direccion = "SELECT DISTINCT nombre_subcategoria, identificador FROM subcategoria";
                $result_direccion = mysqli_query($conn, $query_direccion);

                while ($row_direccion = mysqli_fetch_assoc($result_direccion)) {
                    echo "<option value='" . $row_direccion['identificador'] . "'>" . $row_direccion['nombre_subcategoria'] . "</option>";
                }

                mysqli_close($conn);
                ?>
            </select>
        </div>

        <div id="campo_servicio" style="display: none;">
            <!-- Contenido del campo de servicio -->

            <label>Escoge el servicio<span style="color:red;">*</span></label>
            <select name="subcategoria" class="form-control" onchange="getSubcategorias(this.value)">
                <option value="" disabled selected>Selecciona el servicio</option>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sistemas";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }

                $query_direccion = "SELECT DISTINCT nombre_subsub, identificador FROM subsub";
                $result_direccion = mysqli_query($conn, $query_direccion);

                while ($row_direccion = mysqli_fetch_assoc($result_direccion)) {
                    echo "<option value='" . $row_direccion['identificador'] . "'>" . $row_direccion['nombre_subsub'] . "</option>";
                }

                mysqli_close($conn);
                ?>
            </select>
        </div>



        <label for="tipo_usuario">Tipo de Usuario:</label>

        <select name="tipo_usuario" id="tipo_usuario" required>
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
        </select>
        <br>
        <button type="submit">Registrar Usuario</button>
    </form>

    <br>
    <a href="dashboard.php">Volver al Dashboard</a>

    <script src="assets/js/validacion.js"></script>
    <script>
        function mostrarCampo() {
            var seleccionado = document.getElementById("tipo_registro").value;

            // Oculta todos los campos
            document.getElementById("campo_direccion").style.display = "none";
            document.getElementById("campo_coordinacion").style.display = "none";
            document.getElementById("campo_servicio").style.display = "none";

            // Muestra el campo correspondiente al tipo seleccionado
            if (seleccionado === "direccion") {
                document.getElementById("campo_direccion").style.display = "block";
            } else if (seleccionado === "coordinacion") {
                document.getElementById("campo_coordinacion").style.display = "block";
            } else if (seleccionado === "servicio") {
                document.getElementById("campo_servicio").style.display = "block";
            }
        }
    </script>

</body>

</html>