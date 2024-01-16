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

    // Check if the category name already exists
    $query = "SELECT * FROM categorias WHERE FullName = '".$category_name."'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        // Display an error message if the name already exists
        echo "Error: The category name '".$category_name."' already exists.";
    } else {
        // Insert the category into the database
        $query = "INSERT INTO categorias (FullName, identificador) VALUES ('".$category_name."', 1)";
        $result = mysqli_query($conexion, $query);

        if ($result) {
            echo "Category added successfully!";
        } else {
            echo "Error adding category: " . mysqli_error($conexion);
        }
    }
}
?>
