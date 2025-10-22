<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'desarrollolibre';

$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
$pdoOptions = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $password, $pdoOptions);
} catch (Exception $e) {
    throw new RuntimeException('No se pudo conectar a la base de datos.');
}
?>