<?php
// Verificar que el usuario sea admin
if (!isset($_SESSION['username']) || !in_array($_SESSION['username'], ["infodankiel@gmail.com", "ddxous@gmail.com", "verake@gmail.com"])) {
    die("Acceso no autorizado");
}

// Determinar el artista por defecto
$artistaSugerido = "General";
if ($_SESSION['username'] === "infodankiel@gmail.com") $artistaSugerido = "Dankiel";
if ($_SESSION['username'] === "ddxous@gmail.com") $artistaSugerido = "Ddxous";
if ($_SESSION['username'] === "verake@gmail.com") $artistaSugerido = "Verake";
?>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h4><i class="bi bi-file-earmark-plus"></i> Crear Nueva Solicitud</h4>
    </div>
    <div class="card-body">
        <form id="formCrearSolicitud">
            <!-- Selección de Artista -->
            <div class="mb-4">
                <h5 class="mb-3">¿Quién eres?</h5>
                <div class="d-flex flex-wrap justify-content-between">
                    <div class="form-check-image">
                        <input class="form-check-input" type="radio" name="artista" id="artistaDankiel" value="Dankiel" <?= $artistaSugerido === 'Dankiel' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="artistaDankiel">
                            <img src="img/Vdk/dankiel/dankiel.PNG" class="rounded-circle artist-img" alt="Dankiel">
                            <span>Dankiel <?= $artistaSugerido === 'Dankiel' ? '(Sugerencia)' : '' ?></span>
                        </label>
                    </div>
                    <div class="form-check-image">
                        <input class="form-check-input" type="radio" name="artista" id="artistaVerake" value="Verake" <?= $artistaSugerido === 'Verake' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="artistaVerake">
                            <img src="img/Vdk/verake/verake.jpg" class="rounded-circle artist-img" alt="Verake">
                            <span>Verake <?= $artistaSugerido === 'Verake' ? '(Sugerencia)' : '' ?></span>
                        </label>
                    </div>
                    <div class="form-check-image">
                        <input class="form-check-input" type="radio" name="artista" id="artistaDdxous" value="Ddxous" <?= $artistaSugerido === 'Ddxous' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="artistaDdxous">
                            <img src="img/Vdk/ddxous/ddxous.jpg" class="rounded-circle artist-img" alt="Ddxous">
                            <span>Ddxous <?= $artistaSugerido === 'Ddxous' ? '(Sugerencia)' : '' ?></span>
                        </label>
                    </div>
                    <div class="form-check-image">
                        <input class="form-check-input" type="radio" name="artista" id="artistaGeneral" value="General" <?= $artistaSugerido === 'General' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="artistaGeneral">
                            <div class="rounded-circle artist-img multiple-artists">
                                <img src="img/Vdk/dankiel/dankiel.PNG" class="inner-img" style="top:0;left:0;">
                                <img src="img/Vdk/verake/verake.jpg" class="inner-img" style="top:0;right:0;">
                                <img src="img/Vdk/ddxous/ddxous.jpg" class="inner-img" style="bottom:0;left:25%;">
                            </div>
                            <span>General</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Correo del cliente -->
            <div class="mb-3">
                <label for="clienteEmail" class="form-label">Correo electrónico del cliente *</label>
                <input type="email" class="form-control" id="clienteEmail" required>
            </div>

            <!-- Servicios - Se llena dinámicamente con JS -->
            <div class="mb-3">
                <h5 class="mb-3">Seleccione los servicios *</h5>
                <div id="serviciosContainer" class="row"></div>
                <div id="serviciosGeneralContainer" class="row d-none"></div>
            </div>

            <!-- Resumen y total -->
            <div class="mb-3 p-3 bg-light rounded">
                <h5>Resumen</h5>
                <div id="resumenServicios"></div>
                <div class="mt-2">
                    <strong>Total: $<span id="totalSolicitud">0.00</span></strong>
                </div>
            </div>

            <!-- Fechas -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fechaAprobacion" class="form-label">Fecha de aprobación *</label>
                    <input type="date" class="form-control" id="fechaAprobacion" required value="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-6">
                    <label for="fechaRevision1" class="form-label">Primera fecha de revisión *</label>
                    <input type="date" class="form-control" id="fechaRevision1" required>
                </div>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción adicional</label>
                <textarea class="form-control" id="descripcion" rows="4" maxlength="1000"></textarea>
                <div class="form-text"><span id="contadorCaracteres">1000</span> caracteres restantes</div>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Crear Solicitud
            </button>
        </form>
    </div>
</div>

