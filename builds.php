<?php
// builds.php
$pdo = new PDO("mysql:host=localhost;dbname=pc_configurator;charset=utf8mb4", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$stmt = $pdo->query("SELECT id, name, price, created_at FROM builds ORDER BY created_at DESC");
$builds = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сохранённые сборки</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        form { display: inline; }
    </style>
</head>
<body>

<h1>Сохранённые сборки</h1>

<?php if (count($builds) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Имя сборки</th>
                <th>Цена</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($builds as $build): ?>
                <tr>
                    <td><?= htmlspecialchars($build['name']) ?></td>
                    <td><?= number_format($build['price'], 0, '', ' ') ?> ₽</td>
                    <td><?= htmlspecialchars($build['created_at']) ?></td>
                    <td>
                        <a href="build_detail.php?id=<?= $build['id'] ?>">Посмотреть</a>
                        |
                        <form method="POST" action="delete_build.php" onsubmit="return confirm('Удалить сборку «<?= htmlspecialchars($build['name']) ?>»?');">
                            <input type="hidden" name="id" value="<?= $build['id'] ?>">
                            <button type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Нет сохранённых сборок.</p>
<?php endif; ?>

</body>
</html>
