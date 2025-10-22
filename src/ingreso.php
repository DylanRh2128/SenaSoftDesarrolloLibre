<?php

include ("../conexion.php");

$email = $_POST["email"];
$pass = $_POST["pass"];

// Consulta para obtener el rol del usuario
$sql = "SELECT p.nombres, r.nombreRol FROM pasajeros p JOIN roles r ON p.idrRol = r.idRol WHERE p.email = ? AND p.password = ?";


$nombre_pasajero = null;


if ($stmt = $conexion->prepare($sql)) {
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1){
        $fila = $resultado->fetch_assoc();
        $nombre_pasajero = $fila['nombres'];

        echo "El usuario que ingresó es: " . $nombre_pasajero;
    }
    $stmt->close();
}




?>

