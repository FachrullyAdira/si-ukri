<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    echo "CONNECTED_NO_PASSWORD\n";
    $stmt = $pdo->query('SHOW DATABASES');
    $dbs = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Databases: " . implode(', ', $dbs) . "\n";
} catch (Exception $e) {
    echo "ERR_EMPTY: " . $e->getMessage() . "\n";
}

try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', 'root');
    echo "CONNECTED_WITH_ROOT_PASSWORD\n";
} catch (Exception $e) {
    echo "ERR_ROOT: " . $e->getMessage() . "\n";
}
