<?php
session_start();
include '../metrics.php';
if (!$_SESSION['isAdmin'] and $_SERVER['REMOTE_ADDR'] != '5.228.10.229') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='../img/rk9ico.ico' type='image/x-icon'>
    <link rel="stylesheet" href="../styles.css">
    <title>Админка</title>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container">
    <h1>Админка</h1>
    <ul>
        <li><a href="events.php">Ивенты</a></li>
<!--        <li><a href="update.php">Обновление новостей</a></li>-->
<!--        <li><a href="evening.php">Просмотр заявок на вечер кафедры</a></li>-->
    </ul>
</div>

<?php include '../end.php' ?>
</body>
</html>
