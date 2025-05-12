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

function handleCredentialResponse(user) {
    fetch('sessionManagerVDK.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=login&email=${user.email}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.loggedIn) {
            Swal.fire({
                title: '¡Inicio de sesión exitoso!',
                text: `Bienvenido ${data.username}`,
                icon: 'success',
                confirmButtonText: 'Continuar'
            }).then(() => {
                window.location.reload();
            });
        }
    });
}

function signInWithGoogle() {
    const provider = new GoogleAuthProvider();
    signInWithPopup(auth, provider)
        .then(result => {
            handleCredentialResponse(result.user);
        })
        .catch(error => {
            console.error(error);
            Swal.fire({
                title: 'Error',
                text: 'No se pudo iniciar sesión con Google',
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
        })
        .then(() => {
            Swal.fire({
                title: 'Sesión cerrada',
                text: 'Has cerrado sesión correctamente',
                icon: 'success',
                confirmButtonText: 'Entendido'
            }).then(() => {
                window.location.reload();
            });
        });
    }).catch(error => {
        console.error(error);
        Swal.fire({
            title: 'Error',
            text: 'No se pudo cerrar la sesión',
            icon: 'error',
            confirmButtonText: 'Entendido'
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    fetch('sessionManagerVDK.php')
        .then(response => response.json())
        .then(data => {
            const userInfo = document.getElementById('user-info');
            if (data.loggedIn) {
                userInfo.innerHTML = `
                    <span class="user-info me-3">@${data.username}</span>
                    <button id="google-logout" class="btn btn-danger">Cerrar Sesión</button>
                `;
                document.getElementById('google-logout').addEventListener('click', signOutUser);
            } else {
                userInfo.innerHTML = `
                    <div class="login-container">
                        <h2 class="mb-4">Iniciar Sesión</h2>
                        <button id="google-connect" class="btn btn-primary">
                            <i class="bi bi-google me-2"></i> Continuar con Google
                        </button>
                    </div>
                `;
                document.getElementById('google-connect').addEventListener('click', signInWithGoogle);
            }
        });
});