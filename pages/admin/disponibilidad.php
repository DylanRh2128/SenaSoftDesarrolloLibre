<?php
include "../../conexion.php";

$items = [];
$sql = "SELECT idReserva, condicionInfante, iva, descuento, subtotal, idDisponibilidad, idPasajeros FROM reservas";
$res = mysqli_query($conexion, $sql);
if ($res && mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) $items[] = $row;
}

$disps = [];
$dRes = mysqli_query($conexion, "SELECT idDisponibilidad, fecha, origen, destino FROM disponibilidad ORDER BY fecha");
if ($dRes && mysqli_num_rows($dRes) > 0) {
    while ($d = mysqli_fetch_assoc($dRes)) $disps[] = $d;
}

$pasajeros = [];
$pRes = mysqli_query($conexion, "SELECT idPasajero, nombres, primerApellido FROM pasajeros ORDER BY nombres");
if ($pRes && mysqli_num_rows($pRes) > 0) {
    while ($p = mysqli_fetch_assoc($pRes)) $pasajeros[] = $p;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reservas - SENASOFT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/register.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg header">
        <div class="container">
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="roles.php">Roles</a></li>
                    <li class="nav-item"><a class="nav-link" href="aerolineas.php">Aerolíneas</a></li>
                    <li class="nav-item"><a class="nav-link" href="modeloAviones.php">Modelo Aviones</a></li>
                    <li class="nav-item"><a class="nav-link" href="aviones.php">Aviones</a></li>
                    <li class="nav-item"><a class="nav-link" href="pasajeros.php">Pasajeros</a></li>
                    <li class="nav-item"><a class="nav-link" href="disponibilidad.php">Disponibilidad</a></li>
                    <li class="nav-item"><a class="nav-link active" href="reservas.php">Reservas</a></li>
                    <li class="nav-item"><a class="nav-link" href="tiquites.php">Tiquetes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold text-primary">Gestión de Reservas</h1>
            <p class="text-muted">Consulta, edita o crea nuevas reservas</p>
        </div>

        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Infante</th>
                                <th>IVA</th>
                                <th>Descuento</th>
                                <th>Subtotal</th>
                                <th>Disponibilidad</th>
                                <th>Pasajero</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($items)): ?>
                                <?php foreach ($items as $it): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($it['idReserva']) ?></td>
                                        <td><?= htmlspecialchars($it['condicionInfante']) ?></td>
                                        <td><?= htmlspecialchars($it['iva']) ?></td>
                                        <td><?= htmlspecialchars($it['descuento']) ?></td>
                                        <td><?= htmlspecialchars($it['subtotal']) ?></td>
                                        <td><?= htmlspecialchars($it['idDisponibilidad']) ?></td>
                                        <td><?= htmlspecialchars($it['idPasajeros']) ?></td>
                                        <td>
                                            <a href="../../src/admin/editar-reservas.php?idReserva=<?= $it['idReserva'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                            <a href="../../src/admin/eliminar-reservas.php?idReserva=<?= $it['idReserva'] ?>" class="btn btn-sm btn-danger ms-2">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-muted py-4">No hay reservas registradas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3 class="mb-3 text-primary text-center">Crear nueva reserva</h3>
                <form action="../../src/admin/crear-reservas.php" method="post" class="row g-3 justify-content-center">
                    <div class="col-md-2">
                        <input name="condicionInfante" type="number" class="form-control" placeholder="Infante (0/1)" required>
                    </div>
                    <div class="col-md-2">
                        <input name="iva" type="number" step="0.01" class="form-control" placeholder="IVA" required>
                    </div>
                    <div class="col-md-2">
                        <input name="descuento" type="number" step="0.01" class="form-control" placeholder="Descuento" required>
                    </div>
                    <div class="col-md-2">
                        <input name="subtotal" type="number" step="0.01" class="form-control" placeholder="Subtotal" required>
                    </div>
                    <div class
