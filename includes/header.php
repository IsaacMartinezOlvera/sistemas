<?php
// includes/header.php
if ($tipo_usuario == 1) {
<<<<<<< HEAD
    
    echo '<div id="header">';
    // Código del encabezado
    echo '<h1>Encabezado del Administrador</h1>';
    echo '<link rel="stylesheet" href="assets/css/tarjeta-dist.css">'; // <-- Add this line to include the CSS file
    echo '<link rel="stylesheet" href="path/to/your/css/file.css">    ';
    // Botón de registro de usuario
=======
    echo '<nav class="navbar bg-body-tertiary">';
    echo ' <div class="container-fluid">    ';
    echo '<img src="assets/img/DIF2.png" alt="Logo DIF2" id="logo">'; // Ajusta la ruta del logo según tu estructura de carpetas
    echo '<link rel="stylesheet" href="assets/css/tarjeta.css">'; // <-- Ajusta la ruta del archivo CSS


    echo '<a href="dashboard.php">Inicio</a>';
>>>>>>> 37310563121e4cd5c94691e28e5d7b9dacdef15f
    echo '<a href="registro_usuario.php">Registrar Usuario</a>';
    echo '<a href="lista.php">Lista de usuarios</a>';
    // echo '<a href="cards.php">Tarjetas</a>';
    echo '<a href="categoria.php">Registrar dirección</a>';
    echo '<a href="subcategoria.php">Registrar coordinación</a>';
    echo '<a href="subsub.php">Registrar un servicio</a>';

    //El código de abajo es de un buscador que hay en el header
    // echo '      <form class="d-flex" role="search">
    // <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">';


    echo '</div>';
    echo '</nav>';
}
?>

<<<<<<< HEAD
<!-- Agrega este enlace a Bootstrap antes de tu archivo de estilos personalizado -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">



 
=======
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
>>>>>>> 37310563121e4cd5c94691e28e5d7b9dacdef15f
