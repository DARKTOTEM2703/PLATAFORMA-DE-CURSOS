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
    <title>Ver Inscripciones</title>
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
                <h2 class="mb-4 tittle">VER INSCRIPCIONES</h2>
                <hr class="custom-divider mb-4">
                <a href="dashboard.php" class="btn btn-dark btn-regresar">
                    << REGRESAR</a>
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Curso</th>
                                    <th>Pago</th>
                                    <th>Estado</th>
                                    <th>Fecha de Inscripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query('SELECT * FROM inscripciones');
                                while ($inscripcion = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>
                                <td>{$inscripcion['id']}</td>
                                <td>{$inscripcion['nombre']}</td>
                                <td>{$inscripcion['email']}</td>
                                <td>{$inscripcion['telefono']}</td>
                                <td>{$inscripcion['curso']}</td>
                                <td>{$inscripcion['pago']}</td>
                                <td>{$inscripcion['estado']}</td>
                                <td>{$inscripcion['fecha_inscripcion']}</td>
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