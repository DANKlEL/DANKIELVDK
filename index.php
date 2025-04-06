<?php
// Detectar el tipo de dispositivo
$esMovil = false;
$agenteUsuario = strtolower($_SERVER['HTTP_USER_AGENT']);
$dispositivosMoviles = array('android', 'iphone', 'ipad', 'ipod', 'blackberry', 'opera mini', 'windows phone', 'windows mobile', 'palm', 'mobile');

// Verificar si el agente de usuario corresponde a un dispositivo móvil
foreach ($dispositivosMoviles as $dispositivo) {
    if (strpos($agenteUsuario, $dispositivo) !== false) {
        $esMovil = true;
        break;
    }
}

// Redirigir según el tipo de dispositivo
if ($esMovil) {
    header('Location: indexDispositivoMovil.php');
    exit();
} else {
    header('Location: indexComputadora.php');
    exit();
}
?>
