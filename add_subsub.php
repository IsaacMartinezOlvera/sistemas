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

    $nombre_subsub = $_POST['nombre_subsub']; // coordinacion es nombre_subsub
    $categoria_seleccionada = $_POST['categoria']; // categoria es categoria
    $subcategoria_seleccionada = $_POST['subcategoria']; // subcategoria es nombre_subcategoria

    // Obtener el identificador de la categoría seleccionada
    $query_categoria_id = "SELECT identificador FROM categorias WHERE Fullname = ?";
    $stmt_categoria_id = $conn->prepare($query_categoria_id);
    $stmt_categoria_id->bind_param("s", $categoria_seleccionada);
    $stmt_categoria_id->execute();
    $stmt_categoria_id->store_result();

    if ($stmt_categoria_id->num_rows > 0) {
        $stmt_categoria_id->bind_result($categoria_id);
        $stmt_categoria_id->fetch();
    } else {
        die("Categoría no encontrada");
    }

    $stmt_categoria_id->close();

    // Obtener el identificador de la subcategoría seleccionada
    $query_subcategoria_id = "SELECT identificador FROM subcategoria WHERE nombre_subcategoria = ?";
    $stmt_subcategoria_id = $conn->prepare($query_subcategoria_id);
    $stmt_subcategoria_id->bind_param("s", $subcategoria_seleccionada);
    $stmt_subcategoria_id->execute();
    $stmt_subcategoria_id->store_result();

    if ($stmt_subcategoria_id->num_rows > 0) {
        $stmt_subcategoria_id->bind_result($subcategoria_id);
        $stmt_subcategoria_id->fetch();
    } else {
        die("Subcategoría no encontrada");
    }

    $stmt_subcategoria_id->close();

    // Obtener el último identificador utilizado en subsub
    $query_last_id = "SELECT MAX(identificador) AS last_id FROM subsub";
    $result_last_id = $conn->query($query_last_id);

    if (!$result_last_id) {
        die("Error en la consulta de último identificador: " . $conn->error);
    }

    $row_last_id = $result_last_id->fetch_assoc();
    $next_id = $row_last_id['last_id'] + 1;

    // Insertar datos en la tabla subsub con el identificador de la categoría y subcategoría
    $query_insert = "INSERT INTO subsub (nombre_subsub, identificador_categoria, identificador_subcategoria, identificador) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($query_insert);
    $stmt_insert->bind_param("siii", $nombre_subsub, $categoria_id, $subcategoria_id, $next_id);

    if ($stmt_insert->execute()) {
        header("Location: subsub.php");
        exit();
    } else {
        die("Error al guardar la subsubcategoría: " . $stmt_insert->error);
    }

    $stmt_insert->close();
    $conn->close();
} else {
    header("Location: subsub.php");
    exit();
}
?>
