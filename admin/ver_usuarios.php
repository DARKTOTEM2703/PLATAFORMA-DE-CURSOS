<?php
// filepath: c:\xampp\htdocs\Subir-Tarea-3-.--Formulario-Cursos-JS\admin\ver_usuarios.php
require_once 'elements/validationSession.php';
require_once 'elements/db.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/usuarios.css">
    <link rel="stylesheet" href="css/ver_usuarios.css">
</head>

<body>
    <?php include 'elements/headeradmin.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'elements/sidebar.php'; ?>
            <main class="col-md-9 col-lg-10 py-1 border main-content">
                <h2 class="mb-4 tittle">VER USUARIOS</h2>
                <hr class="custom-divider mb-4">
                <a href="usuarios.php" class="btn btn-dark btn-regresar">
                    << REGRESAR</a>
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Usuario</th>
                                    <th>Contraseña</th>
                                    <th>Tipo de Usuario</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query('SELECT * FROM usuarios');
                                while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>
                                <td>{$usuario['id']}</td>
                                <td>{$usuario['usuario']}</td>
                                <td>{$usuario['password']}</td>
                                <td>{$usuario['rol']}</td>
                                <td>
                                    <a href='eliminar_usuarios.php?id={$usuario['id']}' class='btn btn-danger btn-sm'
                                        onclick=\"return confirm('¿Estás seguro de que deseas eliminar este usuario?');\">
                                        Eliminar
                                    </a>
                                </td>
                </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
            </main>
        </div>
    </div>
</body>

</html>