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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body {
                font-size: 16px;
            }

            .btn {
                display: none; /* Скрываем кнопку при печати */
            }
        }
    </style>
</head>

<body>
<?php
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'ASC';

function toggleSortOrder($order)
{
    return $order === 'ASC' ? 'DESC' : 'ASC';
}

?>

<div class="container-fluid">
    <h2 class="">Зарегистрированные на мероприятия</h2>
    <table class="table">
        <thead>
        <tr>
            <th>
                <a href="?sort=id&order=<?php echo ($sortBy == 'id' && $sortOrder == 'ASC') ? toggleSortOrder($sortOrder) : 'ASC'; ?>">ID</a>
            </th>
            <th>
                <a href="?sort=fio&order=<?php echo ($sortBy == 'fio' && $sortOrder == 'ASC') ? toggleSortOrder($sortOrder) : 'ASC'; ?>">ФИО</a>
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
        $sql = "SELECT * FROM excurs_event ORDER BY $sortBy $sortOrder";
        $stmt = $db->query($sql);
        $eventApplications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $excurs = $db->query("SELECT * FROM excursions");
        $excurs_date = $excurs->fetchAll(PDO::FETCH_ASSOC);

        $currentTimestamp = time();
        foreach ($eventApplications as $key => $application) {

            $eventDateTimestamp = $excurs_date[$application['typeex'] - 1]['date'];

//             Проверяем, прошло ли более 24 часов с момента проведения мероприятия
            if ($currentTimestamp > $eventDateTimestamp + 24 * 60 * 60) {
                continue; // Пропускаем заявку, если прошло более 24 часов с момента проведения мероприятия
            }

            echo "<tr>";
            echo "<td>" . $key+1 . "</td>";
            echo "<td>" . $application['fio'] . "</td>";
            echo "<td>" . $application['groupnum'] . "</td>";
            echo "<td>" . $excurs_date[$application['typeex'] - 1]['name'] . "</td>";
            echo "<td>" . gmdate("d-m-Y\nH:i:s", $application['timestamp']) . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <button class="btn btn-primary" onclick="window.print()">Печать</button>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
