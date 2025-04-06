<!-- carrusel.php -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
    .carousel-inner > .item > img {
        width: 100%; /* Asegura que la imagen ocupe el 100% del ancho */
        height: 720px; /* Altura fija */
        object-fit: cover; /* Ajusta la imagen para cubrir el contenedor sin deformarse */
    }
    .carousel {
        width: 100%; /* Ocupa todo el ancho disponible */
        height: 720px; /* Altura fija */
    }
</style>

<div id="theCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicadores -->
    <ol class="carousel-indicators">
        <li data-target="#theCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#theCarousel" data-slide-to="1"></li>
        <li data-target="#theCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Contenedor de las imágenes -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="img/Carrusel/prueba1.png" alt="Imagen 1">
            <div class="carousel-caption">
                <h3>Imagen 1</h3>
                <p>Descripción de la imagen 1</p>
            </div>
        </div>

        <div class="item">
            <img src="img/Carrusel/prueba2.png" alt="Imagen 2">
            <div class="carousel-caption">
                <h3>Imagen 2</h3>
                <p>Descripción de la imagen 2</p>
            </div>
        </div>

        <div class="item">
            <img src="img/Carrusel/prueba3.png" alt="Imagen 3">
            <div class="carousel-caption">
                <h3>Imagen 3</h3>
                <p>Descripción de la imagen 3</p>
            </div>
        </div>
    </div>

    <!-- Flechas de navegación -->
    <a class="left carousel-control" href="#theCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="right carousel-control" href="#theCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>