<?php
include '../metrics.php';
require '../connection.php';

session_start();

if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    header("Location: /");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка отправки формы добавления экскурсии
    if (isset($_POST['name'], $_POST['datetime'])) {
        $name = $_POST['name'];
        $datetime = strtotime($_POST['datetime']);

        $insertQuery = "INSERT INTO excursions (name, date) VALUES (?, ?)";
        $stmt = $db->prepare($insertQuery);

        if ($stmt->execute([$name, $datetime])) {
            echo "Экскурсия успешно добавлена!";
        } else {
            echo "Ошибка при добавлении экскурсии: " . $stmt->errorInfo()[2];
        }
    }

    // Обработка удаления экскурсии
    if (isset($_POST['delete'])) {
        $excursionId = $_POST['delete'];
        $deleteQuery = "DELETE FROM excursions WHERE id = ?";
        $stmt = $db->prepare($deleteQuery);

        if ($stmt->execute([$excursionId])) {
            echo "Экскурсия успешно удалена!";
        } else {
            echo "Ошибка при удалении экскурсии: " . $stmt->errorInfo()[2];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Админка для экскурсий</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .button-container a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
        }
    </style>

</head>
<body>
<h1>ЭКСКУРСИИ</h1>
<div class="container">
    <!-- Форма для добавления экскурсии -->
    <h2>Добавить экскурсию</h2>
    <form action="excursions.php" method="post">
        <label for="name">Название экскурсии:</label>
        <input type="text" name="name" required>

        <label for="datetime">Дата и время:</label>
        <input type="datetime-local" name="datetime" required>

        <input type="submit" value="Добавить">
    </form>

    <!-- Существующие экскурсии в виде таблицы -->
    <?php
    $currentTime = time();
    $resCurrent = $db->prepare("SELECT * FROM excursions WHERE date > ? ORDER BY date");
    $resCurrent->execute([$currentTime]);
    $resultCurrent = $resCurrent->fetchAll();

    $resPast = $db->prepare("SELECT * FROM excursions WHERE date <= ? ORDER BY date");
    $resPast->execute([$currentTime]);
    $resultPast = $resPast->fetchAll();
    ?>
    <h2>Текущие экскурсии:</h2>
    <table>
        <thead>
        <tr>
            <th>Название экскурсии</th>
            <th>Дата и время</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($resultCurrent as $row) {
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td>" . date('d.m.Y H:i', $row['date']) . "</td>";
            echo "<td>";
            echo "<form method='post' action='events.php'>";
            echo "<input type='hidden' name='delete' value='{$row['id']}'>";
            echo "<input type='submit' value='Удалить'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <h2>Прошедшие экскурсии:</h2>
    <table>
        <thead>
        <tr>
            <th>Название экскурсии</th>
            <th>Дата и время</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($resultPast as $row) {
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td>" . date('d.m.Y H:i', $row['date']) . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table><br>
    <!-- Кнопка "Просмотр зарегистрированных" -->
    <div class="button-container">
        <a href="excursions_view.php">Просмотр зарегистрированных</a>
    </div>
</div>
</body>
</html>
