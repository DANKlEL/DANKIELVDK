// scrollDownUp.js
window.addEventListener('scroll', function () {
    const scrollUpButton = document.getElementById('scroll-up');
    const scrollDownButton = document.getElementById('scroll-down');

    // Mostrar u ocultar el botón de scroll hacia arriba
    if (window.scrollY > 100) {
        scrollUpButton.style.display = 'flex';
    } else {
        scrollUpButton.style.display = 'none';
    }

    // Mostrar u ocultar el botón de scroll hacia abajo
    if ((window.innerHeight + window.scrollY) < document.body.offsetHeight - 100) {
        scrollDownButton.style.display = 'flex';
    } else {
        scrollDownButton.style.display = 'none';
    }
});

// Scroll hacia arriba
document.getElementById('scroll-up').addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Scroll hacia abajo
document.getElementById('scroll-down').addEventListener('click', function () {
    window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
});