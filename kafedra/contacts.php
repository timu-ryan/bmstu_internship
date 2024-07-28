<?php
session_start();
include '../metrics.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='../img/rk9ico.ico' type='image/x-icon'>
    <link rel="stylesheet" href="../styles.css">
    <title>Контакты</title>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container">
    <h1>Контакты</h1>
    <p>
<!--    <p>Заведующий кафедрой</p>-->
    <ul style="font-size: 20px;">
        <li>Телефон: 8 (499) 263-66-39</li>
        <li>Почта: achtyamml@bmstu.ru</li>
        <li>Адрес: 105005, Москва, 2-я Бауманская ул, д.5, стр 1.</li>

    </ul>
    </p>
</div>
<script src="../editor.js"></script>
<?php include '../end.php' ?>
</body>
</html>
