<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $build_name = trim($_POST['build_name'] ?? '');
    $components_json = $_POST['components_json'] ?? '';

    if (!$build_name || !$components_json) {
        exit('Ошибка: заполните все поля сборки.');
    }

    $stmt = $pdo->prepare("INSERT INTO builds (user_id, build_name, components_json, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$user_id, $build_name, $components_json]);

    echo "Сборка успешно сохранена.";
} else {
    exit('Неверный метод запроса.');
}
