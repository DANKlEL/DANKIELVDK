// Videos de 3D 
const videoUrls3D = [
    'https://www.youtube.com/embed/fdtGIXlSBYU',
    'https://www.youtube.com/embed/q-FcxH8VitQ',
    'https://www.youtube.com/embed/1YhCMtuWXYI',
    'https://www.youtube.com/embed/NyeYJHwbMgw',
    'https://www.youtube.com/embed/aEFW1vrqyBg',
    'https://www.youtube.com/embed/yCIsKctKyyk',
    'https://www.youtube.com/embed/kSxN_uQF5EY',
    'https://www.youtube.com/embed/HaEf63Wk1Sc',
    'https://www.youtube.com/embed/q2YLSjHLPeY',
    'https://www.youtube.com/embed/gmlt0TecTZE',
    'https://www.youtube.com/embed/ZRV_zPK18Gg',
    'https://www.youtube.com/embed/9PfPgOhJJaA',
    'https://www.youtube.com/embed/ih8asyTq1oQ',
    'https://www.youtube.com/embed/azfkhwF1jGw',
    'https://www.youtube.com/embed/Sx8w6pJpb3A',
    'https://www.youtube.com/embed/x1RprL97HJs',
    'https://www.youtube.com/embed/ABS1KqO6Dro',
    'https://www.youtube.com/embed/Ex5maczKS3k',
    'https://www.youtube.com/embed/6h5MklJDZCk',
    'https://www.youtube.com/embed/jzdxGmCmB_g',
    'https://www.youtube.com/embed/xUnf5UXAW5g',
    'https://www.youtube.com/embed/90OnAT9ELks'
];

// Videos de Pixel Art
const videoUrlsPixelArt = [
    'https://www.youtube.com/embed/1YhCMtuWXYI',
    'https://www.youtube.com/embed/HaEf63Wk1Sc',
    'https://www.youtube.com/embed/ih8asyTq1oQ',
    'https://www.youtube.com/embed/jzdxGmCmB_g'
];

let currentVideoIndex3D = 0;
let currentVideoIndexPixelArt = 0;

// Lógica para el carrusel de 3D
document.querySelector('#nextVideo').addEventListener('click', () => {
    currentVideoIndex3D = (currentVideoIndex3D + 1) % videoUrls3D.length;
    updateVideo('player', videoUrls3D, currentVideoIndex3D);
});

document.querySelector('#prevVideo').addEventListener('click', () => {
    currentVideoIndex3D = (currentVideoIndex3D - 1 + videoUrls3D.length) % videoUrls3D.length;
    updateVideo('player', videoUrls3D, currentVideoIndex3D);
});

// Lógica para el carrusel de Pixel Art
document.querySelector('#nextVideoPixelArt').addEventListener('click', () => {
    currentVideoIndexPixelArt = (currentVideoIndexPixelArt + 1) % videoUrlsPixelArt.length;
    updateVideo('playerPixelArt', videoUrlsPixelArt, currentVideoIndexPixelArt);
});

document.querySelector('#prevVideoPixelArt').addEventListener('click', () => {
    currentVideoIndexPixelArt = (currentVideoIndexPixelArt - 1 + videoUrlsPixelArt.length) % videoUrlsPixelArt.length;
    updateVideo('playerPixelArt', videoUrlsPixelArt, currentVideoIndexPixelArt);
});

// Función para actualizar el video
function updateVideo(playerId, videoUrls, currentIndex) {
    const iframe = document.querySelector(`#${playerId}`);
    if (iframe) {
        iframe.src = videoUrls[currentIndex];
    }
}

// Inicializar los videos
updateVideo('player', videoUrls3D, currentVideoIndex3D);
updateVideo('playerPixelArt', videoUrlsPixelArt, currentVideoIndexPixelArt);