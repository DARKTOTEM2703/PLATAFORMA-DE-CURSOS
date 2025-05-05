<!-- filepath: c:\xampp\htdocs\Subir-Tarea-3-.--Formulario-Cursos-JS\cursos.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/cursos.css">
</head>

<body>
    <?php
    include '../elements/header.php'; // Header común
    require_once '../admin/elements/db.php'; // Conexión a la base de datos
    include 'components/information.php'; // Información de la escuela de capacitación
    ?>

    <div class="container my-5">
        <h2 class="text-center mb-4">LISTA DE CURSOS</h2>
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nombre del Curso</th>
                    <th>Nombre del Docente</th>
                    <th># de Horas</th>
                    <th>Horario del curso</th>
                    <th>Días del curso</th>
                    <th>Objetivo del curso</th>
                    <th>Inscripción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query('SELECT * FROM cursos');
                while ($curso = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$curso['nombre']}</td>
                        <td>{$curso['docente']}</td>
                        <td>{$curso['horas']} hrs.</td>
                        <td>{$curso['horario']}</td>
                        <td>{$curso['dias']}</td>
                        <td>{$curso['objetivo']}</td>
                        <td><a href='#' class='btn btn-dark'>Inscríbete Ahora</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'components/footer.php'; // Footer común 
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>