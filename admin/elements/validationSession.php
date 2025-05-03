<?php
session_start();

// Tiempo máximo de inactividad en segundos (5 minutos)
define('TIEMPO_INACTIVIDAD', 300);

if (!isset($_SESSION['usuario'])) {
    header('Location: ../admin/login.php');
    exit();
}

// Verificar tiempo de inactividad
if (isset($_SESSION['ultimo_acceso'])) {
    $inactividad = time() - $_SESSION['ultimo_acceso'];
    if ($inactividad > TIEMPO_INACTIVIDAD) {
        session_unset();
        session_destroy();
        header('Location: ../admin/login.php?error=inactividad');
        exit();
    }
}

// Actualizar el tiempo de último acceso
$_SESSION['ultimo_acceso'] = time();
