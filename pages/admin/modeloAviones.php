<?php
include "../../conexion.php";

$id = $_GET['idModeloA'] ?? null;
if (!$id) {
    header('Location: ../../pages/admin/modeloAviones.php');
    exit;
}

$sql = "SELECT idModeloA, modelo, capacidad FROM modeloaviones WHERE idModeloA = ?";
if ($stmt = mysqli_prepare($conexion, $sql)) {
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
} else {
    die('Error al obtener el modelo');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $modelo = $_POST['modelo'] ?? '';
    $capacidad = $_POST['capacidad'] ?? 0;

    $update = "UPDATE modeloaviones SET modelo = ?, capacidad = ? WHERE idModeloA = ?";
    if ($stmt = mysqli_prepare($conexion, $update)) {
        mysqli_stmt_bind_param($stmt, 'sii', $modelo, $capacidad, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../../pages/admin/modeloAviones.php');
        exit;
    } else {
        $error = 'Error al actualizar';
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Editar Modelo de Avión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-lg header bg-primary navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Panel Admin</a>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="roles.php">Roles</a></li>
                <li class="nav-item"><a class="nav-link" href="aerolineas.php">Aerolineas</a></li>
                <li class="nav-item"><a class="nav-link active" href="modeloAviones.php">Modelo aviones</a></li>
                <li class="nav-item"><a class="nav-link" href="aviones.php">Aviones</a></li>
                <li class="nav-item"><a class="nav-link" href="pasajeros.php">Pasajeros</a></li>
                <li class="nav-item"><a class="nav-link" href="disponibilidad.php">Disponibilidad</a></li>
                <li class="nav-item"><a class="nav-link" href="reservas.php">Reservas</a></li>
                <li class="nav-item"><a class="nav-link" href="tiquites.php">Tiquetes</a></li>
            </ul>
        </div>
    </div>
</nav>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-header text-white bg-primary">
                <h4 class="mb-0">Editar Modelo de Avión</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="post" class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Modelo</label>
                        <input name="modelo" class="form-control" value="<?= htmlspecialchars($row['modelo']) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Capacidad</label>
                        <input name="capacidad" type="number" min="1" class="form-control" value="<?= htmlspecialchars($row['capacidad']) ?>" required>
                    </div>
                    <div class="col-12 d-flex justify-content-between mt-4">
                        <a href="../../pages/admin/modeloAviones.php" class="btn btn-secondary">Volver</a>
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
