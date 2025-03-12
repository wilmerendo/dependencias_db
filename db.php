<?php
$servername = "mysql"; // Cambia "localhost" por "mysql" (nombre del servicio)
$username = "Admin";
$password = "Admin@2025";
$dbname = "dependencias_db";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}