<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistemas";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos: " . $conn->connect_error);
    }

    $nombre_subcategoria = $_POST['nombre_subcategoria'];

    // Obtener el último identificador utilizado
    $query_last_id = "SELECT MAX(identificador) AS last_id FROM subcategoria";
    $result_last_id = $conn->query($query_last_id);
    $row_last_id = $result_last_id->fetch_assoc();
    $next_id = $row_last_id['last_id'] + 1;

    // Insertar datos en la tabla subcategoria con el nuevo identificador
    $sql = "INSERT INTO subcategoria (nombre_subcategoria, identificador) VALUES ('$nombre_subcategoria', $next_id)";

    if ($conn->query($sql) === TRUE) {
        header("Location: subcategoria.php");
        exit();
    } else {
        echo "Error al guardar la subcategoría: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: categoria.php");
    exit();
}
?>
