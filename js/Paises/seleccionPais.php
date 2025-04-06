<?php
// Este archivo contiene la lógica para seleccionar el país y actualizar los precios.
?>

<div class="pais">
    <button id="seleccionarPais" class="btn-seleccionar-pais">Selecciona tu país</button>
    <div class="logo-pais-automatico-pequeno">
        <img src="img/paises/Mexico.png" alt="México" class="logo-pais-pequeno" id="logoPaisPequeno">
    </div>
</div>

<script>
    // Definir precios base en MXN
    const preciosBase = {
        precioBase3D: 800,
        precioEscenario: 100,
        precioPersonaje: 150,
        precioPixelArt64x64: 600,
        precioPixelArt128x128: 700,
        precioPixelArtEscenario: 120,
        precioPixelArtObjeto: 130,
        precioPixelArtPersonaje: 150
    };

    // Definir monedas por país
    const countryToCurrency = {
        'Mexico': 'MXN',
        'USA': 'USD',
        'Argentina': 'ARS',
        'Colombia': 'COP',
        'Chile': 'CLP',
        'Venezuela': 'VES',
        'España': 'EUR',
        'Peru': 'PEN',
        'Ecuador': 'USD'
    };

    // País por defecto (México)
    let paisSeleccionado = "Mexico";

    // Función para obtener la tasa de cambio
    async function getExchangeRate(targetCurrency) {
        const apiKey = '251289d2e7608397efc03e79'; // Reemplaza con tu clave de API
        const baseCurrency = 'MXN'; // Moneda base: Pesos Mexicanos

        const url = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${baseCurrency}`;
        const response = await fetch(url);
        const data = await response.json();

        if (data.conversion_rates && data.conversion_rates[targetCurrency]) {
            return data.conversion_rates[targetCurrency];
        } else {
            throw new Error('No se pudo obtener la tasa de cambio');
        }
    }

    // Función para actualizar los precios y el logo del país
    async function actualizarPrecios(pais) {
        const monedaLocal = countryToCurrency[pais];
        const tasaCambio = await getExchangeRate(monedaLocal);

        const preciosConvertidos = {
            precioBaseConvertido: (preciosBase.precioBase3D * tasaCambio).toFixed(2),
            precioEscenarioConvertido: (preciosBase.precioEscenario * tasaCambio).toFixed(2),
            precioPersonajeConvertido: (preciosBase.precioPersonaje * tasaCambio).toFixed(2),
            precioPixelArt64x64Convertido: (preciosBase.precioPixelArt64x64 * tasaCambio).toFixed(2),
            precioPixelArt128x128Convertido: (preciosBase.precioPixelArt128x128 * tasaCambio).toFixed(2),
            precioPixelArtEscenarioConvertido: (preciosBase.precioPixelArtEscenario * tasaCambio).toFixed(2),
            precioPixelArtObjetoConvertido: (preciosBase.precioPixelArtObjeto * tasaCambio).toFixed(2),
            precioPixelArtPersonajeConvertido: (preciosBase.precioPixelArtPersonaje * tasaCambio).toFixed(2),
            monedaLocal: monedaLocal
        };

        // Actualizar el rectángulo de información (3D)
        const infoRectangle3D = document.getElementById('infoRectangle3D');
        if (infoRectangle3D) {
            infoRectangle3D.innerHTML = `Precio/Información: ${preciosConvertidos.precioBaseConvertido} ${preciosConvertidos.monedaLocal}`;
        }

        // Actualizar el rectángulo de información (Pixel Art)
        const infoRectanglePixelArt = document.getElementById('infoRectanglePixelArt');
        if (infoRectanglePixelArt) {
            infoRectanglePixelArt.innerHTML = `Precio/Información: ${preciosConvertidos.precioPixelArt64x64Convertido} ${preciosConvertidos.monedaLocal}`;
        }

        // Actualizar el logo del país
        const logoPaisPequeno = document.getElementById('logoPaisPequeno');
        if (logoPaisPequeno) {
            logoPaisPequeno.src = `img/paises/${pais}.png`;
            logoPaisPequeno.alt = pais;
        }

        // Guardar los precios convertidos para usarlos en los SweetAlerts
        window.preciosConvertidos = preciosConvertidos;
    }

    // Función para mostrar el SweetAlert de selección de países
    function mostrarSweetAlertPaises() {
        Swal.fire({
            title: 'Tu país',
            html: `
                <div class="pais-automatico" style="text-align: center; margin-bottom: 20px;">
                    <img src="img/paises/${paisSeleccionado}.png" alt="${paisSeleccionado}" class="logo-pais-automatico" style="width: 80px; height: auto; border-radius: 5px; background: white; padding: 10px;">
                </div>
                <p style="text-align: center; font-size: 16px; margin-bottom: 20px;">¿No es? Selecciona manualmente:</p>
                <div class="paises-lista" style="display: flex; justify-content: center; gap: 10px;">
                    <img src="img/paises/Mexico.png" alt="Mexico" class="logo-pais" data-pais="Mexico" style="width: 50px; height: auto; border-radius: 5px; background: white; padding: 5px; cursor: pointer;">
                    <img src="img/paises/USA.png" alt="USA" class="logo-pais" data-pais="USA" style="width: 50px; height: auto; border-radius: 5px; background: white; padding: 5px; cursor: pointer;">
                    <img src="img/paises/Argentina.png" alt="Argentina" class="logo-pais" data-pais="Argentina" style="width: 50px; height: auto; border-radius: 5px; background: white; padding: 5px; cursor: pointer;">
                    <img src="img/paises/Colombia.png" alt="Colombia" class="logo-pais" data-pais="Colombia" style="width: 50px; height: auto; border-radius: 5px; background: white; padding: 5px; cursor: pointer;">
                    <img src="img/paises/Chile.png" alt="Chile" class="logo-pais" data-pais="Chile" style="width: 50px; height: auto; border-radius: 5px; background: white; padding: 5px; cursor: pointer;">
                    <img src="img/paises/Venezuela.png" alt="Venezuela" class="logo-pais" data-pais="Venezuela" style="width: 50px; height: auto; border-radius: 5px; background: white; padding: 5px; cursor: pointer;">
                    <img src="img/paises/España.png" alt="España" class="logo-pais" data-pais="España" style="width: 50px; height: auto; border-radius: 5px; background: white; padding: 5px; cursor: pointer;">
                    <img src="img/paises/Peru.png" alt="Peru" class="logo-pais" data-pais="Peru" style="width: 50px; height: auto; border-radius: 5px; background: white; padding: 5px; cursor: pointer;">
                    <img src="img/paises/Ecuador.png" alt="Ecuador" class="logo-pais" data-pais="Ecuador" style="width: 50px; height: auto; border-radius: 5px; background: white; padding: 5px; cursor: pointer;">
                </div>
            `,
            showConfirmButton: false,
            customClass: {
                popup: 'sweet-alert-paises',
            },
            didOpen: () => {
                document.querySelectorAll('.logo-pais').forEach(logo => {
                    logo.addEventListener('click', async () => {
                        const pais = logo.getAttribute('data-pais');
                        paisSeleccionado = pais; // Actualizar el país seleccionado
                        await actualizarPrecios(pais);
                        Swal.close();
                    });
                });
            },
        });
    }

    // Inicializar la página con el país por defecto (México)
    document.addEventListener('DOMContentLoaded', async () => {
        await actualizarPrecios(paisSeleccionado); // Establecer precios por defecto

        const botonSeleccionarPais = document.getElementById('seleccionarPais');
        if (botonSeleccionarPais) {
            botonSeleccionarPais.addEventListener('click', mostrarSweetAlertPaises);
        }
    });
</script>