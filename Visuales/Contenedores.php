<!-- Contenedor principal que envuelve todo -->
<div class="contenedor-general">
    <!-- Contenedor para 3D y Pixel Art -->
    <div class="contenedor-superior">
<!-- CONTENEDOR 3D VISUAL (IZQUIERDA) -->
        <div class="CONTENEDOR-3D-VISUAL">
            <div class="left-container">
                <img src="img/Textos/3Dvisual.png" alt="Texto 3D" class="small-image" id="imagen3D">
                <div class="carousel">
                    <!-- Reproductor de video -->
                    <div id="videoPlayerContainer3D">
                        <iframe id="player3D" width="100%" height="100%" src="https://www.youtube.com/embed/fdtGIXlSBYU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <!-- Controles de video -->
                    <div class="video-controls">
                        <div class="top-controls">
                            <button id="prevVideo3D" class="control-button"><i class="fas fa-chevron-left"></i></button>
                            <button id="playPause3D" class="control-button"><i class="fas fa-play"></i></button>
                            <button id="nextVideo3D" class="control-button"><i class="fas fa-chevron-right"></i></button>
                        </div>
                        <span id="currentTime3D">0:00</span>
                        <input type="range" id="progressBar3D" min="0" max="100" value="0">
                        <span id="totalTime3D">0:00</span>
                    </div>
                    <!-- Rectángulo de Precio/Información -->
                    <div class="info-rectangle" id="infoRectangle3D">
                        Precio/Información
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTENEDOR PIXEL ART (DERECHA) -->
        <div class="CONTENEDOR-PIXEL-ART">
            <img src="img/Textos/PixelArtvisual.png" alt="Texto Pixel Art" class="small-image" id="imagenPixelArt">
            <div class="carousel">
                <div id="videoPlayerContainerPixelArt">
                    <iframe id="playerPixelArt" width="100%" height="100%" src="https://www.youtube.com/embed/1YhCMtuWXYI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="video-controls">
                    <div class="top-controls">
                        <button id="prevVideoPixelArt" class="control-button"><i class="fas fa-chevron-left"></i></button>
                        <button id="playPausePixelArt" class="control-button"><i class="fas fa-play"></i></button>
                        <button id="nextVideoPixelArt" class="control-button"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    <span id="currentTimePixelArt">0:00</span>
                    <input type="range" id="progressBarPixelArt" min="0" max="100" value="0">
                    <span id="totalTimePixelArt">0:00</span>
                </div>
                <!-- Rectángulo de Precio/Información -->
                <div class="info-rectangle" id="infoRectanglePixelArt">
                    Precio/Información
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENEDOR RESTO VISUALES -->
    <div class="CONTENEDOR-RESTO-VISUALES">
        <div class="menu-lateral">
            <ul>
                <li><a href="#" data-tipo="lyric-con-portada">LYRIC VISUAL CON PORTADA</a></li>
                <li><a href="#" data-tipo="lyric-simple">LYRIC VISUAL SIMPLE</a></li>
                <li><a href="#" data-tipo="edit-video-clip">EDIT DE VIDEO CLIP</a></li>
                <li><a href="#" data-tipo="just-visual-concept">JUST VISUAL CONCEPT</a></li>
                <li><a href="#" data-tipo="amv">AMV</a></li>
            </ul>
        </div>
        <div class="contenedor-video">
            <!-- Imágenes para los tipos de visuales -->
            <img src="img/Textos/LyricPro.png" alt="Lyric Visual con Portada" id="imagenLyricPro" class="small-image">
            <img src="img/Textos/LyricSimple.png" alt="Lyric Visual Simple" id="imagenLyricSimple" class="small-image" style="display: none;">
            <img src="img/Textos/VIDEOCLIP.png" alt="Edit de Video Clip" id="imagenVideoClip" class="small-image" style="display: none;">
            <img src="img/Textos/Concept.png" alt="Just Visual Concept" id="imagenConcept" class="small-image" style="display: none;">
            <img src="img/Textos/AMV.png" alt="AMV" id="imagenAMV" class="small-image" style="display: none;">
            <div class="carousel">
                <div id="videoPlayerContainerRestoVisuales">
                    <iframe id="playerRestoVisuales" width="100%" height="100%" src="https://www.youtube.com/embed/ZRV_zPK18Gg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="video-controls">
                    <div class="top-controls">
                        <button id="prevVideoRestoVisuales" class="control-button"><i class="fas fa-chevron-left"></i></button>
                        <button id="playPauseRestoVisuales" class="control-button"><i class="fas fa-play"></i></button>
                        <button id="nextVideoRestoVisuales" class="control-button"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    <span id="currentTimeRestoVisuales">0:00</span>
                    <input type="range" id="progressBarRestoVisuales" min="0" max="100" value="0">
                    <span id="totalTimeRestoVisuales">0:00</span>
                </div>
                <!-- Rectángulo de Precio/Información -->
                <div class="info-rectangle" id="infoRectangleRestoVisuales">
                    Precio/Información
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Listas de videos para cada tipo de visual
    const videosPorTipo = {
        'lyric-con-portada': [
            'ZRV_zPK18Gg',
            'toA7TAhdJQM',
            'ABS1KqO6Dro',
            'azfkhwF1jGw'
        ],
        'lyric-simple': [
            'NyeYJHwbMgw',
            'x1RprL97HJs'
        ],
        'edit-video-clip': [
            '90OnAT9ELks'
        ],
        'just-visual-concept': [
            '9PfPgOhJJaA'
        ],
        'amv': [
            'aEFW1vrqyBg'
        ]
    };

    let currentTipoVisual = 'lyric-con-portada'; // Tipo de visual por defecto
    let currentVideoIndexRestoVisuales = 0;

    // Función para actualizar el video en el contenedor de resto de visuales
    function updateVideoRestoVisuales() {
        const iframe = document.getElementById('playerRestoVisuales');
        iframe.src = `https://www.youtube.com/embed/${videosPorTipo[currentTipoVisual][currentVideoIndexRestoVisuales]}`;
    }

    // Función para cambiar la imagen según el tipo de visual
    function updateImageRestoVisuales() {
        const images = {
            'lyric-con-portada': document.getElementById('imagenLyricPro'),
            'lyric-simple': document.getElementById('imagenLyricSimple'),
            'edit-video-clip': document.getElementById('imagenVideoClip'),
            'just-visual-concept': document.getElementById('imagenConcept'),
            'amv': document.getElementById('imagenAMV')
        };

        // Ocultar todas las imágenes
        Object.values(images).forEach(img => img.style.display = 'none');

        // Mostrar la imagen correspondiente al tipo de visual actual
        images[currentTipoVisual].style.display = 'block';
    }

    // Eventos para las flechas
    document.getElementById('nextVideoRestoVisuales').addEventListener('click', () => {
        currentVideoIndexRestoVisuales = (currentVideoIndexRestoVisuales + 1) % videosPorTipo[currentTipoVisual].length;
        updateVideoRestoVisuales();
    });

    document.getElementById('prevVideoRestoVisuales').addEventListener('click', () => {
        currentVideoIndexRestoVisuales = (currentVideoIndexRestoVisuales - 1 + videosPorTipo[currentTipoVisual].length) % videosPorTipo[currentTipoVisual].length;
        updateVideoRestoVisuales();
    });

    // Cambiar el tipo de visual
    document.querySelectorAll('.menu-lateral a').forEach(enlace => {
        enlace.addEventListener('click', (e) => {
            e.preventDefault();
            const tipo = e.target.getAttribute('data-tipo');
            currentTipoVisual = tipo;
            currentVideoIndexRestoVisuales = 0; // Reiniciar el índice del video
            updateVideoRestoVisuales();
            updateImageRestoVisuales(); // Actualizar la imagen
        });
    });

    // Inicializar el primer video y la imagen
    updateVideoRestoVisuales();
    updateImageRestoVisuales();

    // Evento para el rectángulo de Precio/Información (3D)
    document.getElementById('infoRectangle3D').addEventListener('click', async () => {
        const precioBaseMXN = 800.00; // Precio base en MXN para 3D
        const precioEscenarioMXN = 100.00; // Precio en MXN por escenario adicional
        const precioPersonajeMXN = 150.00; // Precio en MXN por personaje adicional

        // Obtener la moneda local y la tasa de cambio
        const monedaLocal = window.preciosConvertidos?.monedaLocal || 'MXN';
        const tasaCambio = await getExchangeRate(monedaLocal);

        // Convertir los precios a la moneda local
        const precioBaseConvertido = (precioBaseMXN * tasaCambio).toFixed(2);
        const precioEscenarioConvertido = (precioEscenarioMXN * tasaCambio).toFixed(2);
        const precioPersonajeConvertido = (precioPersonajeMXN * tasaCambio).toFixed(2);

        Swal.fire({
            title: '<strong>3D Visualizer</strong>',
            html: `
                <p style="font-size: 18px; margin: 10px 0;"><strong>PRECIO: ${precioBaseConvertido} ${monedaLocal}</strong></p>
                <p style="font-size: 14px; margin: 10px 0;"><strong>Detalles:</strong></p>
                <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                    <li>Modelos creados desde cero</li>
                    <li>100% modelado para usted (Sin reutilización en proyectos ajenos)</li>
                    <li>Gráficos de primera calidad (renderización con OctaneRender)</li>
                </ul>
                <p style="font-size: 14px; margin: 10px 0;"><strong>¿Qué contiene?</strong></p>
                <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                    <li>1. Máximo 3 escenarios/escenas</li>
                    <li>2. Máximo 2 personajes modelados</li>
                    <li>3. Efectos visuales en AE ilimitados</li>
                </ul>
                <p style="font-size: 14px; margin: 10px 0;"><strong>¿Necesitas más escenarios/personajes?</strong></p>
                <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                    <li>El precio por +1 escenario es de ${precioEscenarioConvertido} ${monedaLocal}</li>
                    <li>El precio por +1 personaje es de ${precioPersonajeConvertido} ${monedaLocal}</li>
                </ul>
            `,
            icon: 'info',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                htmlContainer: 'custom-swal-html',
                confirmButton: 'custom-swal-button'
            }
        });
    });

    // Evento para el rectángulo de Precio/Información (Pixel Art)
    document.getElementById('infoRectanglePixelArt').addEventListener('click', async () => {
        const precioPixelArt64x64MXN = 600.00; // Precio en MXN para Pixel Art 64x64
        const precioPixelArt128x128MXN = 750.00; // Precio en MXN para Pixel Art 128x128
        const precioPixelArtEscenarioMXN = 120.00; // Precio en MXN por escenario adicional
        const precioPixelArtObjetoMXN = 130.00; // Precio en MXN por objeto adicional
        const precioPixelArtPersonajeMXN = 150.00; // Precio en MXN por personaje adicional

        // Obtener la moneda local y la tasa de cambio
        const monedaLocal = window.preciosConvertidos?.monedaLocal || 'MXN';
        const tasaCambio = await getExchangeRate(monedaLocal);

        // Convertir los precios a la moneda local
        const precioPixelArt64x64Convertido = (precioPixelArt64x64MXN * tasaCambio).toFixed(2);
        const precioPixelArt128x128Convertido = (precioPixelArt128x128MXN * tasaCambio).toFixed(2);
        const precioPixelArtEscenarioConvertido = (precioPixelArtEscenarioMXN * tasaCambio).toFixed(2);
        const precioPixelArtObjetoConvertido = (precioPixelArtObjetoMXN * tasaCambio).toFixed(2);
        const precioPixelArtPersonajeConvertido = (precioPixelArtPersonajeMXN * tasaCambio).toFixed(2);

        Swal.fire({
            title: '<strong>Pixel Art Visual</strong>',
            html: `
                <p style="font-size: 18px; margin: 10px 0;"><strong>PRECIO: ${precioPixelArt64x64Convertido} ${monedaLocal} (64x64)</strong></p>
                <p style="font-size: 18px; margin: 10px 0;"><strong>PRECIO: ${precioPixelArt128x128Convertido} ${monedaLocal} (128x128)</strong></p>
                <p style="font-size: 14px; margin: 10px 0;"><strong>Detalles:</strong></p>
                <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                    <li>Pixel Art creados desde cero</li>
                    <li>100% diseñado para usted (Sin reutilización en proyectos ajenos)</li>
                    <li>Los personajes pueden tener cualquier diseño y todo tipo de detalles</li>
                    <li>Nota: Los objetos son aparte de los escenarios.</li>
                </ul>
                <p style="font-size: 14px; margin: 10px 0;"><strong>¿Qué contiene?</strong></p>
                <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                    <li>1. Máximo 1 escenario/escena</li>
                    <li>2. Máximo 2 personajes</li>
                    <li>3. Máximo 3 Objetos (Ej: Carro)</li>
                    <li>4. Efectos visuales en AE ilimitados</li>
                </ul>
                <p style="font-size: 14px; margin: 10px 0;"><strong>¿Necesitas más escenarios/personajes/objetos?</strong></p>
                <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                    <li>El precio por +1 escenario es de ${precioPixelArtEscenarioConvertido} ${monedaLocal}</li>
                    <li>El precio por +1 objeto es de ${precioPixelArtObjetoConvertido} ${monedaLocal}</li>
                    <li>El precio por +1 personaje es de ${precioPixelArtPersonajeConvertido} ${monedaLocal}</li>
                </ul>
            `,
            icon: 'info',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                htmlContainer: 'custom-swal-html',
                confirmButton: 'custom-swal-button'
            }
        });
    });

    // Evento para el rectángulo de Precio/Información (Resto de Visuales)
    document.getElementById('infoRectangleRestoVisuales').addEventListener('click', async () => {
        let precioMXN, detalles;

        // Definir precios en MXN y detalles según el tipo de visual
        switch (currentTipoVisual) {
            case 'lyric-con-portada':
                precioMXN = 300.00;
                detalles = `
                    <p style="font-size: 14px; margin: 10px 0;"><strong>Detalles:</strong></p>
                    <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                        <li>Incluye la portada del álbum o single como elemento principal del video.</li>
                        <li>La portada puede ser estática o animada.</li>
                        <li>Texto de la canción sincronizado con el audio.</li>
                        <li>Estilo de letras personalizable (fuente, color, tamaño y animación).</li>
                        <li>Elección de colores y temática acorde al estilo de la canción.</li>
                        <li>Posibilidad de agregar imágenes adicionales o videos de fondo.</li>
                        <li>Efectos visuales ilimitados.</li>
                    </ul>
                    <p style="font-size: 14px; margin: 10px 0;"><strong>NOTA:</strong> Se permiten hasta 2 revisiones para ajustar detalles finales.</p>
                `;
                break;
            case 'lyric-simple':
                precioMXN = 100.00;
                detalles = `
                    <p style="font-size: 14px; margin: 10px 0;"><strong>Detalles:</strong></p>
                    <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                        <li>Fondo visual estático o dinámico.</li>
                        <li>Texto de la canción sincronizado con el audio.</li>
                        <li>Estilo de letras personalizable (fuente, color, tamaño y animación).</li>
                        <li>Elección de colores y temática acorde al estilo de la canción.</li>
                        <li>Posibilidad de agregar imágenes adicionales o videos de fondo.</li>
                        <li>Efectos visuales ilimitados.</li>
                    </ul>
                `;
                break;
            case 'edit-video-clip':
                precioMXN = 500.00;
                detalles = `
                    <p style="font-size: 14px; margin: 10px 0;"><strong>Detalles:</strong></p>
                    <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                        <li>Efectos visuales avanzados:</li>
                        <ul>
                            <li>Corrección de color profesional (ajuste de tonos, brillo, contraste y saturación).</li>
                            <li>Corrección de tomas.</li>
                            <li>Overlays creativos (texturas).</li>
                            <li>Los efectos más modernos y comerciales.</li>
                        </ul>
                        <li>Efectos visuales ilimitados.</li>
                    </ul>
                `;
                break;
            case 'just-visual-concept':
                precioMXN = 150.00;
                detalles = `
                    <p style="font-size: 14px; margin: 10px 0;"><strong>Detalles:</strong></p>
                    <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                        <li>Puede contener o no lyric.</li>
                        <li>Creación de una atmósfera visual que complemente el estilo y mood de la música.</li>
                        <li>Transiciones creativas entre escenas (fundidos, cortes rápidos, efectos de distorsión, etc.).</li>
                        <li>Overlays de luz, sombras y texturas para agregar profundidad.</li>
                        <li>Uso de imágenes o videos temáticos (naturaleza, ciudad, tecnología, etc.).</li>
                        <li>Inclusión de logos, marcas de agua o elementos de identidad visual (opcional).</li>
                        <li>Efectos visuales ilimitados.</li>
                    </ul>
                    <p style="font-size: 14px; margin: 10px 0;"><strong>MODELO 3D (OPCIONAL SI SE DESEA INTEGRAR):</strong></p>
                    <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                        <li>Costo adicional:</li>
                        <ul>
                            <li>+1 RENDER 100.00 MXN. (objetos, figuras, escenarios).</li>
                            <li>+1 RENDER DE PERSONA 300.00 MXN.</li>
                        </ul>
                    </ul>
                `;
                break;
            case 'amv':
                precioMXN = 100.00;
                detalles = `
                    <p style="font-size: 14px; margin: 10px 0;"><strong>Detalles:</strong></p>
                    <ul style="text-align: left; font-size: 14px; margin: 10px 0;">
                        <li>Cualquier serie (películas, animes, animaciones, etc.).</li>
                        <li>Se pueden combinar entre varias series.</li>
                        <li>Efectos visuales ilimitados.</li>
                    </ul>
                `;
                break;
            default:
                precioMXN = 0.00;
                detalles = '';
        }

        // Obtener la moneda local y la tasa de cambio
        const monedaLocal = window.preciosConvertidos?.monedaLocal || 'MXN';
        const tasaCambio = await getExchangeRate(monedaLocal);

        // Convertir el precio a la moneda local
        const precioConvertido = (precioMXN * tasaCambio).toFixed(2);

        Swal.fire({
            title: `<strong>${currentTipoVisual.toUpperCase()}</strong>`,
            html: `
                <p style="font-size: 18px; margin: 10px 0;"><strong>PRECIO: ${precioConvertido} ${monedaLocal}</strong></p>
                ${detalles}
            `,
            icon: 'info',
            confirmButtonText: 'Aceptar',
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                htmlContainer: 'custom-swal-html',
                confirmButton: 'custom-swal-button'
            }
        });
    });
</script>