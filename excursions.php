<!DOCTYPE html>
<html>
<head>
    <title>Админка для экскурсий</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<h1>Добавить и управлять экскурсиями</h1>

<!-- Форма для добавления экскурсии -->
<h2>Добавить экскурсию</h2>
<form action="excursions.php" method="post">
    <label for="name">Название экскурсии:</label>
    <input type="text" name="name" required><br>

    <label for="date">Дата:</label>
    <input type="date" name="date" required><br>

    <input type="submit" value="Добавить">
</form>

<?php
include '../metrics.php';
require '../connection.php';

session_start();
if (!$_SESSION['isAdmin']) {
    header("Location: /");
    exit();
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

// Обработка добавления экскурсии
if (isset($_POST['name']) && isset($_POST['date'])) {
    $name = $_POST['name'];
    $date = strtotime($_POST['date']);
    $addQuery = "INSERT INTO excursions (name, date) VALUES (?, ?)";
    $stmt = $db->prepare($addQuery);
    if ($stmt->execute([$name, $date])) {
        echo "Экскурсия успешно добавлена!";
    } else {
        echo "Ошибка при добавлении экскурсии: " . $stmt->errorInfo()[2];
    }
}

// Запрос для выборки всех экскурсий
$selectQuery = "SELECT * FROM excursions";
$result = $db->query($selectQuery);

if ($result->rowCount() > 0) {
    echo "<h2>Существующие экскурсии:</h2>";
    echo "<ul>";
    foreach ($result as $row) {
        echo "<li>{$row['name']} (Дата: " . date('d.m.Y', $row['date']) . ")";
        echo " <form method='post' action='admin.php' style='display: inline;'>";
        echo "<input type='hidden' name='delete' value='{$row['id']}'>";
        echo "<input type='submit' value='Удалить'></form></li>";
    }
    echo "</ul>";
} else {
    echo "Нет существующих экскурсий.";
}

// Закрытие соединения
$pdo = null;
?>
</body>
</html>
