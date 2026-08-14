<?php
try {
    $dbHost = '127.0.0.1';
    $dbPort = '3306';
    $dbName = 'disajcal_solicitud_soporte';
    $dbUser = 'root';
    $dbPass = '';

    $dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $stmt = $pdo->prepare("DESCRIBE empleados");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        if ($row['Field'] == 'foto') {
            echo "Columna foto existe. Tipo: " . $row['Type'] . "\n";
        }
    }

    $stmt2 = $pdo->prepare("SELECT length(foto), foto FROM empleados WHERE cedulaE = '1061429858'");
    $stmt2->execute();
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    echo "Length de foto: " . var_export($row2['length(foto)'], true) . "\n";
    echo "Contenido de foto: " . var_export($row2['foto'], true) . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
