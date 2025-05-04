<?php
require_once 'elements/validationSession.php';
require_once 'elements/db.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/vercursos.css">
</head>

<body>
    <?php include 'elements/headeradmin.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'elements/sidebar.php'; ?>
            <main class="col-md-9 col-lg-10 py-1 border main-content">
                <h2 class="mb-4 tittle">VER CURSOS</h2>
                <hr class="custom-divider mb-4">
                <a href="agregar_cursos.php" class="btn btn-dark btn-regresar">
                    << REGRESAR</a>
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre del curso</th>
                                    <th>Nombre del Docente</th>
                                    <th># Horas</th>
                                    <th>Horario del curso</th>
                                    <th>Días del curso</th>
                                    <th>Objetivo del curso</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->query('SELECT * FROM cursos');
                                while ($curso = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr>
                                <td>{$curso['id']}</td>
                                <td>{$curso['nombre']}</td>
                                <td>{$curso['docente']}</td>
                                <td>{$curso['horas']}</td>
                                <td>{$curso['horario']}</td>
                                <td>{$curso['dias']}</td>
                                <td>{$curso['objetivo']}</td>
                                <td><a href='eliminar_curso.php?id={$curso['id']}' class='btn btn-danger btn-sm'>Eliminar</a></td>
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