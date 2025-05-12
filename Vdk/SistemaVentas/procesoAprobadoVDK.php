<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: compraVentaVDK.php');
    exit();
}

// Obtener las solicitudes del cliente
try {
    $db = new PDO('sqlite:solicitudes.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $db->prepare("SELECT * FROM solicitudes WHERE clienteEmail = ? ORDER BY fechaCreacion DESC");
    $stmt->execute([$_SESSION['username']]);
    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($solicitudes)) {
        header('Location: compraVentaVDK.php');
        exit();
    }
} catch(PDOException $e) {
    error_log("Error al obtener solicitudes: " . $e->getMessage());
    header('Location: compraVentaVDK.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud Aprobada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .solicitud-card {
            margin-bottom: 20px;
            border-left: 4px solid #0d6efd;
        }
        .estado-badge {
            font-size: 0.9rem;
        }
        .servicio-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">
                            <i class="bi bi-check-circle-fill me-2"></i>Mis Solicitudes
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Bienvenido <?= htmlspecialchars($_SESSION['username']) ?>, aquí puedes ver el estado de tus solicitudes.</p>
                    </div>
                </div>
                
                <?php foreach($solicitudes as $solicitud): 
                    $servicios = json_decode($solicitud['servicios'], true);
                    $fechaCreacion = new DateTime($solicitud['fechaCreacion']);
                ?>
                    <div class="card solicitud-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Solicitud #<?= $solicitud['id'] ?></h5>
                            <span class="badge estado-badge bg-<?= 
                                $solicitud['estado'] === 'Completado' ? 'success' : 
                                ($solicitud['estado'] === 'En progreso' ? 'warning' : 'secondary') 
                            ?>">
                                <?= htmlspecialchars($solicitud['estado']) ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong><i class="bi bi-person-badge"></i> Artista:</strong>
                                    <?= htmlspecialchars($solicitud['artista']) ?>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="bi bi-calendar"></i> Fecha creación:</strong>
                                    <?= $fechaCreacion->format('d/m/Y H:i') ?>
                                </div>
                            </div>
                            
                            <h6 class="mt-4 mb-3"><i class="bi bi-list-check"></i> Servicios:</h6>
                            <div class="servicios-list">
                                <?php foreach($servicios as $servicio): ?>
                                    <div class="servicio-item">
                                        <span><?= htmlspecialchars($servicio['nombre']) ?></span>
                                        <span class="text-primary">$<?= $servicio['precio'] ?> <?= $servicio['moneda'] ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <strong><i class="bi bi-calendar-check"></i> Fecha aprobación:</strong>
                                    <?= $solicitud['fechaAprobacion'] ?>
                                </div>
                                <div class="col-md-6">
                                    <strong><i class="bi bi-calendar-event"></i> Próxima revisión:</strong>
                                    <?= $solicitud['fechaRevision1'] ?>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <strong><i class="bi bi-chat-left-text"></i> Descripción:</strong>
                                <p class="text-muted"><?= $solicitud['descripcion'] ? htmlspecialchars($solicitud['descripcion']) : 'Sin descripción adicional' ?></p>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                                <strong class="text-primary">Total: $<?= number_format($solicitud['total'], 2) ?> USD</strong>
                                <small class="text-muted">Creado por: <?= htmlspecialchars($solicitud['creadoPor']) ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div class="d-grid gap-2 mt-4">
                    <a href="cerrarSesion.php" class="btn btn-outline-danger">
                        <i class="bi bi-box-arrow-left me-2"></i>Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>