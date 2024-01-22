<?php
session_start();
include('includes/conexion.php');

if (!isset($_SESSION['tipo_usuario'])) {
    header('Location: index.php');
    exit();
}

$tipo_usuario = $_SESSION['tipo_usuario'];

// Verificar si se ha enviado el formulario
if (isset($_POST['submit'])) {
    // Guardar y escapar los datos del formulario
    $consecutivo = mysqli_real_escape_string($conexion, $_POST['consecutivo']);
    $area = mysqli_real_escape_string($conexion, $_POST['area']);
    // continuando con los datos para llevar un orden
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $caracteristicas = mysqli_real_escape_string($conexion,$_POST['caracteristicas']);
    $marca = mysqli_real_escape_string($conexion,$_POST['marca']);


    // Obtener y validar la información de la imagen
    $foto = $_FILES['imagen']['name'];
    $tipoImagen = $_FILES['imagen']['type'];
    $tamanoImagen = $_FILES['imagen']['size'];

    // Validar el tipo de imagen permitido
    $allowedTypes = array("image/jpeg", "image/png", "image/gif");
    if (!in_array($tipoImagen, $allowedTypes)) {
        echo "Tipo de archivo no permitido.";
        exit();
    }

    // Validar el tamaño de la imagen
    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    if ($tamanoImagen > $maxFileSize) {
        echo "El tamaño del archivo es demasiado grande.";
        exit();
    }

    // Renombrar el archivo de imagen
    $foto = uniqid() . "_" . $foto;

    // Ruta de destino para almacenar la imagen
    $destino = "areas/" . $foto;

    // Mover la imagen al directorio de destino
    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
        echo "Error al subir la imagen.";
        exit();
    }



    // Preparar la consulta con una sentencia preparada
    $query = "INSERT INTO inventario(consecutivo_No, area, imagen,	descripcion,caracteristicas,marca) VALUES (?, ?, ?,?,?,?)";

    // Inicializar la sentencia preparada
    $stmt = mysqli_prepare($conexion, $query);

    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, "ssssss", $consecutivo, $area, $foto, $descripcion,$caracteristicas,$marca);

    // Ejecutar la sentencia preparada
    $funciona = mysqli_stmt_execute($stmt);

    // Verificar el resultado
    if ($funciona) {
        echo "Sí funciona";
    } else {
        echo "No funcionó";
    }

    // Cerrar la sentencia preparada
    mysqli_stmt_close($stmt);
}
