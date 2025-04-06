<header>
    <link rel="icon" href="img/Logos/LogoDankiel.jpg" type="image/jpg">
    <div class="header" id="main-header">
        <div class="logo">
            <a href="" class="logo1"><img src="img/Logos/ShotByDankiel.jpg" alt="Logo 1"/></a>
            <a href="" class="logo2"><img id="logo2" src="img/Logos/LogoDankiel.jpg" alt="Logo 2"/></a>
            <a href="" class="logo3"><img id="logo3" src="img/Logos/LogoBlackGengar.jpg" alt="Logo 3"/></a>
        </div>
        <div class="firmas">
            <a href="" class="firma1"><img src="img/Firmas/FirmaDankiel.jpg" alt="Firma 1"/></a>
            <a href="" class="firma2"><img src="img/Firmas/FirmaBlackGengar.jpg" alt="Firma 2"/></a>
        </div>
        <div class="menu">
            <ul class="nav" id="nav">
                <li><a href="index.php">INICIO</a></li>
                <li><a href="">VISUALES</a></li>
                <li><a href="Vdk.php">SHOT BY VDK</a></li>
                <li class="dropdown">
                    <a href="ropa.php">MARCA DE ROPA</a>
                    <ul class="dropdown-menu">
                        <li><a href="novedades.php">Lo Nuevo</a></li>
                        <li><a href="hombre.php">Hombre</a></li>
                        <li><a href="mujer.php">Mujer</a></li>
                        <li><a href="peluches.php">Peluches</a></li>
                        <li><a href="llaveros.php">Llaveros</a></li>
                        <li><a href="exclusivos.php">Productos Exclusivos</a></li>
                    </ul>
                </li>
            </ul>
            <div id="user-info"> <!-- Aquí se actualizará dinámicamente la información del usuario -->
            </div>
        </div>
    </div>

    <script>
        // Función para manejar el efecto de hover en los logos
        function setupLogoHover(logoId, gifPath) {
            const logo = document.getElementById(logoId);

            // Guardar el tamaño original de la imagen
            const originalWidth = logo.clientWidth;
            const originalHeight = logo.clientHeight;

            // Cambiar la imagen al pasar el cursor
            logo.addEventListener('mouseover', function() {
                this.src = gifPath;
                // Aplicar el tamaño original al GIF
                this.style.width = `${originalWidth}px`;
                this.style.height = `${originalHeight}px`;
            });

            // Restaurar la imagen al quitar el cursor
            logo.addEventListener('mouseout', function() {
                this.src = `img/Logos/${logoId === 'logo2' ? 'LogoDankiel.jpg' : 'LogoBlackGengar.jpg'}`;
                // Restaurar el tamaño original al JPG
                this.style.width = `${originalWidth}px`;
                this.style.height = `${originalHeight}px`;
            });
        }

        // Configurar el efecto de hover para ambos logos
        setupLogoHover('logo2', 'img/Animacion/Cabeza.gif'); // Para LogoDankiel.jpg
        setupLogoHover('logo3', 'img/Animacion/CabezaBlackGengar.gif'); // Para LogoBlackGengar.jpg
    </script>
</header>