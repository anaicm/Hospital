<?php
/**
 * Cierra sesión
 * si la sesión esta iniciada y el usuario es nulo, redirige al index mediante la función header()
 * @author Ana Isabel Cuéllar Maestro
 * @since @since 22/04/2023
 */

session_start();
$_SESSION['usuario'] = null;
header('Location: index.html');
exit; 
?>