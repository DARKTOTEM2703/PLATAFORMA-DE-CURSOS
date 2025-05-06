<?php

use Dotenv\Dotenv;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarCorreoConfirmacion($nombre, $email, $curso, $pago)
{
    try {
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
        $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], $_ENV['SMTP_FROM_NAME']);
        $mail->addAddress($email, $nombre);
        $mail->Subject = 'Confirmación de Inscripción';

        // Formato del correo
        $mail->isHTML(true);
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; line-height: 1.5;'>
                <h1 style='color: #4CAF50;'>¡Inscripción Exitosa!</h1>
                <p>Hola, <strong>$nombre</strong>,</p>
                <p>Gracias por inscribirte en el curso <strong>$curso</strong>.</p>
                <p>Detalles del curso:</p>
                <ul>
                    <li><strong>Curso:</strong> $curso</li>
                    <li><strong>Forma de pago:</strong> $pago</li>
                </ul>
                <p>Nos pondremos en contacto contigo pronto para más detalles.</p>
                <p>Si tienes alguna duda, no dudes en contactarnos.</p>
                <p style='color: #555;'>Saludos,<br>Equipo de Capacitación</p>
            </div>
        ";

        // Enviar correo
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Error al enviar el correo: " . $mail->ErrorInfo;
    }
}
