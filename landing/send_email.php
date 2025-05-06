<?php

require '../vendor/autoload.php'; // Asegúrate de instalar Stripe con Composer: composer require stripe/stripe-php

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Stripe\Stripe;
use Stripe\Checkout\Session;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

//var_dump($_ENV['STRIPE_SECRET_KEY']); // Debería mostrar la clave secreta de Stripe

function enviarCorreoConfirmacion($nombre, $email, $curso, $pago, $precio)
{
    try {
        // Generar el enlace de pago
        $enlacePago = generarEnlaceDePago($nombre, $email, $curso, $precio);

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
                <h1 style='color: #4CAF50;'>¡Inscripción Pendiente!</h1>
                <p>Hola, <strong>$nombre</strong>,</p>
                <p>Gracias por inscribirte en el curso <strong>$curso</strong>.</p>
                <p>Para completar tu inscripción, realiza el pago utilizando el siguiente enlace:</p>
                <p><a href='$enlacePago' style='color: #4CAF50; font-weight: bold;'>Realizar Pago</a></p>
                <p>Nos pondremos en contacto contigo una vez que el pago sea validado.</p>
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

function generarEnlaceDePago($nombre, $email, $curso, $precio)
{
    Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']); // Usar la clave secreta desde el archivo .env

    try {
        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $curso,
                    ],
                    'unit_amount' => $precio * 100, // Convertir a centavos
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost/Subir-Tarea-3-.--Formulario-Cursos-JS/landing/success.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://localhost/cancel.php',
        ]);

        return $session->url;
    } catch (Exception $e) {
        return "Error al generar el enlace de pago: " . $e->getMessage();
    }
}
