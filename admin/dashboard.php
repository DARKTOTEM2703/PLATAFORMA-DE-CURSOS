<?php
require_once 'elements/validationSession.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="js/inactivity.js" defer></script>
</head>

<body>
    <?php
    include 'elements/headeradmin.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <?php
            include 'elements/sidebar.php';
            ?>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 py-1 border main-content">
                <h2 class="text-center">Pagina de Inicio del Panel</h2>
                <div class="d-flex justify-content-center mt-4">
                    <img src="img/foto_admin.jpg" alt="Panel Image" class="img-fluid">
                </div>

            </main>
        </div>
    </div>
</body>

</html>