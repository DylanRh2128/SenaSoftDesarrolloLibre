<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear cuenta - Agencia de viajes</title>
  <link rel="stylesheet" href="..//css/register.css">
</head>
<body>

  <div class="contenedor">
    <div class="formulario">
      <h2>Crear una cuenta</h2>
      <form>
        <input type="text" placeholder="Nombres">
        <input type="text" placeholder="Primer Apellido">
        <input type="text" placeholder="Segundo Apellido">
        <input type="date" placeholder="Fecha de Nacimiento">
        <select>
          <option value="">Género</option>
          <option value="masculino">Masculino</option>
          <option value="femenino">Femenino</option>
        </select>
        <select>
          <option value="">Tipo de Documento</option>
          <option value="cc">Cédula</option>
          <option value="ti">Tarjeta de Identidad</option>
        </select>
        <input type="text" placeholder="Documento">
        <input type="tel" placeholder="Celular">
        <input type="email" placeholder="Correo">
        <input type="text" placeholder="Rol">
        <input type="password" placeholder="Contraseña">
      </form>
    </div>

    <div class="derecha">
      <button class="btn-crear">Crear Cuenta</button>
      <p class="texto-condiciones">
        Debes aceptar nuestros <a href="#">términos y condiciones</a>
      </p>
      <p class="login-link">
        ¿Ya tienes una cuenta registrada? <a href="./login.php" style="color: var(--color-primario); font-weight: bold;">Iniciar sesión</a>
      </p>
    </div>
  </div>

</body>
</html>
