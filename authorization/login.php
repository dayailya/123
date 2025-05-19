<?php
session_start();
require_once 'db_connect.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_or_email = trim($_POST['username_or_email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username_or_email || !$password) {
        $error = 'Введите имя пользователя (или email) и пароль.';
    } else {
        // Ищем пользователя по username или email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username_or_email, $username_or_email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Успешный вход — сохраняем в сессию
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Перенаправляем в личный кабинет или главную
            header('Location: index.php');
            exit;
        } else {
            $error = 'Неверное имя пользователя/email или пароль.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Вход</title>
</head>
<body>
<h2>Вход</h2>

<?php if ($error): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="login.php">
    <label>Имя пользователя или email:<br>
        <input type="text" name="username_or_email" value="<?= htmlspecialchars($username_or_email ?? '') ?>" required>
    </label><br><br>
    <label>Пароль:<br>
        <input type="password" name="password" required>
    </label><br><br>
    <button type="submit">Войти</button>
</form>

<p><a href="register.php">Нет аккаунта? Зарегистрироваться</a></p>
</body>
</html>
