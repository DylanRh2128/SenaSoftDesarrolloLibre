<?php
include "../../conexion.php";

// Consultar roles
$roles = [];
$sql = "SELECT idRol, nombreRol FROM roles";
$res = mysqli_query($conexion, $sql);
if ($res && mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $roles[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Roles - SENASOFT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/register.css">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg header">
        <div class="container">
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="roles.php">Roles</a></li>
                    <li class="nav-item"><a class="nav-link" href="aerolineas.php">Aerolíneas</a></li>
                    <li class="nav-item"><a class="nav-link" href="modeloAviones.php">Modelo Aviones</a></li>
                    <li class="nav-item"><a class="nav-link" href="aviones.php">Aviones</a></li>
                    <li class="nav-item"><a class="nav-link" href="pasajeros.php">Pasajeros</a></li>
                    <li class="nav-item"><a class="nav-link" href="disponibilidad.php">Disponibilidad</a></li>
                    <li class="nav-item"><a class="nav-link" href="reservas.php">Reservas</a></li>
                    <li class="nav-item"><a class="nav-link" href="tiquetes.php">Tiquetes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container py-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold text-primary">Gestión de Roles</h1>
            <p class="text-muted">Consulta, edita o crea nuevos roles del sistema</p>
        </div>

        <!-- Tabla de roles -->
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($roles)): ?>
                                <?php foreach ($roles as $r): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($r['idRol']) ?></td>
                                        <td><?= htmlspecialchars($r['nombreRol']) ?></td>
                                        <td>
                                            <a href="../../src/admin/editar-roles.php?idRol=<?= $r['idRol'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                            <a href="../../src/admin/eliminar-roles.php?idRol=<?= $r['idRol'] ?>" class="btn btn-sm btn-danger ms-2">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-muted py-3">No hay roles registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Formulario crear rol -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h3 class="text-center text-primary mb-4">Crear Nuevo Rol</h3>
                <form action="../../src/admin/crear_roles.php" method="post" class="row g-3 justify-content-center">
                    <div class="col-md-6">
                        <input name="nombreRol" type="text" class="form-control" required placeholder="Nombre del rol">
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-success px-5 mt-3">Crear Rol</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
