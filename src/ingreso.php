<?php

include ("../conexion.php");

$email = $_POST["email"] ?? '';
$pass  = $_POST["pass"] ?? '';


// Validaciones simples
if ($email === '' || $pass === '') {
    echo "Por favor complete todos los campos.";
    exit();
}

$sql = "SELECT p.nombres, p.primerApellido, r.nombreRol FROM pasajeros p JOIN roles r ON p.idRol = r.idRol WHERE p.email = ? AND p.password = ?";

if ($stmt = $conexion->prepare($sql)) {
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();
        $nombre_pasajero = $fila['nombres'];
        $apellido_pasajero = $fila['primerApellido'];
        $nombre_rol = $fila['nombreRol'];

        switch ($nombre_rol) {
            case 'admin':
                header("Location: ../pages/admin/admin.php");
                exit();
            case 'aerolinea':
                header("Location: ../pages/aerolinea/aerolinea.php");
                exit();
            case 'pasajero':
                header("Location: ../pages/user/user.php");
                exit();

            default:
                echo "Rol no reconocido.";
                exit();
        }
    } else {
        echo "Credenciales inválidas. Por favor, intente de nuevo.";
        exit();
    }

    $stmt->close();
} else {
    echo "Error en la preparación de la consulta.";
    exit();
}

?>