<script>
// Datos de servicios por artista
const servicios = {
    "Dankiel": {
        "3D Visualizer": [
            { nombre: "Render Animation Loop", precio: 30, moneda: "USD" },
            { nombre: "3D Visualizer", precio: 50, moneda: "USD" }
        ],
        "Pixel Art Visual": [
            { nombre: "Pixel Art (64x64 pixeles)", precio: 30, moneda: "USD" },
            { nombre: "Pixel Art (128x128)", precio: 40, moneda: "USD" }
        ],
        "VIDEOLYRICS": [
            { nombre: "LYRIC-CON-PORTADA", precio: 300, moneda: "MXN" },
            { nombre: "LYRIC-SIMPLE", precio: 100, moneda: "MXN" },
            { nombre: "JUST-VISUAL-CONCEPT", precio: 150, moneda: "MXN" }
        ],
        "Videoclip": [
            { nombre: "EDIT-VIDEO-CLIP", precio: 500, moneda: "MXN" }
        ],
        "AMV": [
            { nombre: "AMV", precio: 100, moneda: "MXN" }
        ]
    },
    "Verake": {
        "VIDEOLYRICS": [
            { nombre: "Videoclip simple", precio: 50, moneda: "USD" },
            { nombre: "SIMPLE CON MONTAJE", precio: 65, moneda: "USD" },
            { nombre: "Videoclip complejo", precio: 85, moneda: "USD" }
        ]
    },
    "Ddxous": {
        "Videoclip": [
            { nombre: "Videoclip simple sin montaje", precio: 50, moneda: "USD" },
            { nombre: "Videoclip simple con montaje", precio: 65, moneda: "USD" },
            { nombre: "Videoclip complejo", precio: 85, moneda: "USD" }
        ],
        "VIDEOLYRICS": [
            { nombre: "Videolyric sin portada simple", precio: 25, moneda: "USD" },
            { nombre: "Videolyric sin portada complejo", precio: 40, moneda: "USD" },
            { nombre: "Videolyric con portada simple", precio: 20, moneda: "USD" },
            { nombre: "Videolyric con portada complejo", precio: 30, moneda: "USD" }
        ],
        "PORTADAS": [
            { nombre: "Portada simple", precio: 5, moneda: "USD" },
            { nombre: "Portada compleja", precio: 8, moneda: "USD" }
        ]
    }
};

// Cargar servicios cuando cambie el artista
document.querySelectorAll('input[name="artista"]').forEach(radio => {
    radio.addEventListener('change', function() {
        cargarServicios(this.value);
    });
});

