<!-- filepath: c:\xampp\htdocs\Subir-Tarea-3-.--Formulario-Cursos-JS\landing\incripcion.php -->
<?php
require_once '../admin/elements/db.php'; // Conexión a la base de datos
include '../vendor/autoload.php'; // Cargar Dotenv
require 'send_email.php'; // Cambia la ruta si es necesario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $curso = $_POST['curso'];
    $pago = $_POST['pago'];
    $comentarios = $_POST['comentarios'];

    // Obtener el precio del curso seleccionado
    $stmt = $pdo->prepare("SELECT precio FROM cursos WHERE nombre = ?");
    $stmt->execute([$curso]);
    $cursoData = $stmt->fetch(PDO::FETCH_ASSOC);
    $precio = $cursoData['precio'];

    try {
        // Insertar datos en la base de datos
        $stmt = $pdo->prepare("INSERT INTO inscripciones (nombre, email, telefono, curso, pago, comentarios, estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $email, $telefono, $curso, $pago, $comentarios, 'pendiente']);

        // Enviar correo de confirmación
        $resultadoCorreo = enviarCorreoConfirmacion($nombre, $email, $curso, $pago, $precio);

        if ($resultadoCorreo === true) {
            $success = "Inscripción realizada con éxito. Se ha enviado un correo de confirmación.";
        } else {
            $success = "Inscripción realizada con éxito, pero hubo un problema al enviar el correo: $resultadoCorreo";
        }

        // Redirigir para evitar reenvío del formulario
        header("Location: inscripcion.php?success=" . urlencode($success));
        exit;
    } catch (PDOException $e) {
        $error = "Error al realizar la inscripción: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción de Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/inscripcion.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include '../elements/header.php';
    include './components/information.php'; ?>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success" id="success-alert"><?= htmlspecialchars($_GET['success']) ?></div>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Ocultar la alerta después de 3 segundos
                setTimeout(() => {
                    const alert = document.getElementById("success-alert");
                    if (alert) {
                        alert.style.display = "none";
                    }
                }, 3000); // 3000 ms = 3 segundos

                // Redirigir después de 3.5 segundos
                setTimeout(() => {
                    window.location.href = "inscripcion.php"; // Cambia la ruta si es necesario
                }, 3500); // 3500 ms = 3.5 segundos
            });
        </script>
    <?php elseif (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <h2 class="text-center">Formulario de Inscripción</h2>
        <div class="mb-3">
            <label for="nombre" class="form-label">Escribe tu nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Cual es tu email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required>
        </div>
        <div class="mb-3">
            <label for="curso" class="form-label">Escoge tu curso</label>
            <select class="form-select" id="curso" name="curso" required onchange="actualizarPrecio()">
                <?php
                $stmt = $pdo->query("SELECT nombre, precio FROM cursos");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['nombre']}' data-precio='{$row['precio']}'>{$row['nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio del curso</label>
            <input type="text" class="form-control" id="precio" name="precio" readonly>
        </div>
        <div class="mb-3">
            <label for="pago" class="form-label">Forma de pago</label>
            <select class="form-select" id="pago" name="pago" required>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Transferencia">Transferencia</option>
                <option value="Efectivo">Efectivo</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="comentarios" class="form-label">Déjanos tus comentarios</label>
            <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    </div>
    <script>
        function actualizarPrecio() {
            const cursoSelect = document.getElementById('curso');
            const precioInput = document.getElementById('precio');
            const precio = cursoSelect.options[cursoSelect.selectedIndex].getAttribute('data-precio');
            precioInput.value = `$${precio}`;
        }

        // Inicializar el precio al cargar la página
        document.addEventListener('DOMContentLoaded', actualizarPrecio);
    </script>
    <?php include 'components/footer.php'; ?>
</body>

</html>