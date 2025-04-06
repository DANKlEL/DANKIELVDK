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
    fetch('sessionManager.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=login&email=${user.email}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.loggedIn) {
            updateHeaderForLoggedInUser(data.username);
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
        });
}

function signOutUser() {
    signOut(auth).then(() => {
        fetch('sessionManager.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=logout'
        })
        .then(() => {
            updateHeaderForLoggedOutUser();
        });
    }).catch(error => {
        console.error(error);
    });
}

function updateHeaderForLoggedInUser(username) {
    const userInfo = document.getElementById('user-info');
    userInfo.innerHTML = `
        <span class="user-info">@${username}</span>
        <i class="fas fa-shopping-cart"></i>
        <i class="fas fa-user"></i>
        <button id="google-logout" class="btn btn-primary">Cerrar Sesión</button>
    `;
    document.getElementById('google-logout').addEventListener('click', signOutUser);
}

function updateHeaderForLoggedOutUser() {
    const userInfo = document.getElementById('user-info');
    userInfo.innerHTML = '<button id="google-connect" class="btn btn-primary">Conectar con Google</button>';
    document.getElementById('google-connect').addEventListener('click', signInWithGoogle);
}

document.addEventListener('DOMContentLoaded', () => {
    fetch('sessionManager.php')
        .then(response => response.json())
        .then(data => {
            if (data.loggedIn) {
                updateHeaderForLoggedInUser(data.username);
            } else {
                updateHeaderForLoggedOutUser();
            }
        });
});
