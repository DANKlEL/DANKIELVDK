window.addEventListener('scroll', function() {
    var header = document.getElementById('main-header');
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > 0) {
        // Si no está en el tope de la página, ocultar la mitad del header
        header.style.transform = 'translateY(-61%)';
    } else {
        // Si está en el tope de la página, mostrar el header completo
        header.style.transform = 'translateY(0)';
    }
    header.style.transition = 'transform 0.3s ease';
});