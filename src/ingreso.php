<?php
session_start();
include(__DIR__ . "/../conexion.php");

$email = $_POST['email'] ?? '';
$pass  = $_POST['pass'] ?? '';

if (trim($email) === '' || trim($pass) === '') {
    echo "Por favor complete todos los campos.";
    exit();
}

// Intentamos autenticar un pasajero
$consulta = "SELECT p.idPasajero, p.nombres, p.primerApellido, r.nombreRol, p.password
             FROM pasajeros p
             JOIN roles r ON p.idrRol = r.idRol
             WHERE p.email = ?";

if ($stmt = $conexion->prepare($consulta)) {
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ((isset($user['password']) && password_verify($pass, $user['password'])) || trim($pass) === trim($user['password'])) {
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $user['nombres'] ?? '';
            $_SESSION['user_role'] = $user['nombreRol'] ?? 'pasajero';

            switch ($_SESSION['user_role']) {
                case 'admin':
                    header('Location: ../pages/admin/admin.php');
                    exit();
                case 'aerolinea':
                    header('Location: ../pages/aerolinea/aerolinea.php');
                    exit();
                case 'pasajero':
                default:
                    header('Location: ../pages/user/user.php');
                    exit();
            }
        } else {
            die('Contraseña incorrecta.');
        }
    }

    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conexion->error;
    exit();
}

// Si no se autentica como pasajero, intentamos aerolínea
$sql_aero = "SELECT idAerolinea, nombreAerolinea, password FROM aerolinea WHERE email = ?";
if ($stmt2 = $conexion->prepare($sql_aero)) {
    $stmt2->bind_param('s', $email);
    $stmt2->execute();
    $result_aero = $stmt2->get_result();

    if ($result_aero && $result_aero->num_rows === 1) {
        $aero = $result_aero->fetch_assoc();

        if ((isset($aero['password']) && password_verify($pass, $aero['password'])) || trim($pass) === trim($aero['password'])) {
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $aero['nombreAerolinea'] ?? '';
            $_SESSION['user_role'] = 'aerolinea';
            header('Location: ../pages/aerolinea/aerolinea.php');
            exit();
        } else {
            die('Contraseña incorrecta para aerolínea.');
        }
    } else {
        die('Credenciales inválidas. El usuario o aerolínea no existen.');
    }

    $stmt2->close();
} else {
    echo "Error en la preparación de la consulta (aerolinea): " . $conexion->error;
    exit();
}

?>
