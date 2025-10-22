<?php
    include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SENASOFT - Vuelos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/coloresGblo.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark header">
        <div class="container">
            <a class="navbar-brand" href="#">SENAPORC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <?php if (!empty($_SESSION['user_email'])): ?>
                        <li class="nav-item me-3"><span class="small-muted">Hola, <?= htmlspecialchars($_SESSION['user_email']) ?></span></li>
                        <li class="nav-item"><a class="btn btn-outline-secondary" href="logout.php">Cerrar sesión</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="pages/login.php">Iniciar sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages/register.php">Crear cuenta</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Nosotros</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </nav>
    <header class="py-5">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-5 fw-bold">Encuentra vuelos al mejor precio</h1>
                    <p class="lead small-muted">Busca y compara vuelos nacionales e internacionales. Promociones actualizadas diariamente.</p>
                </div>

                <div class="col-lg-5">
                    <div class="form-card">
                        <form method="get" action="pages/vuelos.php" class="row g-2">
                            <div class="col-12">
                                <label class="form-label">Origen</label>
                                <input name="origen" class="form-control" placeholder="Ciudad o aeropuerto" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Destino</label>
                                <input name="destino" class="form-control" placeholder="Ciudad o aeropuerto" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Fecha ida</label>
                                <input type="date" name="fecha_ida" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Fecha vuelta</label>
                                <input type="date" name="fecha_vuelta" class="form-control">
                            </div>
                            <!-- Campo de pasajeros eliminado: ya no se envía al buscar -->
                            <div class="col-6 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Buscar vuelos</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </header>
    <main class="py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h4>Destinos populares</h4>
                        <small class="small-muted">Explora los destinos más reservados</small>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        <?php if (!empty($destinos)): ?>
                            <?php foreach ($destinos as $d): ?>
                                <div class="col">
                                    <div class="card destino-card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-1"><?= htmlspecialchars($d['name']) ?></h5>
                                            <p class="card-text small-muted mb-1"><?= htmlspecialchars($d['country']) ?></p>
                                            <p class="card-text"><?= htmlspecialchars($d['short_description']) ?></p>
                                            <a href="resultados.php?destino=<?= urlencode($d['name']) ?>" class="stretched-link"></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            
                            <?php for ($i = 0; $i < 4; $i++): ?>
                                <div class="col">
                                    <div class="card destino-card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-1">Destino Ejemplo</h5>
                                            <p class="card-text small-muted mb-1">País Ejemplo</p>
                                            <p class="card-text">Descripción breve del destino. Información destacada y atractiva.</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <aside class="col-12 col-lg-4">
                    <div class="mb-4">
                        <h5>Promociones activas</h5>
                        <?php if (!empty($promociones)): ?>
                            <?php foreach ($promociones as $promo): ?>
                                <div class="card card-promo mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title"><?= htmlspecialchars($promo['title']) ?></h6>
                                        <p class="card-text small-muted"><?= htmlspecialchars($promo['subtitle']) ?></p>
                                        <p class="mb-0"><strong><?= htmlspecialchars($promo['discount_text']) ?></strong></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="card card-promo mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Promo de lanzamiento</h6>
                                    <p class="card-text small-muted">Descuentos exclusivos por tiempo limitado.</p>
                                    <p class="mb-0"><strong>Hasta 30% OFF</strong></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>



                    <div class="mb-3">
                        <h6>Información rápida</h6>
                        <p class="small-muted">Políticas de equipaje, cambios y asistencia 24/7. Consulta términos antes de viajar.</p>
                    </div>
                </aside>

            </div>
    </div>
  </main>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6 small-muted">
                    © <?= date('Y') ?> SENAPORC. Todos los derechos reservados.
                </div>
                <div class="col-md-6 text-md-end small-muted">
                    Soporte: soporte@example.com
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>