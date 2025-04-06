<?php
session_start();

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'login') {
        $_SESSION['username'] = $_POST['email'];
    } elseif ($_POST['action'] == 'logout') {
        session_destroy();
        setcookie(session_name(), '', time() - 3600);
    }
}

if (isset($_SESSION['username'])) {
    echo json_encode(['loggedIn' => true, 'username' => $_SESSION['username']]);
} else {
    echo json_encode(['loggedIn' => false]);
}
?>
