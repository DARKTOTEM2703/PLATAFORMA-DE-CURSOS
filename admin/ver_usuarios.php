<?php
// filepath: c:\xampp\htdocs\Subir-Tarea-3-.--Formulario-Cursos-JS\admin\ver_inscripciones.php
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
                <a href="dashboard.php" class="btn btn-dark btn-regresar">
                    << REGRESAR</a>
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Password</th>
                                    <th>Rol</th>
                                    <th>Fecha de Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Cambiar la consulta para obtener datos de la tabla 'usuarios'
                                $stmt = $pdo->query('SELECT id, usuario, password, rol, fecha_creacion FROM usuarios');
                                while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>
                                        <td>{$usuario['id']}</td>
                                        <td>{$usuario['usuario']}</td>
                                        <td>{$usuario['password']}</td>
                                        <td>{$usuario['rol']}</td>
                                        <td>{$usuario['fecha_creacion']}</td>
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