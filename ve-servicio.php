<?php
if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
$categoria_usuario = $_SESSION['categoria_usuario'];
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="assets/css/tarjeta.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Selecciona el inventario al revisar</h2>
                <div class="category-container">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "sistemas";

                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    if (!$conn) {
                        die("Conexión fallida: " . mysqli_connect_error());
                    }

                    $query = "SELECT * FROM subsub WHERE nombre_subsub = '$categoria_usuario'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);

                    echo "<div class='category-card'>";
                    echo "<h3 style='margin-top: 50%;'>" . $row['nombre_subsub'] . "</h3>";
                    echo "<a href='ver-subcategoria.php?identificador_subcategoria=" . $row['identificador'] . "' class='btn btn-primary'>Ver la coordinación</a>";
                    echo "<input type='hidden' name='categoria_id' value='" . $row['identificador'] . "' />";
                    echo "</div>";

                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
