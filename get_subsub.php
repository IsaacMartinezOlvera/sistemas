<?php
$identificador_categoria = $_GET['identificador_categoria'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistemas";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$query_subcategorias = "SELECT nombre_subsub, identificador_categoria FROM subsub WHERE identificador_categoria = '$identificador_categoria'";
$result_subcategorias = mysqli_query($conn, $query_subcategorias);

while ($row_subcategoria = mysqli_fetch_assoc($result_subcategorias)) {
    echo "<option value='" . $row_subcategoria['identificador_categoria'] . "'>" . $row_subcategoria['nombre_subsub'] . "</option>";
}

mysqli_close($conn);
?>
