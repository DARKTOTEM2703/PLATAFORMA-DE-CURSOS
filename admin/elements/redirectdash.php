<?php
// Verifica si la sesión ya tiene un usuario autenticado
if (isset($_SESSION['usuario'])) {
    // Si el usuario ya está autenticado, redirige al archivo 'dashboard.php'
    header('Location: dashboard.php');
    // Termina la ejecución del script para evitar que se ejecute código adicional
    exit();
}
