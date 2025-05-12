<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode(['tieneSolicitud' => false]);
    exit();
}

try {
    $db = new PDO('sqlite:solicitudes.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $db->prepare("SELECT COUNT(*) FROM solicitudes WHERE clienteEmail = ?");
    $stmt->execute([$_SESSION['username']]);
    $count = $stmt->fetchColumn();
    
    echo json_encode(['tieneSolicitud' => $count > 0]);
} catch(PDOException $e) {
    error_log("Error al verificar solicitudes: " . $e->getMessage());
    echo json_encode(['tieneSolicitud' => false]);
}
?>