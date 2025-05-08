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

        // Configuración adicional
        $mail->CharSet = 'UTF-8'; // Configurar la codificación UTF-8

        // Formato del correo
        $mail->isHTML(true);
        $mail->Body = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; padding: 20px;'>
                <!-- Header -->
                <div style='background-color: #0046ad; padding: 20px; text-align: center; color: #ffffff;'>
                    <h1 style='margin: 0; font-size: 24px;'>¡Gracias por tu inscripción!</h1>
                </div>

                <!-- Body -->
                <div style='background-color: #ffffff; padding: 20px; border-radius: 8px; margin-top: 20px;'>
                    <p style='font-size: 18px; color: #333;'>
                        Hola, <strong>$nombre</strong>,
                    </p>
                    <p style='font-size: 16px; color: #555;'>
                        Hemos recibido tu solicitud de inscripción al curso <strong>$curso</strong>. A continuación, encontrarás los detalles de tu inscripción:
                    </p>

                    <!-- Detalles del curso -->
                    <h3 style='color: #333; font-size: 18px; margin-bottom: 10px;'>Detalles del curso:</h3>
                    <ul style='list-style: none; padding: 0; font-size: 16px; color: #555;'>
                        <li><strong>Curso:</strong> $curso</li>
                        <li><strong>Precio:</strong> $$precio USD</li>
                        <li><strong>Estado:</strong> Pendiente de pago</li>
                    </ul>

                    <!-- Botón de pago -->
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='$enlacePago' style='display: inline-block; background-color: #0046ad; color: #ffffff; text-decoration: none; padding: 15px 30px; font-size: 18px; font-weight: bold; border-radius: 5px;'>
                            Realizar Pago
                        </a>
                    </div>

                    <p style='font-size: 16px; color: #555;'>
                        Una vez que el pago sea validado, recibirás una confirmación por correo electrónico.
                    </p>
                </div>

                <!-- Footer -->
                <div style='text-align: center; padding: 10px; background-color: #f4f4f4; color: #777; font-size: 14px; margin-top: 20px;'>
                    <p style='margin: 0;'>Si tienes alguna pregunta, no dudes en contactarnos.</p>
                    <p style='margin: 0; font-size: 12px; color: #999;'>
                        © 2025 Equipo de Capacitación. Todos los derechos reservados.
                    </p>
                </div>
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

    global $pdo; // Asegúrate de tener acceso a la conexión PDO

    try {
        // Crear una nueva sesión de Stripe
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

        // Verificar si ya existe un registro con el mismo session_id
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM inscripciones WHERE session_id = ?");
        $stmt->execute([$session->id]);
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            throw new Exception("El session_id ya existe en la base de datos. Intenta nuevamente.");
        }

        // Guardar el session_id en la base de datos
        $stmt = $pdo->prepare("INSERT INTO inscripciones (nombre, email, telefono, curso, session_id, estado) VALUES (?, ?, ?, ?, ?, ?)");
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null; // Define $telefono from POST or set to null
        $stmt->execute([$nombre, $email, $telefono, $curso, $session->id, 'pendiente']);

        return $session->url;
    } catch (Exception $e) {
        return "Error al generar el enlace de pago: " . $e->getMessage();
    }
}
