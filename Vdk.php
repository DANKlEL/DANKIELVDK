<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
?>
    <?php require 'EstructurasBaseVDK/headVDK.php'; ?>
<body>
    <?php require 'Vdk/Carga.php'; ?>
    <?php require 'EstructurasBaseVDK/headerVDK.php'; ?>

    <!-- Contenido principal de la página -->
    <main style="display: none;"> <!-- Ocultar inicialmente -->
        <?php require 'Vdk/portafolio.php'; ?> <!-- Incluir el portafolio -->
    </main>

    <?php require 'Script/ScriptVdk.php'; ?>
    <script src="menuVDK.js"></script> <!-- Aquí se vincula menuVDK.js -->
</body>
</html>