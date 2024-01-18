<?php
include('includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['identificador_categoria'])) {
    $identificador_categoria = $_GET['identificador_categoria'];

    // Obtener las subcategorías basadas en el identificador de la categoría
    $query_subcategoria = "SELECT nombre_subcategoria FROM subcategoria WHERE identificador_categoria = '$identificador_categoria'";
    $result_subcategoria = mysqli_query($conn, $query_subcategoria);
    $subcategorias = array();

    while ($row_subcategoria = mysqli_fetch_assoc($result_subcategoria)) {
        $subcategorias[] = $row_subcategoria['nombre_subcategoria'];
    }

    echo json_encode($subcategorias);
} else {
    echo json_encode([]);
}
?>
<?php
include('includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['identificador_categoria'])) {
    $identificador_categoria = $_GET['identificador_categoria'];

    // Obtener las subcategorías basadas en el identificador de la categoría
    $query_subcategoria = "SELECT nombre_subcategoria FROM subcategoria WHERE identificador_categoria = '$identificador_categoria'";
    $result_subcategoria = mysqli_query($conn, $query_subcategoria);
    $subcategorias = array();

    while ($row_subcategoria = mysqli_fetch_assoc($result_subcategoria)) {
        $subcategorias[] = $row_subcategoria['nombre_subcategoria'];
    }

    echo json_encode($subcategorias);
} else {
    echo json_encode([]);
}
?>
