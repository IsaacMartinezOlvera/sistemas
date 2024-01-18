<?php
session_start();

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];
include('includes/conexion.php');

if (isset($_POST['category_name'])) {
    $category_name = $_POST['category_name'];

    // Verificar si el nombre de la categoría ya existe
    $query_check = "SELECT * FROM categorias WHERE FullName = ?";
    $stmt_check = mysqli_prepare($conexion, $query_check);
    mysqli_stmt_bind_param($stmt_check, 's', $category_name);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);

    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        echo "La dirección '" . $category_name . "' ya existe.";
    } else {
        // Obtener el siguiente identificador disponible
        $query_max_id = "SELECT MAX(identificador) AS max_id FROM categorias";
        $result_max_id = mysqli_query($conexion, $query_max_id);
        $row_max_id = mysqli_fetch_assoc($result_max_id);
        $next_identifier = $row_max_id['max_id'] + 1;

        // Insertar la categoría en la base de datos con el identificador asignado
        $query_insert = "INSERT INTO categorias (FullName, identificador) 
                         SELECT ?, ? FROM dual 
                         WHERE NOT EXISTS (SELECT 1 FROM categorias WHERE FullName = ?)";
        $stmt_insert = mysqli_prepare($conexion, $query_insert);
        mysqli_stmt_bind_param($stmt_insert, 'iss', $category_name, $next_identifier, $category_name);
        $result_insert = mysqli_stmt_execute($stmt_insert);

        if ($result_insert) {
            echo "Dirección '" . $category_name . "' agregada exitosamente!";
        } else {
            echo "Error al agregar la categoría: " . mysqli_error($conexion);
        }
    }
}
?>
