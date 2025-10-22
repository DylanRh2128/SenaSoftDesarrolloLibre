<?php
include '../conexion.php';
$nombres=trim($_POST['nombre']);
$primerApellido=trim($_POST['primerApellido']);
$segundoApellido=trim($_POST['segundoApellido']);
$tipoDocumento=trim($_POST['tpDocumento']);
$documento=trim($_POST['documento']);
$genero=trim($_POST['genero']);
$fechNacimiento=trim($_POST['nacimiento']);
$celular=trim($_POST['celular']);
$email=trim($_POST['email']);
$password=trim($_POST['password']);
$idRol='3';


$sql = "INSERT INTO pasajeros (nombres, primerApellido, segundoApellido, fechNacimiento, genero, tipoDocumento, documento, celular, email, password, idRol)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssssssssi", $nombres, $primerApellido, $segundoApellido, $fechNacimiento, $genero, $tipoDocumento, $documento, $celular, $email, $password, $idRol);
$stmt->execute();


if ($stmt->affected_rows > 0) {
    echo "<script>alert('Usuario registrado correctamente.');location.assign('../pages/login.php');</script>";
}

$stmt->close();
$conexion->close();
?>
