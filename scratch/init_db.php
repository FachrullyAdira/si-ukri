<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE DATABASE IF NOT EXISTS si_ukri_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    echo "DATABASE si_ukri_db CREATED OR ALREADY EXISTS\n";
    
    // Check tables
    $pdo->exec('USE si_ukri_db');
    $stmt = $pdo->query('SHOW TABLES');
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables in si_ukri_db (" . count($tables) . "): " . implode(', ', $tables) . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
