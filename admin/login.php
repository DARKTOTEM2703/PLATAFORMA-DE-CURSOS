<?php
require_once 'elements/cookie.php'; // Configuración de cookies y sesiones
require_once 'elements/token.php'; // Generar el token CSRF
require_once 'elements/process_login.php'; // Procesar el login
require_once 'elements/redirectdash.php'; // Redirigir si ya está autenticado
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Escuela de Cursos de Capacitación</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/cronometro.js" defer></script>
    <script src="js/sanitizar_Login.js" defer></script>
</head>

<body>
    <?php include_once '../elements/header.php'; ?>
    <div class="login-container">
        <div class="login-card bg-white rounded shadow-sm p-4 mt-5 border border-3">
            <h6 class="text-center fw-bold mb-3">Acceso Panel Administrativo</h6>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger text-center">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>


            <form method="POST" action="login.php">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                <input type="text" name="usuario" class="form-control mb-2" placeholder="Usuario" required
                    pattern="[a-zA-Z0-9]+" title="Solo se permiten letras y números.">
                <input type="password" name="password" class="form-control mb-3" placeholder="Contraseña" required
                    minlength="2" title="La contraseña debe tener al menos 
                    2 caracteres.">
                <button type="submit" class="btn btn-vino w-100">Login</button>
            </form>
            <!-- Contenedor del cronómetro -->
            <?php if (isset($tiempo_restante_segundos) && $tiempo_restante_segundos > 0): ?>
                <div id="cronometro" class="text-center mt-3">
                    <small class="text-muted">
                        Tiempo restante: <span id="tiempo-restante"><?php echo $tiempo_restante_segundos; ?></span>
                    </small>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>