<?php
// Script de diagnóstico temporal
require __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$pdo = new PDO(
    'mysql:host=127.0.0.1;port=3306;dbname=disajcal_solicitud_soporte',
    'root',
    ''
);

echo "=== COLUMNAS DE PARQUEADERO ===\n";
$cols = $pdo->query("SHOW COLUMNS FROM parqueadero")->fetchAll(PDO::FETCH_ASSOC);
foreach ($cols as $col) {
    echo $col['Field'] . " (" . $col['Type'] . ")\n";
}

echo "\n=== VALORES DISTINTOS DE calidad_vehiculo ===\n";
$vals = $pdo->query("SELECT DISTINCT calidad_vehiculo, calidad FROM parqueadero LIMIT 30")->fetchAll(PDO::FETCH_ASSOC);
foreach ($vals as $v) {
    echo "calidad_vehiculo='" . $v['calidad_vehiculo'] . "' | calidad='" . $v['calidad'] . "'\n";
}

echo "\n=== REGISTROS CON 'oficial' en calidad_vehiculo o calidad (insensible) ===\n";
$rows = $pdo->query("SELECT id, placa, calidad, calidad_vehiculo, estado, nombre, cedula FROM parqueadero WHERE calidad_vehiculo LIKE '%oficial%' OR calidad LIKE '%oficial%' LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows, JSON_PRETTY_PRINT) . "\n";

echo "\n=== TOTAL REGISTROS EN PARQUEADERO ===\n";
$total = $pdo->query("SELECT COUNT(*) as cnt FROM parqueadero")->fetch(PDO::FETCH_ASSOC);
echo "Total: " . $total['cnt'] . "\n";
