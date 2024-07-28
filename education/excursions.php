<?php
session_start();
include '../metrics.php';
require '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='../img/rk9ico.ico' type='image/x-icon'>
    <link rel="stylesheet" href="../styles.css">
    <title>Экскурсии</title>
    <style>
        .registration-button {
            padding: 4px 8px;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-size: 20px;
            cursor: pointer;
            text-decoration: none;
            background-color: var(--bmblue);
        }
    </style>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container">
    <section class="section">
        <h2>Экскурсии</h2>
            <?php
            $sql = "SELECT * FROM excursions WHERE date > UNIX_TIMESTAMP(NOW());";
            $excursions = $db->prepare($sql);
            $excursions->execute();
            $excursions_res = $excursions->fetchAll();
            if (count($excursions_res) == 0) {
                echo '<p>На данный момент экскурсий нет</p>';
            } else {
                echo '<p>Сейчас для записи доступны следующие экскурсии:</p>';
                echo '<ol start="1" style="font-size: 1.2em;">';
                foreach ($excursions_res as $ex) {
                    echo '<li>' . $ex['name'] . '</li>';
                }
                echo '</ol>';
                echo '<a href="registerexcurs.php" class="registration-button">Запись на экскурсии</a>';
            }
            ?>
    </section>
</div>

<?php include '../end.php' ?>
</body>
</html>
