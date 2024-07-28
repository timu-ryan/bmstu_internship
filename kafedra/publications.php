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
    <title>Layout</title>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container">
    <h1>Публикации</h1>
    <p>
        Конференции по тематике кафедры можно посмотреть <a href="https://docs.google.com/spreadsheets/d/1Jmfp1zij0VarbLwAnz-EhyiHrHkaE4bhiu8TxbGp8Uw/edit#gid=0">здесь</a>
    </p>
</div>

<?php include '../end.php' ?>
</body>
</html>
