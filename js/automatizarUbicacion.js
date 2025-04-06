// Función para obtener la ubicación utilizando la API de Google Maps
function obtenerUbicacion() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(mostrarUbicacion, manejarError);
    } else {
        alert("Geolocalización no es soportada por este navegador.");
    }
}

// Función para manejar la respuesta de la API de Google Maps
function mostrarUbicacion(position) {
    const lat = position.coords.latitude;
    const lng = position.coords.longitude;

    // Llamada a la API de Google Maps para obtener el país basado en las coordenadas
    fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=AIzaSyCSRWLsXlZbitXBAI4mmfnx0j5zvJmYCa4`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'OK') {
                const resultados = data.results;
                let pais = null;

                // Iterar sobre los resultados para encontrar el país
                for (let i = 0; i < resultados.length; i++) {
                    const componentes = resultados[i].address_components;
                    for (let j = 0; j < componentes.length; j++) {
                        const tipos = componentes[j].types;
                        if (tipos.includes("country")) {
                            pais = componentes[j].long_name;
                            break;
                        }
                    }
                    if (pais) break;
                }

                if (pais) {
                    mostrarSweetAlert(pais);
                    seleccionarPais(pais);
                } else {
                    alert("No se pudo determinar el país.");
                }
            } else {
                alert("No se pudo obtener la información de ubicación.");
            }
        })
        .catch(error => {
            console.error('Error al obtener la información de ubicación:', error);
            alert("Hubo un problema al intentar obtener tu ubicación.");
        });
}

// Función para manejar errores de geolocalización
function manejarError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            alert("Permiso denegado por el usuario para obtener la ubicación.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("La información de ubicación no está disponible.");
            break;
        case error.TIMEOUT:
            alert("La solicitud para obtener la ubicación ha expirado.");
            break;
        case error.UNKNOWN_ERROR:
            alert("Un error desconocido ocurrió.");
            break;
    }
}

// Nueva función para mostrar el SweetAlert con el logo del país
function mostrarSweetAlert(pais) {
    const paisImagenMap = {
        "United States": "img/paises/Usa.png",
        "Mexico": "img/paises/Mexico.png",
        "Argentina": "img/paises/Argentina.png",
        "Colombia": "img/paises/Colombia.png",
        "Chile": "img/paises/Chile.png",
        "Venezuela": "img/paises/Venezuela.png",
        "Spain": "img/paises/España.png",
        "Peru": "img/paises/Peru.png",
        "Ecuador": "img/paises/Ecuador.png"
        // Agrega más países según corresponda
    };

    const paisImgSrc = paisImagenMap[pais];
    if (paisImgSrc) {
        Swal.fire({
            title: `Se autolocalizó tu país: ${pais}`,
            imageUrl: paisImgSrc,
            imageWidth: 100,
            imageHeight: 100,
            imageAlt: pais,
            confirmButtonText: 'Aceptar'
        });
    } 
}

// Nueva función para hacer clic automáticamente en la imagen del país detectado
function seleccionarPais(pais) {
    const paisImagenMap = {
        "United States": "USA",
        "Mexico": "Mexico",
        "Argentina": "Argentina",
        "Colombia": "Colombia",
        "Chile": "Chile",
        "Venezuela": "Venezuela",
        "Spain": "España",
        "Peru": "Peru",
        "Ecuador": "Ecuador"
        // Agrega más países según corresponda
    };

    const paisId = paisImagenMap[pais];
    if (paisId) {
        const imgElement = document.querySelector(`img[alt="${paisId}"]`);
        if (imgElement) {
            imgElement.click();
        }
    }
}

// Llamar a la función para obtener la ubicación al cargar la página
document.addEventListener("DOMContentLoaded", obtenerUbicacion);
