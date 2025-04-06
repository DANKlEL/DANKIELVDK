// videosPortafolio.js
document.addEventListener('DOMContentLoaded', function() {
    const videoLeft = document.getElementById('video-left');
    const videoCenter = document.getElementById('video-center');
    const videoRight = document.getElementById('video-right');

    const videosLeft = [
        { src: 'https://www.youtube.com/embed/yiwr7E1DPk4?start=0&end=10&autoplay=1&controls=0&loop=1&playlist=yiwr7E1DPk4' },
        { src: 'https://www.youtube.com/embed/qY-Q2n8Nx1k?start=0&end=11&autoplay=1&controls=0&loop=1&playlist=qY-Q2n8Nx1k' },
        { src: 'https://www.youtube.com/embed/nV0CJg2xEMw?start=110&end=120&autoplay=1&controls=0&loop=1&playlist=nV0CJg2xEMw' }
    ];

    const videosCenter = [
        { src: 'https://www.youtube.com/embed/q-FcxH8VitQ?start=13&end=24&autoplay=1&controls=0&loop=1&playlist=q-FcxH8VitQ' },
        { src: 'https://www.youtube.com/embed/fdtGIXlSBYU?start=138&end=148&autoplay=1&controls=0&loop=1&playlist=fdtGIXlSBYU' },
        { src: 'https://www.youtube.com/embed/yCIsKctKyyk?start=8&end=22&autoplay=1&controls=0&loop=1&playlist=yCIsKctKyyk' }
    ];

    const videosRight = [
        { src: 'https://www.youtube.com/embed/OQl5na-BfYA?start=0&end=10&autoplay=1&controls=0&loop=1&playlist=OQl5na-BfYA' },
        { src: 'https://www.youtube.com/embed/O-tdr98Yf34?start=7&end=17&autoplay=1&controls=0&loop=1&playlist=O-tdr98Yf34' },
        { src: 'https://www.youtube.com/embed/1liYA1JLuxQ?start=29&end=39&autoplay=1&controls=0&loop=1&playlist=1liYA1JLuxQ' }
    ];

    let currentIndexLeft = 0;
    let currentIndexCenter = 0;
    let currentIndexRight = 0;

    function changeVideo(container, videos, currentIndex) {
        container.innerHTML = `<iframe src="${videos[currentIndex].src}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
    }

    function startVideoRotation(container, videos, currentIndex) {
        setInterval(() => {
            currentIndex = (currentIndex + 1) % videos.length;
            changeVideo(container, videos, currentIndex);
        }, 10000); // Cambiar cada 10 segundos
    }

    // Iniciar la rotación de videos
    startVideoRotation(videoLeft, videosLeft, currentIndexLeft);
    startVideoRotation(videoCenter, videosCenter, currentIndexCenter);
    startVideoRotation(videoRight, videosRight, currentIndexRight);
});