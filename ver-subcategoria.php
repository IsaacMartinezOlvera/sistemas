

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="assets/css/tarjeta.css"> <!-- Agrega esta línea para incluir el CSS -->
</head>

<body>
<?php include('includes/header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="category-container">
                    <?php
                    // ver-subcategoria.php

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

                    // Obtener el identificador de la categoría desde la URL
                    $identificador_categoria = isset($_GET['identificador_categoria']) ? $_GET['identificador_categoria'] : null;

                    // Verificar si el parámetro está definido
                    if ($identificador_categoria !== null) {
                        // Escapar el valor para prevenir inyección SQL (importante)
                        $identificador_categoria = mysqli_real_escape_string($conn, $identificador_categoria);

                        // Obtener las subcategorías relacionadas con el identificador de la categoría
                        $query = "SELECT * FROM subcategoria WHERE identificador_categoria = '$identificador_categoria'";
                        $result = mysqli_query($conn, $query);

                        // Verificar errores en la consulta
                        if (!$result) {
                            die("Error en la consulta: " . mysqli_error($conn));
                        }

                        // Mostrar las subcategorías
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='subcategory-card'>";
                            echo "<h3>" . $row['nombre_subcategoria'] . "</h3>";
                            echo "<a href='ver-subcategoria.php?identificador_categoria=" . $row['identificador'] . "' class='btn btn-primary'>Ver la coordinación</a>";
                            echo "</div>";
                        }
                    } else {
                        // Mostrar un mensaje o redirigir a otra página si no se proporciona el parámetro
                        echo "Identificador de categoría no proporcionado.";
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
