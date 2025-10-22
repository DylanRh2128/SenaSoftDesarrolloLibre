<?php
    $local="localhost";
    $user="root";
    $pass="";
    $base="desarolllolibre";
    $conexion= mysqli_connect($local,$user,$pass,$base);

    if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
echo "¡Conexión exitosa!";
?>