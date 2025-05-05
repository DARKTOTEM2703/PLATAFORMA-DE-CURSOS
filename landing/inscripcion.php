<!-- filepath: c:\xampp\htdocs\Subir-Tarea-3-.--Formulario-Cursos-JS\landing\incripcion.php -->
<?php
require_once '../admin/elements/db.php'; // Conexión a la base de datos
require '../vendor/autoload.php'; // Cargar PHPMailer y Dotenv

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $curso = $_POST['curso'];
    $pago = $_POST['pago'];
    $comentarios = $_POST['comentarios'];

    try {
        // Insertar datos en la base de datos
        $stmt = $pdo->prepare("INSERT INTO inscripciones (nombre, email, telefono, curso, pago, comentarios) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $email, $telefono, $curso, $pago, $comentarios]);

        // Configurar PHPMailer
        $mail = new PHPMailer(true);

        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USERNAME'];
        $mail->Password = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        // Configuración del correo
        $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']); // Cambiado de SMTP_FROM a SMTP_FROM_EMAIL
        $mail->addAddress($email, $nombre); // Correo del destinatario
        $mail->Subject = 'Confirmación de Inscripción';
        $mail->Body = "Hola $nombre,\n\nGracias por inscribirte en el curso '$curso'. Nos pondremos en contacto contigo pronto.\n\nSaludos,\nEscuela de Capacitación";

        // Enviar correo
        $mail->send();
        $success = "Inscripción realizada con éxito. Se ha enviado un correo de confirmación.";
    } catch (Exception $e) {
        $error = "Error al enviar el correo: " . $mail->ErrorInfo;
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
    <link rel="stylesheet" href="../css/inscripcion.css">
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">INSCRIPCIÓN DE CURSOS</h2>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
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
                <select class="form-select" id="curso" name="curso" required>
                    <?php
                    $stmt = $pdo->query("SELECT nombre FROM cursos");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['nombre']}'>{$row['nombre']}</option>";
                    }
                    ?>
                </select>
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
</body>

</html>