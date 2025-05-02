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
</head>

<body>
    <?php include_once '../elements/header.php'; ?>
    <div class="login-container">
        <div class="login-card bg-white rounded shadow-sm p-4 mt-5 border border-3">
            <h6 class="text-center fw-bold mb-3">Acceso Panel Administrativo</h6>
            <form>
                <input type="text" class="form-control mb-2" placeholder="Usuario">
                <input type="password" class="form-control mb-3" placeholder="Contraseña">
                <button type="submit" class="btn btn-vino w-100">Login</button>
            </form>
        </div>
    </div>
</body>

</html>