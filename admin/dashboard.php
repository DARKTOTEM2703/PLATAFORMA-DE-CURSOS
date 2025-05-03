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
</head>

<body>
    <header class="bg-primary text-white text-center py-3 mb-5">
        <h1 class="m-0">PANEL ADMINISTRATIVO</h1>
    </header>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 bg-primary sidebar py-4">
                <ul class="nav flex-column text-white">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">>> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">>> Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">>> Usuarios</a>
                    </li>
                </ul>
                <div class="text-center mt-4">
                    <button class="btn btn-danger w-75">X Cerrar Sesión</button>
                </div>
            </nav>
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