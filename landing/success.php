<?php
require '../vendor/autoload.php'; // Asegúrate de que Dotenv esté disponible
use Dotenv\Dotenv;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use Stripe\Stripe;
use Stripe\Checkout\Session;

// Configurar la clave secreta de Stripe
Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

// Obtener el ID de la sesión desde la URL
$sessionId = $_GET['session_id'] ?? null;

if ($sessionId) {
    try {
        // Recuperar la sesión de Stripe
        $session = Session::retrieve($sessionId);

        // Mostrar detalles del pago
        $customerEmail = $session->customer_email;
        $paymentStatus = $session->payment_status;
    } catch (Exception $e) {
        $error = "Error al recuperar la sesión de pago: " . $e->getMessage();
    }
} else {
    $error = "No se proporcionó un ID de sesión.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/success.css">


<body>
    <div class="card">
        <?php if (isset($error)): ?>
        <h1 class="text-danger">¡Error!</h1>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php else: ?>
        <h1>¡Pago Exitoso!</h1>
        <p>Gracias por tu pago, <strong><?= htmlspecialchars($customerEmail) ?></strong>.</p>
        <p>Estado del pago: <strong><?= htmlspecialchars($paymentStatus) ?></strong>.</p>
        <a href="../landing/index.php" class="btn btn-primary">Volver al inicio</a>
        <?php endif; ?>
    </div>
</body>

</html>