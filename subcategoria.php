<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
include('includes/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIF | Añadir Coordinación </title>
    <link rel="stylesheet" href="assets/css/tarjeta-dist.css">
</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="contenedor">


    <form action="add_subcategory.php" method="POST"class="tarjeta contenido">
    <label>Dirección<span style="color:red;">*</span></label>
        <input type="text" name="nombre_subcategoria" placeholder="Añade el nombre de la subcategoría (dirección)">
        <div class="form-group">
        <label>Coordinación<span style="color:red;">*</span></label>
            <select name="categoria" class="form-control">
                <?php
                // Conectar a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sistemas";

                $conn = mysqli_connect($servername, $username, $password, $dbname);

                if (!$conn) {
                    die("Conexión fallida: " . mysqli_connect_error());
                }

                // Obtener todas las categorías de la tabla categorias
                $query = "SELECT DISTINCT Fullname, identificador FROM categorias";
                $result = mysqli_query($conn, $query);

                // Mostrar las categorías en el menú desplegable
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['Fullname'] . "' data-identificador='" . $row['identificador'] . "'>" . $row['Fullname'] . "</option>";
                }

                // Cerrar la conexión
                mysqli_close($conn);
                ?>
            </select>
        </div>
        <input type="submit" value="Añadir">
    </form>
</body>

</html>
