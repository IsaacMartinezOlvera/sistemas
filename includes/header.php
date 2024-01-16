<?php
// includes/header.php

if ($tipo_usuario == 1) {
    echo '<div id="header">';
    // Código del encabezado
    echo '<h1>Encabezado del Administrador</h1>';
    
    // Botón de registro de usuario
    echo '<a href="registro_usuario.php">Registrar Usuario</a>';
    echo '<a href="lista.php">Lista de usuarios</a>';
    echo '<a href="cards.php">Tarjetas</a>';    
    echo '<a href="categoria.php">Registrar categoria</a>';
    echo '<a href="subcategoria.php">Registrar subcategoria</a>';

    echo '</div>';
}
?>
 