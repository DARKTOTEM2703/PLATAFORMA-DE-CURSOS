<?php
require '../../vendor/autoload.php';
require '../elements/db.php';

use Stripe\Stripe;
use Stripe\Webhook;
use Dotenv\Dotenv;

// Cargar las variables de entorno desde el archivo .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

// Lee el cuerpo de la solicitud
$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? null;
$endpoint_secret = $_ENV['STRIPE_WEBHOOK_SECRET'];

if (!$sig_header) {
    http_response_code(400);
    echo 'Webhook Error: Missing Stripe signature header';
    exit;
}

try {
    $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);

    if ($event->type === 'checkout.session.completed') {
        $session = $event->data->object;

        // Obtener el session_id de Stripe
        $sessionId = $session->id;

        // Actualizar el estado de la inscripción a "válido" usando el session_id
        $stmt = $pdo->prepare("UPDATE inscripciones SET estado = 'válido' WHERE session_id = ?");
        $stmt->execute([$sessionId]);

        http_response_code(200);
        echo json_encode(['status' => 'success']);
    }
} catch (\UnexpectedValueException $e) {
    http_response_code(400);
    echo 'Webhook Error: Invalid payload';
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    http_response_code(400);
    echo 'Webhook Error: Invalid signature';
}
