<?php
// Verifica si no hay una sesión activa antes de configurar los parámetros de las cookies
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0, // La cookie expira al cerrar el navegador
        'path' => '/',
        'domain' => '', // Cambiar si usas un dominio específico
        'secure' => true, // Usar solo en HTTPS
        'httponly' => true, // Evita acceso desde JavaScript
        'samesite' => 'Strict' // Evita envío de cookies en solicitudes de terceros
    ]);
    session_start(); // Inicia la sesión después de configurar las cookies
}
