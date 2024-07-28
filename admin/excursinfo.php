<?php
include '../metrics.php';
require '../connection.php';

session_start();
if (!$_SESSION['isAdmin']) {
    header("Location: /");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр заявок на экскурсии</title>
    <style>
        /* Стили для таблицы */
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

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        /* Стили для кнопки печати */
        button {
            background-color: #006cdc;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0051a8;
        }

        /* Стили для заголовка */
        h1 {
            font-size: 24px;
            color: #006cdc;
            margin-top: 20px;
            text-align: center;
        }

        /* Определите стили для страницы в формате печати */
        @media print {
            body {
                font-size: 16px;
            }

            button {
                display: none; /* Скрываем кнопку при печати */
            }

            a {
                color: #006cdc;
                text-decoration: none;
            }
        }

        th {
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
// Определите параметры сортировки, их можно передавать через GET-параметры
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Функция для изменения порядка сортировки
function toggleSortOrder($order)
{
    return $order === 'ASC' ? 'DESC' : 'ASC';
}

?>
<h2>Заявки на экскурсии</h2>
<table>
    <thead>
    <tr>
        <th>
            <a href="?sort=id&order=<?php echo ($sortBy == 'id' && $sortOrder == 'ASC') ? toggleSortOrder($sortOrder) : 'ASC'; ?>">ID</a>
        </th>
        <th>
            <a href="?sort=lastname&order=<?php echo ($sortBy == 'lastname' && $sortOrder == 'ASC') ? toggleSortOrder($sortOrder) : 'ASC'; ?>">Фамилия</a>
        </th>
        <th>
            <a href="?sort=name&order=<?php echo ($sortBy == 'name' && $sortOrder == 'ASC') ? toggleSortOrder($sortOrder) : 'ASC'; ?>">Имя</a>
        </th>
        <th>
            <a href="?sort=patronymic&order=<?php echo ($sortBy == 'patronymic' && $sortOrder == 'ASC') ? toggleSortOrder($sortOrder) : 'ASC'; ?>">Отчество</a>
        </th>
        <th>
            <a href="?sort=groupnum&order=<?php echo ($sortBy == 'groupnum' && $sortOrder == 'ASC') ? toggleSortOrder($sortOrder) : 'ASC'; ?>">Группа</a>
        </th>
        <th>
            <a href="?sort=typeex&order=<?php echo ($sortBy == 'typeex' && $sortOrder == 'ASC') ? toggleSortOrder($sortOrder) : 'ASC'; ?>">Экскурсия</a>
        </th>
        <th>
            <a href="?sort=timestamp&order=<?php echo ($sortBy == 'timestamp' && $sortOrder == 'ASC') ? toggleSortOrder($sortOrder) : 'ASC'; ?>">Время</a>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Получите заявки из базы данных с учетом сортировки
    $sql = "SELECT * FROM excurs_event ORDER BY $sortBy $sortOrder";
    $stmt = $db->query($sql);
    $eventApplications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $excurs = $db->query("SELECT * FROM excursions");
    $excurs_date = $excurs->fetchAll(PDO::FETCH_ASSOC);
    //    echo '<pre>';
    //    print_r($excurs_date);

    foreach ($eventApplications as $application) {
        echo "<tr>";
        echo "<td>" . $application['id'] . "</td>";
        echo "<td>" . $application['lastname'] . "</td>";
        echo "<td>" . $application['name'] . "</td>";
        echo "<td>" . $application['patronymic'] . "</td>";
        echo "<td>" . $application['groupnum'] . "</td>";
        echo "<td>" . $excurs_date[$application['typeex'] - 1]['name'] . "</td>";
        echo "<td>" . gmdate("d-m-Y\nH:i:s", $application['timestamp']) . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<?php
//fputcsv()
//?>
<!--<form action="download.php" method="post">-->
<!--    <input type="hidden" name="database_name" value="excurs_event">-->
<!--    <input type="submit" name="download_csv" value="Скачать CSV">-->
<!--</form>-->
<!-- Кнопка для печати -->
<button onclick="window.print()">Печать</button>
</body>
</html>
