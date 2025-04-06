<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>
<?php require 'EstructurasBaseIndex/Head.php'; ?>
<body>
<?php require 'EstructurasBaseIndex/Header.php'; ?>
    <div class="pais" id="pais-container"> 
        <?php require 'js/Paises/SeleccionPais.php'; ?>
    </div>
<main>
    <?php require 'EstructurasBaseIndex/Carrusel.php'; ?>
    <div class="image-container">
        <div class="image-item">
            <a href="Visuales/Visuales.php"><img src="img/Carteles/Visuales.jpg" alt="Visuales"></a>
            <button class="btn btn-dark font-weight-bold" id="btn-visuales">MÁS DETALLES</button>
        </div>
    </div>
</main>
<?php require 'Visuales.php'; ?>
<?php require 'js/Scroll/scrollDownUp.php'; ?>
<?php require 'Script/Script.php'; ?> 
<?php require 'Script/ScriptVisuales.php'; ?> 
</body>
</html>