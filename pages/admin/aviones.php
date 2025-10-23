<?php
include "../../conexion.php";

// Obtener los aviones
$items = [];
$sql = "SELECT idAvion, nombreAvion, idModeloA, idAerolinea FROM aviones";
$res = mysqli_query($conexion, $sql);
if ($res && mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) $items[] = $row;
}

// Obtener modelos y aerolíneas
$modelos = [];
$mRes = mysqli_query($conexion, "SELECT idModeloA, modelo FROM modeloaviones ORDER BY modelo");
if ($mRes && mysqli_num_rows($mRes) > 0) {
    while ($m = mysqli_fetch_assoc($mRes)) $modelos[] = $m;
}

$aerolineas = [];
$aRes = mysqli_query($conexion, "SELECT idAerolinea, nombreAerolinea FROM aerolinea ORDER BY nombreAerolinea");
if ($aRes && mysqli_num_rows($aRes) > 0) {
    while ($a = mysqli_fetch_assoc($aRes)) $aerolineas[] = $a;
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Aviones - Panel Admin</title>
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
        <h1 class="mb-4">Gestión de Aviones</h1>

        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Modelo</th>
                            <th>Aerolínea</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($items)): ?>
                            <?php foreach ($items as $it): ?>
                                <tr>
                                    <td><?= htmlspecialchars($it['idAvion']) ?></td>
                                    <td><?= htmlspecialchars($it['nombreAvion']) ?></td>
                                    <td><?= htmlspecialchars($it['idModeloA']) ?></td>
                                    <td><?= htmlspecialchars($it['idAerolinea']) ?></td>
                                    <td>
                                        <a href="../../src/admin/editar-aviones.php?idAvion=<?= $it['idAvion'] ?>"
                                            class="btn btn-sm btn-warning">Editar</a>
                                        <a href="../../src/admin/eliminar-aviones.php?idAvion=<?= $it['idAvion'] ?>"
                                            class="btn btn-sm btn-danger ms-2">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay aviones registrados</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <h3 class="mt-4 mb-3">Crear Nuevo Avión</h3>
        <form action="../../src/admin/crear-aviones.php" method="post" class="row g-3">
            <div class="col-md-4">
                <input name="nombreAvion" class="form-control" required placeholder="Nombre del Avión">
            </div>
            <div class="col-md-4">
                <select name="idModeloA" class="form-select" required>
                    <option value="">Seleccione modelo</option>
                    <?php foreach ($modelos as $m): ?>
                        <option value="<?= htmlspecialchars($m['idModeloA']) ?>"><?= htmlspecialchars($m['modelo']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <select name="idAerolinea" class="form-select" required>
                    <option value="">Seleccione aerolínea</option>
                    <?php foreach ($aerolineas as $a): ?>
                        <option value="<?= htmlspecialchars($a['idAerolinea']) ?>"><?= htmlspecialchars($a['nombreAerolinea']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 text-end">
                <button class="btn btn-primary">Crear Avión</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
