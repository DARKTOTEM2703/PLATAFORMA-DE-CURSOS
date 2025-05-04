<?php
require_once 'elements/validationSession.php';
require_once 'elements/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $docente = $_POST['docente'];
    $horas = $_POST['horas'];
    $horario = $_POST['horario'];
    $dias = $_POST['dias'];
    $objetivo = $_POST['objetivo'];

    $stmt = $pdo->prepare('INSERT INTO cursos (nombre, docente, horas, horario, dias, objetivo) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$nombre, $docente, $horas, $horario, $dias, $objetivo]);

    header('Location: ver_cursos.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/altacursos.css">
</head>

<body>
    <?php include 'elements/headeradmin.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'elements/sidebar.php'; ?>
            <main class="col-md-9 col-lg-10 py-1 border main-content">
                <h2 class="mb-4 tittle">ALTA DE CURSOS</h2>
                <hr class="custom-divider mb-4">
                <a href="ver_cursos.php" class="btn btn-dark btn-regresar">
                    << REGRESAR</a>
                        <form method="POST" action="agregar_cursos.php">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre del curso"
                                    required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="docente" placeholder="Nombre del docente"
                                    required>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" name="horas" required>
                                    <option value="" disabled selected>Número de horas del curso</option>
                                    <option value="10">10 horas</option>
                                    <option value="20">20 horas</option>
                                    <option value="30">30 horas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="horario" placeholder="Horario del curso"
                                    required>
                            </div>
                            <h5 class="mt-4">Días del curso</h5>
                            <div class="d-flex justify-content-around mb-3">
                                <label><input type="radio" name="dias" value="Lunes, Miércoles y Viernes" required>
                                    Lunes, Miércoles y Viernes</label>
                                <label><input type="radio" name="dias" value="Martes, Jueves y Sábado"> Martes, Jueves y
                                    Sábado</label>
                                <label><input type="radio" name="dias" value="Solo Sábados"> Solo Sábados</label>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="objetivo" placeholder="Objetivo del curso" rows="3"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-guardar">Guardar Curso</button>
                        </form>
            </main>
        </div>
    </div>
</body>

</html>