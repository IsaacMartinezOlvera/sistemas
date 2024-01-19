<?php
// includes/header.php

// Inicializa la sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el tipo de usuario está definido y es igual a 1
if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 1) {
    echo '<nav class="navbar bg-body-tertiary">';
    echo '<div class="container-fluid">';
    echo '<img src="assets/img/DIF2.png" alt="Logo DIF2" id="logo">'; // Ajusta la ruta del logo según tu estructura de carpetas
    echo '<link rel="stylesheet" href="assets/css/tarjeta.css">'; // <-- Ajusta la ruta del archivo CSS

    echo '<a href="dashboard.php">Inicio</a>';
    echo '<a href="registro_usuario.php">Registrar Usuario</a>';
    echo '<a href="lista.php">Lista de usuarios</a>';
    echo '<a href="lista_bienes.php">Añadir a la Lista de bienes y servicios</a>';
    echo '<a href="total_bienes.php">Lista completa de bienes y servicios</a>';
    echo '<a href="categoria.php">Registrar dirección</a>';
    echo '<a href="subcategoria.php">Registrar coordinación</a>';
    echo '<a href="subsub.php">Registrar un servicio</a>';

    // Código de búsqueda (comentado)
    // echo ' <form class="d-flex" role="search">
    // <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">';

    echo '</div>';
    echo '</nav>';
    
}
?>
