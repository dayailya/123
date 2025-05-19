<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<title>Главная</title>
</head>
<body>

<?php if (isset($_SESSION['user_id'])): ?>
    <p>Привет, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
    <p><a href="my_builds.php">Мои сборки</a> | <a href="logout.php">Выйти</a></p>
<?php else: ?>
    <p><a href="login.php">Войти</a> или <a href="register.php">Зарегистрироваться</a></p>
<?php endif; ?>

<h1>Добро пожаловать на сайт конфигуратора ПК!</h1>

<!-- Здесь твой контент -->

</body>
</html>
