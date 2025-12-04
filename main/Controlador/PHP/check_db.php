<?php
require "conexionclases.php";

$db = new Conexion();
$pdo = $db->getConexion();

$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

foreach ($tables as $table) {
    echo "Table: $table\n";
    $columns = $pdo->query("DESCRIBE $table")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($columns as $col) {
        echo "  - " . $col['Field'] . " (" . $col['Type'] . ")\n";
    }
    echo "\n";
}
