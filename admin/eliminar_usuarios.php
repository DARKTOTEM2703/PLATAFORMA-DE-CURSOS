<?php
// filepath: c:\xampp\htdocs\Subir-Tarea-3-.--Formulario-Cursos-JS\admin\eliminar_usuario.php
require_once 'elements/validationSession.php';
require_once 'elements/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar y ejecutar la consulta para eliminar el usuario
    $stmt = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
    $stmt->execute([$id]);

    // Redirigir de vuelta a la página de ver usuarios
    header('Location: ver_usuarios.php');
    exit();
} else {
    echo "ID de usuario no proporcionado.";
}
