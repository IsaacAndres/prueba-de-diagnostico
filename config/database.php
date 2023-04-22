<?php

// Valores de conexón
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'test_diagnostico');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO(
        'mysql:host='. DB_HOST .';dbname='. DB_NAME .';charset=utf8mb4', 
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE, 
        PDO::ERRMODE_EXCEPTION
    );
} catch(PDOException $e) {
    die('Error al conectar a la base de datos: ' . $e->getMessage());
}