<?php

// Fichero de conexión : pdo_bind_connection.php
$host = 'localhost';
$dbname = 'tareas_andres_diaz';
$port = 3307;
$username = 'tareas';
$password = '13579#Aeiou';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
// Hay que ver que hacemos con el options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Usamos un try-catch para validar la conexión
try {
    $conn = new PDO($dsn, $username, $password, $options);
    // echo "Conexión exitosa a la base de datos.";
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
    echo "Error de conexión: " . $e->getMessage();
    exit();
}