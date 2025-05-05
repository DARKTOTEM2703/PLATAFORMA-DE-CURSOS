<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php
    include '../elements/header.php';
    include './components/information.php';
    ?>

    <!-- Sección de información -->
    <div class="container my-5 p-0">
        <div class="row border">
            <div class="col-md-6 p-5">
                <div class="img-container">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfv_DbdqnbRqoT3cAHzuaT3NkMmCPASpbRCA&s"
                        alt="Clase de capacitación" class="img-fluid w-100">
                    <div class="purple-triangle"></div>
                    <div class="gray-shape"></div>
                </div>
            </div>
            <div class="col-md-6 p-5">
                <div class="row border p-5">
                    <h2 class="text-center mb-4">Informacion de la escuela de capacitacion</h2>
                    <p class="text-center">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt similique animi, corrupti
                        consequuntur enim culpa beatae tempora, voluptatem nihil fugiat iste sit ad sequi perspiciatis
                        exercitationem impedit maxime, accusantium totam!
                    </p>
                    <div class="text-center mt-4">
                        <a href="inscripcion.php" class="btn btn-inscribete px-4 py-2">Inscríbete Ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include 'components/footer.php';
    ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>