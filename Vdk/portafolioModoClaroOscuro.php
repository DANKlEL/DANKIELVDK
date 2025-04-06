<?php
// portafolioModoClaroOscuro.php
?>

<!-- Encabezado del popup con botón de modo -->
<div class="popup-encabezado">
  <button id="toggle-mode" class="mode-toggle">
    <svg class="moon-icon" viewBox="0 0 24 24">
      <path fill="currentColor" d="M12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18M20,15.31L23.31,12L20,8.69V4H15.31L12,0.69L8.69,4H4V8.69L0.69,12L4,15.31V20H8.69L12,23.31L15.31,20H20V15.31Z"/>
    </svg>
    <svg class="sun-icon" viewBox="0 0 24 24" style="display:none;">
      <path fill="currentColor" d="M3.55,18.54L4.96,19.95L6.76,18.16L5.34,16.74M11,22.45C11.32,22.45 13,22.45 13,22.45V19.5H11M12,5.5A6,6 0 0,0 6,11.5A6,6 0 0,0 12,17.5A6,6 0 0,0 18,11.5A6,6 0 0,0 12,5.5M20,12.5H23V10.5H20M17.24,18.16L19.04,19.95L20.45,18.54L18.66,16.74M20.45,6.46L19.04,5.05L17.24,6.84L18.66,8.26M6.76,6.84L4.96,5.05L3.55,6.46L5.34,8.26L6.76,6.84M12,0.55H13V3.5H12M1,11.5H4V13.5H1M12,8.5A3,3 0 0,1 15,11.5A3,3 0 0,1 12,14.5A3,3 0 0,1 9,11.5A3,3 0 0,1 12,8.5Z"/>
    </svg>
  </button>
  <button id="cerrar-popup" class="cerrar-popup">X</button>
</div>

<style>
/* Variables CSS para los modos */
:root {
  --color-fondo: #1a1a1a;
  --color-texto: #ffffff;
  --color-texto-claro: #333333; /* Nuevo: para texto en modo claro */
  --color-primario: #a91313;
  --color-secundario: #333333;
  --color-borde: #444444;
  --color-fondo-claro: #ffffff;
  --color-contenedor: #1a1a1a;
  --color-contenedor-claro: #ffffff;
}

/* Estilos para el modo claro/nocturno */
.popup-encabezado {
  display: flex;
  justify-content: space-between;
  padding: 15px;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: 10;
}

.mode-toggle {
  background-color: var(--color-primario);
  border: none;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
  z-index: 11;
  margin-right: auto;
}

.mode-toggle:hover {
  transform: scale(1.1);
}

.mode-toggle svg {
  width: 20px;
  height: 20px;
  fill: white;
}

.cerrar-popup {
  background-color: var(--color-primario);
  color: white;
  border: none;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  cursor: pointer;
  font-size: 16px;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: all 0.3s ease;
  z-index: 11;
  margin-left: auto;
}

/* Estilos para el modo claro */
body.light-mode {
  background-color: var(--color-fondo-claro);
  color: var(--color-texto-claro);
  --color-contenedor: #ffffff;
}

body.light-mode .popup-contenido,
body.light-mode .contenido-dinamico,
body.light-mode .categoria-content,
body.light-mode .vista-boton,
body.light-mode .flecha-navegacion {
  background-color: var(--color-contenedor-claro);
  color: var(--color-texto-claro);
  border-color: var(--color-borde);
}

body.light-mode .categoria-btn.active,
body.light-mode .vista-boton.active {
  background-color: var(--color-primario);
  color: white;
}

body.light-mode .logo-red-social {
  filter: brightness(0) invert(0);
}

/* Nuevo: Estilo para el texto del nombre en modo claro */
body.light-mode .nombre-perfil h1,
body.light-mode .nombre-animado span {
  color: var(--color-texto-claro);
}
</style>

<script>
// Función para manejar el modo claro/oscuro
function setupModoClaroOscuro() {
    const toggleMode = document.getElementById('toggle-mode');
    const moonIcon = toggleMode.querySelector('.moon-icon');
    const sunIcon = toggleMode.querySelector('.sun-icon');
    const body = document.body;
    
    // Verificar preferencia del sistema
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const savedMode = localStorage.getItem('portfolio-mode');
    
    // Aplicar modo inicial
    if (savedMode === 'light' || (!savedMode && !prefersDark)) {
        body.classList.add('light-mode');
        moonIcon.style.display = 'none';
        sunIcon.style.display = 'block';
        
        // Cambiar logos a versión negra
        document.querySelectorAll('.youtube-logo').forEach(img => {
            img.src = img.src.replace('Blanco', 'Negro');
        });
        document.querySelectorAll('.instagram-logo').forEach(img => {
            img.src = img.src.replace('Blanco', 'Negro');
        });
    }
    
    // Alternar modo
    toggleMode.addEventListener('click', function() {
        body.classList.toggle('light-mode');
        const isLight = body.classList.contains('light-mode');
        
        moonIcon.style.display = isLight ? 'none' : 'block';
        sunIcon.style.display = isLight ? 'block' : 'none';
        
        // Guardar preferencia
        localStorage.setItem('portfolio-mode', isLight ? 'light' : 'dark');
        
        // Cambiar logos de redes sociales
        const youtubeLogos = document.querySelectorAll('.youtube-logo');
        const instagramLogos = document.querySelectorAll('.instagram-logo');
        
        if (isLight) {
            youtubeLogos.forEach(img => img.src = img.src.replace('Blanco', 'Negro'));
            instagramLogos.forEach(img => img.src = img.src.replace('Blanco', 'Negro'));
        } else {
            youtubeLogos.forEach(img => img.src = img.src.replace('Negro', 'Blanco'));
            instagramLogos.forEach(img => img.src = img.src.replace('Negro', 'Blanco'));
        }
    });
}

// Función para manejar el cierre del popup
function setupCierrePopup() {
    const cerrarPopup = document.getElementById('cerrar-popup');
    const popup = document.getElementById('popup');

    cerrarPopup.addEventListener('click', () => {
        Swal.fire({
            title: "¿Cerrar el portafolio?",
            text: "¿Estás seguro de que quieres cerrar esta ventana?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#a91313",
            cancelButtonColor: "#555",
            confirmButtonText: "Sí, cerrar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                popup.style.display = "none";
            }
        });
    });

    popup.addEventListener('click', (event) => {
        if (event.target === popup) {
            popup.style.display = "none";
        }
    });
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    setupModoClaroOscuro();
    setupCierrePopup();
});
</script>