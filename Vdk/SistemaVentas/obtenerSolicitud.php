<?php
session_start();

// Verificar que el usuario sea admin
$allowedEmails = ["infodankiel@gmail.com", "ddxous@gmail.com", "verake@gmail.com"];
if (!isset($_SESSION['username']) || !in_array($_SESSION['username'], $allowedEmails)) {
    die(json_encode(['success' => false, 'message' => 'Acceso no autorizado']));
}

if (!isset($_GET['id'])) {
    die(json_encode(['success' => false, 'message' => 'ID no especificado']));
}

try {
    $db = new PDO('sqlite:solicitudes.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $db->prepare("SELECT * FROM solicitudes WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $solicitud = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($solicitud) {
        echo json_encode(['success' => true, 'solicitud' => $solicitud]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Solicitud no encontrada']);
    }
} catch(PDOException $e) {
    error_log("Error al obtener solicitud: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error al consultar la base de datos']);
}
?>