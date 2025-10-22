
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="contenedor-principal">

        <h1 class="p-3 text-center">INGRESA SUS CREDENCIALES</h1>

    <form class="mx-auto" style="width: 500px;" action="../src/ingreso.php" method="POST">
            <div class="col-10">
                <label for="exampleInputEmail1" id class="form-label">Ingresa su correo</label>
        <input type="email" class="form-control" name="email" required>
                <label for="exampleInputEmail1" id class="form-label">Ingresa su contraseña</label>
        <input type="password" class="form-control" name="pass" required>
                <a class="text-center" href="#">Olvidaste tu contraseña?</a>
                <br> <br>   

                <button type="submit" class="btn btn-primary" style="width: 420px;">Ingresar</button>
        </form>

        <h4 class="text-center p-2" >No estas registrado? <a class="fs-3"  href="#">Crear Cuenta</a> </h4>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>