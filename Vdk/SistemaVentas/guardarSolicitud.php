<?php
session_start();

// Verificar que el usuario sea admin
$allowedEmails = ["infodankiel@gmail.com", "ddxous@gmail.com", "verake@gmail.com"];
if (!isset($_SESSION['username']) || !in_array($_SESSION['username'], $allowedEmails)) {
    die(json_encode(['success' => false, 'message' => 'Acceso no autorizado']));
}

// Obtener datos del POST
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    die(json_encode(['success' => false, 'message' => 'Datos inválidos']));
}

try {
    $db = new PDO('sqlite:solicitudes.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Insertar la solicitud
    $stmt = $db->prepare("INSERT INTO solicitudes (
        artista, clienteEmail, servicios, total, fechaAprobacion, 
        fechaRevision1, descripcion, creadoPor, estado, fechaCreacion
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $success = $stmt->execute([
        $data['artista'],
        $data['clienteEmail'],
        json_encode($data['servicios']),
        $data['total'],
        $data['fechaAprobacion'],
        $data['fechaRevision1'],
        $data['descripcion'],
        $data['creadoPor'],
        'Pendiente',
        $data['fechaCreacion']
    ]);
    
    echo json_encode(['success' => $success, 'id' => $db->lastInsertId()]);
} catch(PDOException $e) {
    error_log("Error al guardar solicitud: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error al guardar en la base de datos']);
}
?>