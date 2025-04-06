// Variables para el reproductor principal
let player;
let progressBar = document.getElementById("progressBar");
let currentTimeEl = document.getElementById("currentTime");
let totalTimeEl = document.getElementById("totalTime");
let isPlaying = false; // Variable para controlar el estado de reproducción (pausado o en reproducción)

// Variables para el video de fondo
let backgroundPlayer;

// Lista de videos para el reproductor principal
const videoIds = [
    "fdtGIXlSBYU",
    "q-FcxH8VitQ",
    "aEFW1vrqyBg",
    "yCIsKctKyyk",
    "kSxN_uQF5EY",
    "q2YLSjHLPeY",
    "gmlt0TecTZE"
];

let currentVideoIndex = 0;
let lastUpdateTime = 0; // Tiempo de la última actualización de la barra de progreso

// Función para inicializar el reproductor principal
function onYouTubeIframeAPIReady() {
    // Inicializar el reproductor principal
    player = new YT.Player("player", {
        height: "400",
        width: "700",
        videoId: videoIds[currentVideoIndex],
        playerVars: {
            "autoplay": 0, // Desactivar autoplay
            "controls": 0, // Desactivar controles predeterminados
            "showinfo": 0,  // Ocultar información de video
            "modestbranding": 1, // Minimizar branding de YouTube
            "rel": 0, // Evitar videos relacionados después de terminar
            "iv_load_policy": 3 // Cargar solo miniatura del video
        },
        events: {
            "onReady": onPlayerReady,
            "onStateChange": onPlayerStateChange
        }
    });

    // Inicializar el reproductor de fondo
    backgroundPlayer = new YT.Player("backgroundVideo", {
        videoId: "fdtGIXlSBYU",
        playerVars: {
            "autoplay": 1,
            "controls": 0,
            "loop": 1,
            "playlist": "fdtGIXlSBYU", // Necesario para el loop
            "start": 134, // Inicia en 2:14 (134 segundos)
            "end": 145, // Termina en 2:25 (145 segundos)
            "mute": 1, // Muteado para que no interfiera con otros sonidos
            "modestbranding": 1,
            "rel": 0,
            "showinfo": 0
        },
        events: {
            "onReady": onBackgroundPlayerReady,
            "onStateChange": onBackgroundPlayerStateChange
        }
    });
}

// Funciones para el reproductor principal
function onPlayerReady(event) {
    updateTotalTime();
    updateProgressBar();
    player.pauseVideo(); // Aseguramos que el video esté en pausa cuando se carga
    player.seekTo(0); // Nos aseguramos de que esté al principio del video
}

function onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.PLAYING) {
        isPlaying = true;
        updateProgressBar();
    } else if (event.data === YT.PlayerState.PAUSED) {
        isPlaying = false;
        updateProgressBar();
    }
}

function updateProgressBar() {
    if (player && player.getDuration) {
        let duration = player.getDuration();
        totalTimeEl.textContent = formatTime(duration);

        // Solo actualizamos si el video está en reproducción y la diferencia en el tiempo es significativa
        if (isPlaying) {
            let currentTime = player.getCurrentTime();
            let progress = (currentTime / duration) * 100;
            progressBar.value = progress;
            currentTimeEl.textContent = formatTime(currentTime);
            
            // Utilizamos requestAnimationFrame para una actualización más eficiente y suave
            requestAnimationFrame(updateProgressBar);
        }
    }
}

progressBar.addEventListener("input", function () {
    let duration = player.getDuration();
    let seekToTime = (progressBar.value / 100) * duration;
    player.seekTo(seekToTime, true);
});

function updateTotalTime() {
    setTimeout(() => {
        let duration = player.getDuration();
        totalTimeEl.textContent = formatTime(duration);
    }, 1000);
}

function formatTime(seconds) {
    let min = Math.floor(seconds / 60);
    let sec = Math.floor(seconds % 60);
    return `${min}:${sec < 10 ? "0" : ""}${sec}`;
}

// Funciones para el video de fondo
function onBackgroundPlayerReady(event) {
    event.target.playVideo();
}

function onBackgroundPlayerStateChange(event) {
    if (event.data === YT.PlayerState.ENDED) {
        backgroundPlayer.seekTo(134); // Vuelve al inicio del intervalo (2:14)
        backgroundPlayer.playVideo();
    }
}

// Función para manejar el cambio de video con efecto de fade
function changeVideo() {
    const playerContainer = document.getElementById("videoPlayerContainer");
    playerContainer.style.opacity = 0; // Desvanecer el contenedor del video

    setTimeout(() => {
        player.stopVideo(); // Detenemos el video actual
        currentVideoIndex = (currentVideoIndex + 1) % videoIds.length; // Cambio al siguiente video
        player.cueVideoById(videoIds[currentVideoIndex]); // Cargamos el siguiente video sin reproducir
        player.seekTo(0); // Nos aseguramos de que el video esté al principio
        player.pauseVideo(); // Dejamos el nuevo video en pausa
        isPlaying = false; // Marcamos que está en pausa
        updateProgressBar(); // Actualizamos la barra de progreso

        playerContainer.style.opacity = 1; // Restaurar la opacidad del contenedor del video
    }, 500); // Duración del efecto de fade (500ms)
}

// Función para controlar el estado de reproducción con el botón de play/pause
document.getElementById("playPause").addEventListener("click", function () {
    if (isPlaying) {
        player.pauseVideo();
        isPlaying = false;
        document.getElementById("playPause").innerHTML = '<i class="fas fa-play"></i>';
    } else {
        player.playVideo();
        isPlaying = true;
        document.getElementById("playPause").innerHTML = '<i class="fas fa-pause"></i>';
    }
});

// Función para retroceder al video anterior con efecto de fade
document.getElementById("prevVideo").addEventListener("click", function () {
    const playerContainer = document.getElementById("videoPlayerContainer");
    playerContainer.style.opacity = 0; // Desvanecer el contenedor del video

    setTimeout(() => {
        currentVideoIndex = (currentVideoIndex - 1 + videoIds.length) % videoIds.length;
        player.cueVideoById(videoIds[currentVideoIndex]); // Usamos cueVideoById para evitar reproducción automática
        player.seekTo(0); // Aseguramos que el video esté al principio
        player.pauseVideo(); // Pausamos el video cuando se cambia
        isPlaying = false; // Marcamos que está en pausa
        document.getElementById("playPause").innerHTML = '<i class="fas fa-play"></i>';

        playerContainer.style.opacity = 1; // Restaurar la opacidad del contenedor del video
    }, 500); // Duración del efecto de fade (500ms)
});

// Función para avanzar al siguiente video con efecto de fade
document.getElementById("nextVideo").addEventListener("click", function () {
    const playerContainer = document.getElementById("videoPlayerContainer");
    playerContainer.style.opacity = 0; // Desvanecer el contenedor del video

    setTimeout(() => {
        currentVideoIndex = (currentVideoIndex + 1) % videoIds.length;
        player.cueVideoById(videoIds[currentVideoIndex]); // Usamos cueVideoById para evitar reproducción automática
        player.seekTo(0); // Aseguramos que el video esté al principio
        player.pauseVideo(); // Pausamos el video cuando se cambia
        isPlaying = false; // Marcamos que está en pausa
        document.getElementById("playPause").innerHTML = '<i class="fas fa-play"></i>';

        playerContainer.style.opacity = 1; // Restaurar la opacidad del contenedor del video
    }, 500); // Duración del efecto de fade (500ms)
});