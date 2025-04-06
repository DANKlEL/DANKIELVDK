document.addEventListener('DOMContentLoaded', function() {
    // Abrir/Cerrar menú de búsqueda
    const searchIcon = document.querySelector('.search-icon');
    const searchMenu = document.querySelector('.search-menu');

    if (searchIcon && searchMenu) {
        searchIcon.addEventListener('click', function() {
            searchMenu.style.display = searchMenu.style.display === 'block' ? 'none' : 'block';
        });
    }

    // Abrir/Cerrar menú hamburguesa (si lo implementas)
    const menuIcon = document.querySelector('.menu-icon');
    const submenu = document.querySelector('.submenu');

    if (menuIcon && submenu) {
        menuIcon.addEventListener('click', function() {
            submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
        });
    }
});