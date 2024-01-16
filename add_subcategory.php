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
    $categoria_seleccionada = $_POST['categoria'];

    // Obtener el identificador de la categoría seleccionada
    $query_categoria_id = "SELECT identificador FROM categorias WHERE Fullname = '$categoria_seleccionada'";
    $result_categoria_id = $conn->query($query_categoria_id);

    if (!$result_categoria_id) {
        die("Error en la consulta de identificador de categoría: " . $conn->error);
    }

    $row_categoria_id = $result_categoria_id->fetch_assoc();
    $categoria_id = $row_categoria_id['identificador'];

    // Obtener el último identificador utilizado en subcategoria
    $query_last_id = "SELECT MAX(identificador) AS last_id FROM subcategoria";
    $result_last_id = $conn->query($query_last_id);

    if (!$result_last_id) {
        die("Error en la consulta de último identificador: " . $conn->error);
    }

    $row_last_id = $result_last_id->fetch_assoc();
    $next_id = $row_last_id['last_id'] + 1;

    // Insertar datos en la tabla subcategoria con el identificador de la categoría
    $sql = "INSERT INTO subcategoria (nombre_subcategoria, identificador_categoria, identificador) VALUES ('$nombre_subcategoria', $categoria_id, $next_id)";

    if ($conn->query($sql) === TRUE) {
        header("Location: subcategoria.php");
        exit();
    } else {
        echo "Error al guardar la subcategoría: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: subcategoria.php");
    exit();
}
?>
