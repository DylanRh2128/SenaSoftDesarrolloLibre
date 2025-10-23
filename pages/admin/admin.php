<?php
session_start();
include('../../conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - SENASOFT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body class="bg-light">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SENASOFT <span class="text-warning">ADMIN</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="admin.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="pasajeros.php">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="roles.php">Roles</a></li>
                    <li class="nav-item"><a class="nav-link" href="aerolineas.php">Aerolíneas</a></li>
                    <li class="nav-item"><a class="nav-link" href="disponibilidad.php">Vuelos</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservas.php">Reservas</a></li>
                    <li class="nav-item"><a class="nav-link" href="aviones.php">Aviones</a></li>
                    <li class="nav-item"><a class="nav-link" href="tiquetes.php">Tiquetes</a></li>
                    <li class="nav-item"><a class="nav-link" href="asientos.php">Asientos</a></li>
                </ul>
                <?php if (!empty($_SESSION['user_email'])): ?>
                    <div class="d-flex align-items-center ms-3">
                        <span class="text-white me-2">👤 <?= htmlspecialchars($_SESSION['user_email']) ?></span>
                        <a href="logout.php" class="btn btn-sm btn-outline-light">Cerrar sesión</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="container py-5">
        <div class="card shadow-lg border-0">
            <div class="card-body text-center py-5">
                <h1 class="fw-bold text-primary">Bienvenido, Administrador 👋</h1>
                <p class="lead text-muted mt-3">
                    Desde este panel puedes gestionar <strong>usuarios</strong>, <strong>aerolíneas</strong>, 
                    <strong>vuelos</strong>, <strong>reservas</strong>, y mucho más.
                </p>

                <hr class="my-4">

                <div class="row g-4 mt-3">
                    <div class="col-md-3 col-sm-6">
                        <a href="pasajeros.php" class="btn btn-outline-primary w-100 py-3">
                            👥 Gestionar Usuarios
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="aerolineas.php" class="btn btn-outline-success w-100 py-3">
                            ✈️ Aerolíneas
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="disponibilidad.php" class="btn btn-outline-warning w-100 py-3">
                            🕓 Vuelos
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="reservas.php" class="btn btn-outline-danger w-100 py-3">
                            🎟️ Reservas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center py-4 mt-5 bg-primary text-white">
        <p class="mb-0">© 2025 SENASOFT - Panel de Administración</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
         </div>
        </div>
</body>
</html>