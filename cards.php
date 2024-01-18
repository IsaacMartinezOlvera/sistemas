<?php
// Mover la inclusión del archivo header.php antes de session_start()
// include('includes/header.php');


if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
?>


</html>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="assets/css/tarjeta.css"> <!-- Agrega esta línea para incluir el CSS -->


</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Selecciona el inventario al revisar</h2>
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
                        echo "<a href='libros.php?categoria=" . $row['Fullname'] . "' class='btn btn-primary'>Ver la coordinación</a>";

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