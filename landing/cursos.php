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
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-red">
                    <tr>
                        <th>Nombre del Curso</th>
                        <th>Nombre del Docente</th>
                        <th>Numeros de Horas</th>
                        <th>Horario del curso</th>
                        <th>Días del curso</th>
                        <th>Objetivo del curso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="courses-table">
                    <!-- Los datos se cargarán dinámicamente aquí -->
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'components/footer.php'; // Footer común 
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../admin/js/vercursos.js"></script>
</body>

</html>