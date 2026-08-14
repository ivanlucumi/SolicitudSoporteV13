<?php
try {
    $dbPath = __DIR__ . '/../database/database.sqlite';
    $envPath = __DIR__ . '/../.env';
    
    // Parse .env
    $dbHost = '127.0.0.1';
    $dbPort = '3306';
    $dbName = 'disajcal_solicitud_soporte';
    $dbUser = 'root';
    $dbPass = '';

    $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $stmt = $pdo->prepare("SELECT * FROM empleados WHERE cedulaE = '1061429858'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        echo "Empleado Encontrado:\n";
        echo "Foto: " . $row['foto'] . "\n";
    } else {
        echo "Empleado No Encontrado\n";
    }

    $stmt2 = $pdo->prepare("SELECT * FROM conductores WHERE cedula = '1061429858'");
    $stmt2->execute();
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    if ($row2) {
        echo "Conductor Encontrado:\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
