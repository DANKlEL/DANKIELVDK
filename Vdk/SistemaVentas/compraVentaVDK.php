<?php
session_start();

// Función para verificar si el cliente tiene solicitudes
function tieneSolicitudes($email) {
    try {
        $db = new PDO('sqlite:solicitudes.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $db->prepare("SELECT COUNT(*) FROM solicitudes WHERE clienteEmail = ?");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        
        return $count > 0;
    } catch(PDOException $e) {
        error_log("Error al verificar solicitudes: " . $e->getMessage());
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Videos Musicales</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
        }
        .btn-google {
            background-color: #4285F4;
            color: white;
            font-weight: 500;
        }
        .logo {
            width: 120px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if(isset($_SESSION['username'])): ?>
            <!-- Mostrar spinner mientras verifica -->
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Verificando...</span>
                </div>
                <p class="mt-3">Verificando tus solicitudes</p>
            </div>
            
            <script>
                // Verificación inmediata al cargar
                window.onload = function() {
                    // Hacer una petición al servidor para verificar solicitudes
                    fetch('verificarSolicitud.php')
                        .then(response => response.json())
                        .then(data => {
                            if (data.tieneSolicitud) {
                                window.location.href = 'procesoAprobadoVDK.php';
                            } else {
                                Swal.fire({
                                    title: 'Sin solicitudes',
                                    text: 'No encontramos solicitudes asociadas a tu cuenta',
                                    icon: 'info',
                                    confirmButtonText: 'Entendido'
                                }).then(() => {
                                    window.location.href = 'cerrarSesion.php';
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Hubo un problema al verificar tus solicitudes',
                                icon: 'error',
                                confirmButtonText: 'Entendido'
                            }).then(() => {
                                window.location.href = 'cerrarSesion.php';
                            });
                        });
                };
            </script>
            
        <?php else: ?>
            <!-- Pantalla de login -->
            <div class="login-container">
                <img src="img/logo.png" alt="Logo" class="logo">
                <h2 class="mb-4">Acceso Clientes</h2>
                <p class="mb-4">Inicia sesión para gestionar tus solicitudes de video</p>
                <button id="google-connect" class="btn btn-google w-100 py-2">
                    <i class="bi bi-google me-2"></i> Iniciar con Google
                </button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Firebase Auth -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.4/firebase-app.js";
        import { getAuth, signInWithPopup, GoogleAuthProvider } from "https://www.gstatic.com/firebasejs/10.12.4/firebase-auth.js";

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
        const provider = new GoogleAuthProvider();

        document.getElementById('google-connect').addEventListener('click', () => {
            signInWithPopup(auth, provider)
                .then((result) => {
                    const user = result.user;
                    
                    // Guardar en sesión PHP
                    return fetch('sessionManagerVDK.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=login&email=${user.email}`
                    });
                })
                .then(response => response.json())
                .then(data => {
                    if(data.loggedIn) {
                        window.location.reload(); // Recarga para verificar solicitudes
                    }
                })
                .catch((error) => {
                    Swal.fire({
                        title: 'Error',
                        text: error.message,
                        icon: 'error'
                    });
                });
        });
    </script>
</body>
</html>