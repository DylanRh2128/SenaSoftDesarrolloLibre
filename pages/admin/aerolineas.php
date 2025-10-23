<?php
include "../../conexion.php";

// Obtener aerolíneas
$aerolineas = [];
$sql = "SELECT idAerolinea, nombreAerolinea, email, nit, direccion, password FROM aerolinea";
$res = mysqli_query($conexion, $sql);
if ($res && mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $aerolineas[] = $row;
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Aerolíneas - Panel Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f8fa;
        }

        .navbar {
            background-color: #004a99 !important;
        }

        .navbar .nav-link {
            color: #fff !important;
            margin-right: 10px;
        }

        .navbar .nav-link:hover {
            color: #ffca28 !important;
        }

        .container h1 {
            color: #004a99;
            font-weight: 600;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        .table th {
            background-color: #004a99;
            color: white;
        }

        .btn-primary {
            background-color: #004a99;
            border: none;
        }

        .btn-primary:hover {
            background-color: #003870;
        }

        .btn-warning {
            color: #000;
        }

        .form-section {
            margin-top: 40px;
            padding: 30px;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-light fw-bold" href="admin.php">SENASOFT | ADMIN</a>
            <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navmenu" aria-controls="navmenu" aria-expanded="false"
                aria-label="Toggle navigation">
                ☰
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="roles.php">Roles</a></li>
                    <li class="nav-item"><a class="nav-link" href="aerolineas.php">Aerolíneas</a></li>
                    <li class="nav-item"><a class="nav-link" href="modeloAviones.php">Modelos</a></li>
                    <li class="nav-item"><a class="nav-link" href="aviones.php">Aviones</a></li>
                    <li class="nav-item"><a class="nav-link" href="pasajeros.php">Pasajeros</a></li>
                    <li class="nav-item"><a class="nav-link" href="disponibilidad.php">Disponibilidad</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservas.php">Reservas</a></li>
                    <li class="nav-item"><a class="nav-link" href="tiquetes.php">Tiquetes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="mb-4">Gestión de Aerolíneas</h1>

        <div class="card mb-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre Aerolínea</th>
                                <th>Correo</th>
                                <th>NIT</th>
                                <th>Dirección</th>
                                <th>Contraseña</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($aerolineas)): ?>
                                <?php foreach ($aerolineas as $a): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($a['idAerolinea']) ?></td>
                                        <td class="fw-semibold"><?= htmlspecialchars($a['nombreAerolinea']) ?></td>
                                        <td><?= htmlspecialchars($a['email']) ?></td>
                                        <td><?= htmlspecialchars($a['nit']) ?></td>
                                        <td><?= htmlspecialchars($a['direccion']) ?></td>
                                        <td><?= htmlspecialchars($a['password']) ?></td>
                                        <td>
                                            <a href="../../src/admin/editar-aerolinea.php?idAerolinea=<?= $a['idAerolinea']; ?>"
                                                class="btn btn-sm btn-warning">Editar</a>
                                            <a href="../../src/admin/eliminar-aerolinea.php?idAerolinea=<?= $a['idAerolinea']; ?>"
                                                class="btn btn-sm btn-danger ms-2">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-muted py-4">
                                        <i class="bi bi-exclamation-circle me-2"></i>No hay aerolíneas registradas.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- FORMULARIO -->
        <div class="form-section">
            <h3 class="mb-3 text-center text-primary">Crear Nueva Aerolínea</h3>
            <form action="../../src/admin/crear_aerolinea.php" method="post" class="row g-3 justify-content-center">
                <div class="col-md-4">
                    <input name="nombreAerolinea" type="text" class="form-control" placeholder="Nombre Aerolínea" required>
                </div>
                <div class="col-md-4">
                    <input name="email" type="email" class="form-control" placeholder="Correo" required>
                </div>
                <div class="col-md-4">
                    <input name="nit" type="number" class="form-control" placeholder="NIT" required>
                </div>
                <div class="col-md-4">
                    <input name="direccion" type="text" class="form-control" placeholder="Dirección" required>
                </div>
                <div class="col-md-4">
                    <input name="password" type="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary px-4">Agregar Aerolínea</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
