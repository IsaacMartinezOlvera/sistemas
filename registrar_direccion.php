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
    <form method="post" action="config/guardar_direccion.php" class="tarjeta contenido" onsubmit="return validarFormulario()">
        <label for="nombre">Nombre:</label>
        <select name="nombre" class="form-control" onchange="getSubcategorias(this.value)">
                <option value="" disabled selected>Selecciona un usuario</option>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sistemas";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }

                $query_direccion = "SELECT DISTINCT FullName FROM usuarios";
                $result_direccion = mysqli_query($conn, $query_direccion);

                while ($row_direccion = mysqli_fetch_assoc($result_direccion)) {
                    echo "<option value='" . "'>" . $row_direccion['FullName'] . "</option>";
                }

                mysqli_close($conn);
                ?>
            </select>

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
            <button type="submit">Registrar Usuario</button>

    <br>
    <a href="dashboard.php">Volver al Dashboard</a>
    <script>
        function actualizarSubcategorias(selectElement) {
            var identificadorCategoria = selectElement.options[selectElement.selectedIndex].getAttribute('data-identificador');
            var subcategoriaSelect = document.getElementById('subcategoriaSelect');
            subcategoriaSelect.innerHTML = ''; // Limpiar las opciones existentes

            // Obtener las subcategorías asociadas al identificador de la categoría seleccionada
            fetch('get_subcategorias.php?identificador_categoria=' + identificadorCategoria)
                .then(response => response.json())
                .then(subcategorias => {
                    subcategorias.forEach(subcategoria => {
                        var option = document.createElement('option');
                        option.value = subcategoria;
                        option.text = subcategoria;
                        subcategoriaSelect.add(option);
                    });
                });

            // Actualizar el campo oculto con el identificador de la categoría
            document.getElementById('identificador_categoria').value = identificadorCategoria;
        }
    </script>
    <script src="assets/js/validacion.js"></script>

</body>

</html>