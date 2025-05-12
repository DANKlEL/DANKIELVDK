<?php
session_start();

// Lista blanca de correos permitidos
$allowedEmails = ["infodankiel@gmail.com", "ddoxus.15@gmail.com@gmail.com", "verake@gmail.com"];

// Verificar si el usuario logueado tiene acceso
if (isset($_SESSION['username']) && !in_array($_SESSION['username'], $allowedEmails)) {
    session_destroy();
    setcookie(session_name(), '', time() - 3600);
    unset($_SESSION['username']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Nuestro CSS personalizado -->
    <link rel="stylesheet" href="CompraVentaVDK.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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
        .nav-tabs .nav-link.active {
            font-weight: bold;
            background-color: #f8f9fa;
            border-bottom-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container d-flex flex-column min-vh-100">
        <!-- Barra de navegación superior -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <i class="bi bi-shield-lock"></i> Panel Admin
                </a>
                <div id="user-info" class="ms-auto">
                    <?php if(isset($_SESSION['username']) && in_array($_SESSION['username'], $allowedEmails)): ?>
                        <span class="text-white me-3">ADMIN: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <button id="google-logout" class="btn btn-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Salir
                        </button>
                    <?php else: ?>
                        <button id="google-connect" class="btn btn-light btn-sm">
                            <i class="bi bi-google me-1"></i> Login Admin
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <!-- Contenido principal -->
        <div class="flex-grow-1">
            <?php if(isset($_SESSION['username']) && in_array($_SESSION['username'], $allowedEmails)): ?>
                <div class="admin-panel">
                    <div class="alert alert-success">
                        <h4><i class="bi bi-shield-lock me-2"></i> Acceso autorizado como administrador</h4>
                        <p class="mb-0">Tienes privilegios administrativos completos.</p>
                    </div>

                    <!-- Pestañas de administración -->
                    <div class="admin-functions mt-4">
                        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="crear-tab" data-bs-toggle="tab" data-bs-target="#crear" type="button" role="tab">
                                    <i class="bi bi-file-earmark-plus"></i> Crear Solicitud
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="gestionar-tab" data-bs-toggle="tab" data-bs-target="#gestionar" type="button" role="tab">
                                    <i class="bi bi-list-check"></i> Gestionar Solicitudes
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-3 border border-top-0 rounded-bottom">
                            <div class="tab-pane fade show active" id="crear" role="tabpanel">
                                <?php include 'AdminCrearSolicitud.php'; ?>
                            </div>
                            <div class="tab-pane fade" id="gestionar" role="tabpanel">
                                <?php include 'AdminGestionarSolicitud.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="login-container mx-auto" style="max-width: 400px;">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white text-center">
                            <h3><i class="bi bi-shield-lock"></i> Acceso Administrativo</h3>
                        </div>
                        <div class="card-body text-center p-4">
                            <p class="mb-4">Esta área es exclusiva para administradores autorizados.</p>
                            <button id="google-connect" class="btn btn-primary">
                                <i class="bi bi-google me-2"></i> Autenticar con Google
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pie de página -->
        <footer class="mt-4 py-3 text-center text-muted border-top">
            <small>Sistema de gestión de solicitudes &copy; <?= date('Y') ?></small>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Firebase y Auth -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.4/firebase-app.js";
        import { getAuth, signInWithPopup, GoogleAuthProvider, signOut } from "https://www.gstatic.com/firebasejs/10.12.4/firebase-auth.js";

        const firebaseConfig = {
            apiKey: "AIzaSyBURRw2WAG-xQhVoq9r7k6lPIjWU5AXo3s",
            authDomain: "dankielito-d98f7.firebaseapp.com",
            projectId: "dankielito-d98f7",
            storageBucket: "dankielito-d98f7.appspot.com",
            messagingSenderId: "1077039642354",
            appId: "1:1077039642354:web:bc3e78628f3c19acb6826b",
            measurementId: "G-X5DJ4C5BWF"
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth();
        const allowedEmails = ["infodankiel@gmail.com", "ddxous@gmail.com", "verake@gmail.com"];

        async function handleAdminAuth(user) {
            const response = await fetch('sessionManagerVDK.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=login&email=${user.email}`
            });
            const data = await response.json();
            
            if (data.loggedIn) {
                if (allowedEmails.includes(user.email)) {
                    Swal.fire({
                        title: 'Acceso concedido',
                        text: `Bienvenido Administrador ${user.email}`,
                        icon: 'success',
                        confirmButtonText: 'Continuar'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    // Cerrar sesión si no está autorizado
                    await signOut(auth);
                    await fetch('sessionManagerVDK.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'action=logout'
                    });
                    
                    Swal.fire({
                        title: 'Acceso denegado',
                        text: 'No tienes permisos administrativos',
                        icon: 'error',
                        confirmButtonText: 'Entendido'
                    }).then(() => {
                        window.location.reload();
                    });
                }
            }
        }

        function signInWithGoogle() {
            const provider = new GoogleAuthProvider();
            signInWithPopup(auth, provider)
                .then(result => {
                    handleAdminAuth(result.user);
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al autenticar con Google',
                        icon: 'error',
                        confirmButtonText: 'Entendido'
                    });
                });
        }

        function signOutUser() {
            signOut(auth).then(() => {
                fetch('sessionManagerVDK.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=logout'
                }).then(() => {
                    window.location.href = 'compraVentaVDK.php';
                });
            }).catch(error => {
                console.error(error);
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Manejar botones de login/logout
            const connectButton = document.getElementById('google-connect');
            if (connectButton) {
                connectButton.addEventListener('click', signInWithGoogle);
            }

            const logoutButton = document.getElementById('google-logout');
            if (logoutButton) {
                logoutButton.addEventListener('click', signOutUser);
            }

            // Inicializar pestañas si existen
            if (document.getElementById('adminTabs')) {
                new bootstrap.Tab(document.querySelector('#adminTabs li:first-child button')).show();
            }
        });
    </script>
</body>
</html>