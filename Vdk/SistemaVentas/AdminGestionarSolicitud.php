<?php
// Verificar que el usuario sea admin
if (!isset($_SESSION['username']) || !in_array($_SESSION['username'], ["infodankiel@gmail.com", "ddxous@gmail.com", "verake@gmail.com"])) {
    die("Acceso no autorizado");
}

// Obtener solicitudes de la base de datos
$solicitudes = [];
try {
    $db = new PDO('sqlite:solicitudes.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Crear tabla si no existe
    $db->exec("CREATE TABLE IF NOT EXISTS solicitudes (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        artista TEXT NOT NULL,
        clienteEmail TEXT NOT NULL,
        servicios TEXT NOT NULL,
        total REAL NOT NULL,
        fechaAprobacion TEXT NOT NULL,
        fechaRevision1 TEXT NOT NULL,
        descripcion TEXT,
        creadoPor TEXT NOT NULL,
        estado TEXT NOT NULL,
        fechaCreacion TEXT NOT NULL
    )");
    
    // Obtener todas las solicitudes
    $stmt = $db->query("SELECT * FROM solicitudes ORDER BY fechaCreacion DESC");
    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Error al obtener solicitudes: " . $e->getMessage());
}
?>

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4><i class="bi bi-list-check"></i> Gestionar Solicitudes</h4>
        <button id="refreshSolicitudes" class="btn btn-light btn-sm">
            <i class="bi bi-arrow-clockwise"></i> Actualizar
        </button>
    </div>
    <div class="card-body">
        <?php if(empty($solicitudes)): ?>
            <div class="alert alert-info">
                No hay solicitudes registradas todavía.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Artista</th>
                            <th>Servicios</th>
                            <th>Total</th>
                            <th>Creado Por</th>
                            <th>Fecha Creación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($solicitudes as $solicitud): 
                            $servicios = json_decode($solicitud['servicios'], true);
                            $fechaCreacion = new DateTime($solicitud['fechaCreacion']);
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($solicitud['id']) ?></td>
                                <td><?= htmlspecialchars($solicitud['clienteEmail']) ?></td>
                                <td><?= htmlspecialchars($solicitud['artista']) ?></td>
                                <td>
                                    <ul class="list-unstyled">
                                        <?php foreach($servicios as $servicio): ?>
                                            <li><?= htmlspecialchars($servicio['nombre']) ?> - $<?= $servicio['precio'] ?> <?= $servicio['moneda'] ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                                <td>$<?= number_format($solicitud['total'], 2) ?> USD</td>
                                <td><?= htmlspecialchars($solicitud['creadoPor']) ?></td>
                                <td><?= $fechaCreacion->format('d/m/Y H:i') ?></td>
                                <td>
                                    <span class="badge bg-<?= 
                                        $solicitud['estado'] === 'Completado' ? 'success' : 
                                        ($solicitud['estado'] === 'En progreso' ? 'warning' : 'secondary') 
                                    ?>">
                                        <?= htmlspecialchars($solicitud['estado']) ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info ver-detalles" data-id="<?= $solicitud['id'] ?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary editar-solicitud" data-id="<?= $solicitud['id'] ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal para ver detalles -->
<div class="modal fade" id="detallesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de la Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detallesSolicitud">
                <!-- Contenido se llena con JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Botón para actualizar la lista
    document.getElementById('refreshSolicitudes').addEventListener('click', function() {
        location.reload();
    });
    
    // Ver detalles de la solicitud
    document.querySelectorAll('.ver-detalles').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            
            fetch(`obtenerSolicitud.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const solicitud = data.solicitud;
                        const servicios = JSON.parse(solicitud.servicios);
                        
                        let html = `
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>ID:</strong> ${solicitud.id}
                                </div>
                                <div class="col-md-6">
                                    <strong>Estado:</strong> <span class="badge bg-${solicitud.estado === 'Completado' ? 'success' : (solicitud.estado === 'En progreso' ? 'warning' : 'secondary')}">${solicitud.estado}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Artista:</strong> ${solicitud.artista}
                                </div>
                                <div class="col-md-6">
                                    <strong>Cliente:</strong> ${solicitud.clienteEmail}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Creado por:</strong> ${solicitud.creadoPor}
                                </div>
                                <div class="col-md-6">
                                    <strong>Fecha creación:</strong> ${new Date(solicitud.fechaCreacion).toLocaleString()}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Fecha aprobación:</strong> ${solicitud.fechaAprobacion}
                                </div>
                                <div class="col-md-6">
                                    <strong>1ra fecha revisión:</strong> ${solicitud.fechaRevision1}
                                </div>
                            </div>
                            <div class="mb-3">
                                <strong>Servicios:</strong>
                                <ul class="list-group mt-2">
                                    ${servicios.map(serv => `
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            ${serv.nombre}
                                            <span class="badge bg-primary rounded-pill">$${serv.precio} ${serv.moneda}</span>
                                        </li>
                                    `).join('')}
                                </ul>
                            </div>
                            <div class="mb-3">
                                <strong>Total:</strong> $${solicitud.total} USD
                            </div>
                            <div class="mb-3">
                                <strong>Descripción:</strong>
                                <div class="border p-2 mt-2 rounded">${solicitud.descripcion || 'Sin descripción adicional'}</div>
                            </div>
                        `;
                        
                        document.getElementById('detallesSolicitud').innerHTML = html;
                        const modal = new bootstrap.Modal(document.getElementById('detallesModal'));
                        modal.show();
                    } else {
                        Swal.fire('Error', 'No se pudo obtener la información de la solicitud', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Hubo un problema al obtener los detalles', 'error');
                });
        });
    });
    
    // Editar solicitud (pendiente de implementación)
    document.querySelectorAll('.editar-solicitud').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire('En desarrollo', 'La edición de solicitudes estará disponible pronto', 'info');
        });
    });
});
</script>