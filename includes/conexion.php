<?php
$host = "localhost";
$usuario_db = "root";
$contrasena_db = "";
$nombre_db = "sistemas";

$conexion = new mysqli($host, $usuario_db, $contrasena_db, $nombre_db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>