<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Hash de Contraseña</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Generar Hash de Contraseña</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="text" name="password" id="password" class="form-control"
                    placeholder="Ingresa la contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Generar Hash</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['password'])): ?>
            <div class="mt-4">
                <h4 class="text-center">Hash Generado:</h4>
                <div class="alert alert-success text-center">
                    <?php
                    // Generar el hash de la contraseña ingresada
                    $password = $_POST['password'];
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    echo htmlspecialchars($hash);
                    ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>