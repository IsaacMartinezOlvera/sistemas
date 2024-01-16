<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
include('includes/conexion.php');
?>



</html>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SIOB</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        .category-card {
            width: 300px;
            height: 400px;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            float: left;
            text-align: center;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            border-radius: 5px;
        }

        .category-card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .category-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .category-card p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .category-card .btn {
            display: inline-block;
            margin-top: 10px;
            margin-right: 5px;
        }

        .category-card img {
            display: none;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-bottom: 100px;
            /* Ajusta el margen inferior para el footer */
        }

        .content-wrapper {
            flex: 1;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f8f9fa;
            /* Ajusta el color de fondo según tus preferencias */
        }
    </style>
</head>

<body>

    <?php include('includes/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Categorías</h2>
                <div class="category-container">
                    <?php
                    // Conectarse a la base de datos (reemplaza con tus propios detalles)
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "sistemas";

                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    // Comprobar la conexión
                    if (!$conn) {
                        die("Conexión fallida: " . mysqli_connect_error());
                    }

                    // Obtener todas las categorías de la tabla tblcategory
                    $query = "SELECT * FROM categorias";
                    $result = mysqli_query($conn, $query);

                    // Mostrar las categorías en tarjetas de título
                    // Mostrar las categorías en tarjetas de título
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='category-card'>";
                        echo "<h3 style='margin-top: 50%;'>" . $row['Fullname'] . "</h3>";
                        echo "<form action='eliminar_categoria.php' method='post' onsubmit='return confirm(\"¿Estás seguro de eliminar esta categoría?\")'>";
                        echo "<button type='submit' class='btn btn-danger'>Acceder</button>";

                        echo "<input type='hidden' name='categoria_id' value='" . $row['id'] . "' />";
                        echo "</form>";
                        echo "</div>";
                    }


                    // Cerrar la conexión
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>

    </div>

</body>

</html>