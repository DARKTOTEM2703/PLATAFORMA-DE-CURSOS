<?php
require_once '../elements/db.php'; // Conexión a la base de datos

header('Content-Type: application/json');

try {
    $query = "SELECT * FROM cursos";
    $result = $pdo->query($query);

    $cursos = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $cursos[] = $row;
    }

    echo json_encode($cursos);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
