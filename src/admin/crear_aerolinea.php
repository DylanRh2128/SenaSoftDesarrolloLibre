<?php
include('../../conexion.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/admin/aerolineas.php');
    exit;
}

$nombre = $_POST['nombreAerolinea'] ?? '';
$email = $_POST['email'] ?? '';
$nit = $_POST['nit'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$password = $_POST['password'] ?? '';

if ($nombre === '' || $email === '') {
    die('Nombre y correo son requeridos');
}

$sql = "INSERT INTO aerolinea (nombreAerolinea, email, nit, direccion, password) VALUES (?, ?, ?, ?, ?)";
if ($stmt = mysqli_prepare($conexion, $sql)) {
    mysqli_stmt_bind_param($stmt, 'sssss', $nombre, $email, $nit, $direccion, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ../../pages/admin/aerolineas.php');
    exit;
} else {
    die('Error al preparar inserción');
}

?>