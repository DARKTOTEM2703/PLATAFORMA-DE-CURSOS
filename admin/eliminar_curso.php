<!-- filepath: c:\xampp\htdocs\Subir-Tarea-3-.--Formulario-Cursos-JS\admin\eliminar_curso.php -->
<?php
require_once 'elements/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare('DELETE FROM cursos WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: ver_cursos.php');
    exit();
} else {
    echo "ID no proporcionado.";
}
?>