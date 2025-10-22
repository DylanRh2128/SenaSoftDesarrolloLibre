<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div class="contenedor-principal">
        <h1 class="p-3 text-center">INGRESA SUS CREDENCIALES</h1>

        <div class="mx-auto" style="width: 550px;">
            <?php if ($error !== ''): ?>
                <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if ($success !== ''): ?>
                <div class="alert alert-success" role="alert"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <?php if (!isset($_SESSION['user_id'])): ?>
                <form class="mx-auto p-4" style="width: 550px;" method="post" action="index.php">
                    <div class="mb-3">
                        <label class="form-label">Ingresa su correo</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ingresa su contraseña</label>
                        <input type="password" class="form-control" name="pass" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>
            <?php else: ?>
                <div class="p-4 border rounded">
                    <p class="mb-3">Has iniciado sesión como <strong><?php echo htmlspecialchars($_SESSION['email']); ?></strong>.</p>
                    <a class="btn btn-outline-secondary" href="?logout=1">Cerrar sesión</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>