<?php
session_start();

// Simulación de base de datos de solicitudes (en un sistema real esto vendría de una DB)
$solicitudes = [
    'cliente1@example.com' => ['estado' => 'aprobado'],
    'cliente2@example.com' => ['estado' => 'aprobado']
    // Agregar más según sea necesario
];

if (isset($_SESSION['username'])) {
    $emailCliente = $_SESSION['username'];
    
    // Verificar si existe solicitud para este cliente
    if (array_key_exists($emailCliente, $solicitudes)) {
        header('Location: procesoAprobadoVDK.php');
    } else {
        header('Location: procesoDenegadoVDK.php');
    }
    exit();
} else {
    header('Location: compraVentaVDK.php');
    exit();
}
?>