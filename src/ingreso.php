<?php
<<<<<<< HEAD
    include("./conexion.php");
=======
session_start();
require_once __DIR__ . '/conexion.php';

$error = '';
$success = '';

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $pass = isset($_POST['pass']) ? trim($_POST['pass']) : '';

    if ($email === '' || $pass === '') {
        $error = 'Por favor, completa todos los campos.';
    } else {
        if ($stmt = mysqli_prepare($con, 'SELECT id, email, password FROM usuarios WHERE email = ? LIMIT 1')) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $dbPass = $row['password'];
                $valid = password_verify($pass, $dbPass) || ($pass === $dbPass);
                if ($valid) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $success = 'Inicio de sesión exitoso.';
                } else {
                    $error = 'Credenciales inválidas.';
                }
            } else {
                $error = 'Credenciales inválidas.';
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = 'Error interno. Inténtalo más tarde.';
        }
    }
}
?>