<?php

include ("../conexion.php");

$email = $_POST["email"];
$pass  = $_POST["pass"];


// Validaciones simples
if ($email === '' || $pass === '') {
    echo "Por favor complete todos los campos.";
    exit();
}

// Consulta para obtener el rol del usuario
$sql = "SELECT p.nombres, p.primerApellido, r.nombreRol FROM pasajeros p JOIN roles r ON p.idrRol = r.idRol WHERE p.email = ? AND p.password = ?";

if ($stmt = $conexion->prepare($sql)) {
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();
        $nombre_pasajero = $fila['nombres'];
        $apellido_pasajero = $fila['primerApellido'];
        $nombre_rol = $fila['nombreRol'];

        // Manejo por rol (5 casos). Ajusta las rutas según tu proyecto.
        switch ($nombre_rol) {
            case 'admin':
                header("Location: ../admin/panel_admin.php");
                exit();
            case 'Pasajero':
                header("Location: ../pasajero/panel_pasajero.php");
                exit();
            case 'Conductor':
                header("Location: ../conductor/panel_conductor.php");
                exit();
            case 'Operador':
                header("Location: ../operador/panel_operador.php");
                exit();
            case 'Supervisor':
                header("Location: ../supervisor/panel_supervisor.php");
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
