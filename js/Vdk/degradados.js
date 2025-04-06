document.addEventListener('DOMContentLoaded', function () {
    const contenedores = document.querySelectorAll('.contenedor-secundario');
    contenedores.forEach(contenedor => {
        // Crear un pseudo-elemento para el borde con degradado
        const pseudoElement = document.createElement('div');
        pseudoElement.style.position = 'absolute';
        pseudoElement.style.top = '-10px';
        pseudoElement.style.left = '-10px';
        pseudoElement.style.right = '-10px';
        pseudoElement.style.bottom = '-10px';
        pseudoElement.style.background = `linear-gradient(45deg, #000000, #a91313)`;
        pseudoElement.style.zIndex = '-1';
        pseudoElement.style.borderRadius = '0';
        pseudoElement.style.animation = 'gradient-rotate 3s linear infinite';

        // Agregar el pseudo-elemento al contenedor
        contenedor.style.position = 'relative';
        contenedor.style.overflow = 'hidden';
        contenedor.appendChild(pseudoElement);
    });
});