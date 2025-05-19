<?php
// db_connect.php
$host = 'localhost';
$db   = 'pc_configurator';  // Имя твоей базы
$user = 'root';       // Имя пользователя MySQL
$pass = '';           // Пароль MySQL
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Для удобства отладки
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    exit('Ошибка подключения к базе: ' . $e->getMessage());
}
