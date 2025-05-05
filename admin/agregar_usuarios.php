<?php
// filepath: c:\xampp\htdocs\Subir-Tarea-3-.--Formulario-Cursos-JS\admin\agregar_usuarios.php
require_once 'elements/validationSession.php';
require_once 'elements/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = $_POST['rol'];

    $stmt = $pdo->prepare('INSERT INTO usuarios (usuario, password, rol) VALUES (?, ?, ?)');
    $stmt->execute([$usuario, $password, $rol]);

    header('Location: ver_usuarios.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/usuarios.css">
    <link rel="stylesheet" href="css/agregar_usuarios.css">
</head>

<body>
    <?php include 'elements/headeradmin.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'elements/sidebar.php'; ?>
            <main class="col-md-9 col-lg-10 py-1 border main-content">
                <h2 class="mb-4 tittle">ALTA USUARIOS</h2>
                <hr class="custom-divider mb-4">
                <a href="usuarios.php" class="btn btn-dark btn-regresar">
                    << REGRESAR</a>
                        <form method="POST" action="agregar_usuarios.php">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="usuario" placeholder="Nombre de usuario"
                                    required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Contraseña"
                                    required>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="rol" required>
                                    <option value="" disabled selected>Selecciona un rol</option>
                                    <option value="admin">Administrador</option>
                                    <option value="usuario">Usuario</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-guardar mb-3">Guardar Usuario</button>
                        </form>
            </main>
        </div>
    </div>
</body>

</html>