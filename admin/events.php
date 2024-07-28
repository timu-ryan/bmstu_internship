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
            echo "Ивент успешно добавлен!";
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
            echo "Ивент успешно удален!";
        } else {
            echo "Ошибка при удалении экскурсии: " . $stmt->errorInfo()[2];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админка для ивентов</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="bg-dark text-light">
    <div class="container mt-4">
        <h1 class="bg-primary text-white text-center p-4">ИВЕНТЫ</h1>

        <div class="container">
            <!-- Форма для добавления экскурсии -->
            <h2 class="text-light">Добавить ивент</h2>
            <form action="events.php" method="post">
                <div class="form-group">
                    <label for="name" class="text-light">Название экскурсии:</label>
                    <input type="text" class="form-control" name="name" required>
                </div>

                <div class="form-group">
                    <label for="datetime" class="text-light">Дата и время:</label>
                    <input type="datetime-local" class="form-control" name="datetime" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Добавить">
            </form>

            <!-- Существующие экскурсии в виде таблицы -->
            <?php
            $currentTime = time();
            $resCurrent = $db->prepare("SELECT * FROM excursions WHERE date > ? ORDER BY date");
            $resCurrent->execute([$currentTime]);
            $resultCurrent = $resCurrent->fetchAll();
            ?>

            <h2 class="text-light">Текущие ивенты:</h2>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Название ивента</th>
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
                        echo "<input type='submit' class='btn btn-danger' value='Удалить'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Кнопка "Просмотр зарегистрированных" -->
            <div class="button-container">
                <a href="event_view.php" class="btn btn-primary">Просмотр зарегистрированных</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
