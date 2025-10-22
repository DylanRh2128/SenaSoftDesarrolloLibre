<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="../css/register.css" rel="stylesheet">
    <title>Registro</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Inicio</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Registro</a>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true" href="#">Nosotros</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
            </div>
        </div>
    </nav>
    <div class="body">
        <div class="box">
            <div class="tittle-box">
                <h1>REGISTRO</h1>
            </div>
        <div class="form">

        </div>
            <div class="form-register">
                <form action="../src/insert.php" method="POST">
                    <input type="text" name="nombre" placeholder="Nombre">
                    <input type="text" name="primerApellido" placeholder="Primer Apellido">
                    <input type="text" name="segundoApellido" placeholder="Segundo Apellido">
                    <input type="date" name="nacimiento" placeholder="Fecha de Nacimiento">
                    <select name="genero" id="genero" placeholder="Genero">
                        <option value="1">Hombre</option>
                        <option value="2">Mujer</option>
                        <option value="3">Otros</option>
                    </select>
                    <select name="tpDocumento" id="tpDocumento">
                        <option value="1">CC</option>
                        <option value="2">TI</option>
                        <option value="3">CDE</option>
                    </select>
                    <input type="number" name="documento" placeholder="Documento">
                    <input type="number" name="celular" placeholder="Celular">
                    <input type="text" name="email" placeholder="Correo">
                    <input type="password" name="password" placeholder="Password">
                    
                
                    <div class="form-button">
                        <button class="button" type="submit" name="enviar">REGISTRARSE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>