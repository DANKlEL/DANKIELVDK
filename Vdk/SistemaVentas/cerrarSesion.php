<?php
session_start();

// Destruir completamente la sesión
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/');

// Redirigir al inicio
header('Location: compraVentaVDK.php');
exit();
?>