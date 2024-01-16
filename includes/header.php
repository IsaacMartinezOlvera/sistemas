<?php
// includes/header.php

if ($tipo_usuario == 1) {
    echo '<div id="header">';
    // Código del encabezado
    echo '<h1>Encabezado del Administrador</h1>';
    
    // Botón de registro de usuario
    echo '<a href="registro_usuario.php">Registrar Usuario</a>';
    
    echo '</div>';
}
?>
 