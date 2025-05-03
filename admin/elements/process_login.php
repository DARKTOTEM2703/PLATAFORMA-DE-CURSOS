<?php
// Verifica si no hay una sesión activa antes de iniciarla
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el directorio de logs no existe y lo crea si es necesario
if (!is_dir('../logs')) {
    mkdir('../logs', 0777, true);
}

// Requiere el archivo de conexión a la base de datos
require_once 'db.php';
// Requiere el archivo para registrar eventos en un log
require_once 'log.php';


// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar el token CSRF
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'Token CSRF inválido.';
        registrarEvento("Intento de inicio de sesión con token CSRF inválido.");
        return;
    }

    // Sanitiza el nombre de usuario ingresado por el cliente
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    // Sanitiza la contraseña ingresada por el cliente
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Valida que los campos no estén vacíos
    if (empty($usuario) || empty($password)) {
        // Asigna un mensaje de error si algún campo está vacío
        $error = 'Por favor, completa todos los campos.';
        return;
    }

    // Verifica si no existe un contador de intentos fallidos en la sesión
    if (!isset($_SESSION['intentos'])) {
        // Inicializa el contador de intentos fallidos
        $_SESSION['intentos'] = 0;
    }

    // Verifica si el número de intentos fallidos supera el límite permitido
    if ($_SESSION['intentos'] >= 5) { // Cambiar el límite a 5
        $error = 'Demasiados intentos fallidos. Intenta nuevamente más tarde.';
        registrarEvento("Bloqueo por demasiados intentos fallidos para el usuario: $usuario");
        return;
    }

    // Prepara una consulta para buscar el usuario en la base de datos
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE usuario = :usuario');
    // Asigna el valor del nombre de usuario a la consulta preparada
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    // Ejecuta la consulta
    $stmt->execute();
    // Obtiene los datos del usuario desde la base de datos
    $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica si el usuario existe y si la contraseña ingresada es correcta
    if ($usuarioData && password_verify($password, $usuarioData['password'])) {
        // Almacena el nombre de usuario en la sesión
        $_SESSION['usuario'] = $usuarioData['usuario'];
        // Almacena el rol del usuario en la sesión
        $_SESSION['rol'] = $usuarioData['rol'];
        // Reinicia el contador de intentos fallidos al iniciar sesión correctamente
        $_SESSION['intentos'] = 0;
        // Registra el evento de inicio de sesión exitoso
        registrarEvento("Inicio de sesión exitoso para el usuario: $usuario");
        // Redirige al usuario al dashboard
        header('Location: dashboard.php');
        exit();
    } else {
        // Incrementa el contador de intentos fallidos
        $_SESSION['intentos']++;
        // Asigna un mensaje de error por credenciales incorrectas
        $error = 'Usuario o contraseña incorrectos.';
        // Registra el evento de intento fallido de inicio de sesión
        registrarEvento("Intento fallido de inicio de sesión para el usuario: $usuario");
    }
}