// Función para cargar servicios
function cargarServicios(artista) {
    const container = artista === "General" ? 
        document.getElementById('serviciosGeneralContainer') : 
        document.getElementById('serviciosContainer');
    
    const otherContainer = artista === "General" ? 
        document.getElementById('serviciosContainer') : 
        document.getElementById('serviciosGeneralContainer');
    
    otherContainer.classList.add('d-none');
    container.innerHTML = '';
    container.classList.remove('d-none');
    
    if (artista === "General") {
        // Mostrar todos los servicios con capacidad de editar precios
        for (const [artistaKey, categorias] of Object.entries(servicios)) {
            for (const [categoria, items] of Object.entries(categorias)) {
                const categoriaHTML = document.createElement('div');
                categoriaHTML.className = 'col-md-6 mb-4';
                categoriaHTML.innerHTML = `
                    <div class="card h-100">
                        <div class="card-header">
                            <h6>${artistaKey} - ${categoria}</h6>
                        </div>
                        <div class="card-body">
                            ${items.map(item => `
                                <div class="form-check mb-2">
                                    <input class="form-check-input servicio-check" type="checkbox" 
                                        id="serv-${artistaKey}-${categoria}-${item.nombre.replace(/\s+/g, '-')}" 
                                        value="${item.nombre}" data-precio="${item.precio}" data-moneda="${item.moneda}">
                                    <label class="form-check-label" for="serv-${artistaKey}-${categoria}-${item.nombre.replace(/\s+/g, '-')}">
                                        ${item.nombre} 
                                        <input type="number" class="form-control form-control-sm d-inline-block ms-2 precio-input" 
                                            value="${item.precio}" style="width: 80px;" min="0" step="0.01">
                                        ${item.moneda}
                                    </label>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `;
                container.appendChild(categoriaHTML);
            }
        }
    } else {
        // Mostrar solo servicios del artista seleccionado
        for (const [categoria, items] of Object.entries(servicios[artista])) {
            const categoriaHTML = document.createElement('div');
            categoriaHTML.className = 'col-md-6 mb-4';
            categoriaHTML.innerHTML = `
                <div class="card h-100">
                    <div class="card-header">
                        <h6>${categoria}</h6>
                    </div>
                    <div class="card-body">
                        ${items.map(item => `
                            <div class="form-check mb-2">
                                <input class="form-check-input servicio-check" type="checkbox" 
                                    id="serv-${artista}-${categoria}-${item.nombre.replace(/\s+/g, '-')}" 
                                    value="${item.nombre}" data-precio="${item.precio}" data-moneda="${item.moneda}">
                                <label class="form-check-label" for="serv-${artista}-${categoria}-${item.nombre.replace(/\s+/g, '-')}">
                                    ${item.nombre} - $${item.precio} ${item.moneda}
                                </label>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
            container.appendChild(categoriaHTML);
        }
    }
    
    // Agregar eventos a los checkboxes
    document.querySelectorAll('.servicio-check').forEach(checkbox => {
        checkbox.addEventListener('change', actualizarResumen);
    });
    
    // Agregar eventos a los inputs de precio (solo en modo General)
    if (artista === "General") {
        document.querySelectorAll('.precio-input').forEach(input => {
            input.addEventListener('input', function() {
                const checkbox = this.parentElement.querySelector('.servicio-check');
                checkbox.dataset.precio = this.value;
                if (checkbox.checked) {
                    actualizarResumen();
                }
            });
        });
    }
    
    actualizarResumen();
}

// Función para actualizar el resumen y total
function actualizarResumen() {
    const serviciosSeleccionados = [];
    let total = 0;
    
    document.querySelectorAll('.servicio-check:checked').forEach(checkbox => {
        const precio = parseFloat(checkbox.dataset.precio);
        const moneda = checkbox.dataset.moneda;
        let precioUSD = precio;
        
        // Convertir MXN a USD si es necesario (tasa de cambio aproximada)
        if (moneda === "MXN") {
            precioUSD = precio * 0.06; // Cambiar por tasa de cambio actual
        }
        
        serviciosSeleccionados.push({
            nombre: checkbox.value,
            precio: precio,
            moneda: moneda,
            precioUSD: precioUSD
        });
        
        total += precioUSD;
    });
    
    // Mostrar resumen
    const resumenHTML = serviciosSeleccionados.map(serv => 
        `<div>${serv.nombre} - $${serv.precio} ${serv.moneda}</div>`
    ).join('');
    
    document.getElementById('resumenServicios').innerHTML = resumenHTML || "No hay servicios seleccionados";
    document.getElementById('totalSolicitud').textContent = total.toFixed(2);
}

// Contador de caracteres
document.getElementById('descripcion').addEventListener('input', function() {
    const remaining = 1000 - this.value.length;
    document.getElementById('contadorCaracteres').textContent = remaining;
});

// Cargar servicios iniciales
document.addEventListener('DOMContentLoaded', function() {
    const artistaSeleccionado = document.querySelector('input[name="artista"]:checked').value;
    cargarServicios(artistaSeleccionado);
    
    // Validar fecha de revisión (debe ser posterior a hoy)
    const fechaRevision = document.getElementById('fechaRevision1');
    fechaRevision.min = new Date().toISOString().split('T')[0];
    
    // Manejar envío del formulario
    document.getElementById('formCrearSolicitud').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validar que se haya seleccionado al menos un servicio
        if (document.querySelectorAll('.servicio-check:checked').length === 0) {
            Swal.fire('Error', 'Debes seleccionar al menos un servicio', 'error');
            return;
        }
        
        // Obtener datos del formulario
        const formData = {
            artista: document.querySelector('input[name="artista"]:checked').value,
            clienteEmail: document.getElementById('clienteEmail').value,
            servicios: [],
            total: parseFloat(document.getElementById('totalSolicitud').textContent),
            fechaAprobacion: document.getElementById('fechaAprobacion').value,
            fechaRevision1: document.getElementById('fechaRevision1').value,
            descripcion: document.getElementById('descripcion').value,
            creadoPor: '<?= $_SESSION['username'] ?>',
            estado: 'Pendiente',
            fechaCreacion: new Date().toISOString()
        };
        
        // Agregar servicios seleccionados
        document.querySelectorAll('.servicio-check:checked').forEach(checkbox => {
            formData.servicios.push({
                nombre: checkbox.value,
                precio: parseFloat(checkbox.dataset.precio),
                moneda: checkbox.dataset.moneda
            });
        });
        
        // Enviar datos al servidor
        fetch('guardarSolicitud.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Éxito', 'Solicitud creada correctamente', 'success').then(() => {
                    // Recargar la pestaña de gestión para mostrar la nueva solicitud
                    document.getElementById('gestionar-tab').click();
                    // Limpiar formulario
                    document.getElementById('formCrearSolicitud').reset();
                    actualizarResumen();
                });
            } else {
                Swal.fire('Error', 'Hubo un problema al guardar la solicitud', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Hubo un problema al guardar la solicitud', 'error');
        });
    });
});
</script>

<style>
.artist-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    display: block;
    margin: 0 auto 5px;
    border: 3px solid #dee2e6;
    transition: border-color 0.3s;
}

.form-check-input:checked + .form-check-label .artist-img {
    border-color: #0d6efd;
}

.form-check-image {
    text-align: center;
    margin-bottom: 15px;
    width: 23%;
    cursor: pointer;
}

.form-check-image .form-check-input {
    position: absolute;
    opacity: 0;
}

.form-check-image .form-check-label {
    cursor: pointer;
}

.multiple-artists {
    position: relative;
    background: #f8f9fa;
}

.inner-img {
    width: 40px;
    height: 40px;
    position: absolute;
    border: 2px solid white;
    border-radius: 50%;
}

.card-header {
    font-weight: bold;
}
</style>