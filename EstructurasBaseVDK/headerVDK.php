<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="headerVDK.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <title>Header VDK</title>
</head>
<body>
    <header class="header initial-hidden" id="main-header">
        <!-- Header Superior -->
        <div class="header-top">
            <!-- Menú Hamburguesa y Lupa -->
            <div class="menu-search">
                <div class="menu-icon">
                    <i class="bi bi-list"></i>
                </div>
                <div class="search-icon">
                    <i class="bi bi-search"></i>
                </div>
            </div>

            <!-- Logo en el Centro -->
            <div class="logo">
                <a href="#">
                    <img src="Img\Vdk\vdkHeader.png" alt="VDK Logo">
                </a>
            </div>

            <!-- Íconos de Usuario y Compras -->
            <div class="user-icons">
                <a href="#"><i class="bi bi-person"></i></a>
                <a href="#"><i class="bi bi-bag"></i></a>
            </div>
        </div>

        <!-- Línea Divisoria -->
        <div class="header-divider"></div>

        <!-- Submenú -->
        <nav class="submenu">
            <ul>
                <li><a href="#">Portafolio</a></li>
                <li class="dropdown">
                    <a href="#">Recursos <i class="bi bi-chevron-down"></i></a>
                    <div class="dropdown-menu">
                        <div class="dropdown-column">
                            <a href="#">Creación de Visuales</a>
                            <a href="#">Recursos para Edición y Diseño</a>
                            <a href="#">Modelado y Animación 3D</a>
                        </div>
                        <div class="dropdown-column">
                            <a href="#">Servicios de Branding y Diseño</a>
                            <a href="#">Cursos/Talleres</a>
                            <a href="#">Paquetes Exclusivos</a>
                        </div>
                    </div>
                </li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <!-- Menú de Búsqueda (oculto por defecto) -->
    <div class="search-menu">
        <input type="text" placeholder="Enter a keyword">
    </div>
</body>
</html>