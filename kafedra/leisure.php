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
    <title>Досуг</title>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container">
    <h1>Досуг</h1>

    <!-- Спойлер для "Вечер кафедры" -->
    <div class="spoiler">
        <h2>Вечер кафедры <span class="arrow">▶</span></h2>
        <div class="spoiler-content">
            <p>Вечер кафедры прошел</p>
        </div>
    </div>

    <!-- Спойлер для "Футбол" -->
    <div class="spoiler">
        <h2>Футбол <span class="arrow">▶</span></h2>
        <div class="spoiler-content">
            <p>Игра в футбол</p>
        </div>
    </div>
</div>

<script>
    // Получаем все спойлеры на странице
    const spoilers = document.querySelectorAll('.spoiler');

    // Добавляем обработчик события на каждый спойлер
    spoilers.forEach(spoiler => {
        const spoilerHeader = spoiler.querySelector('h2');
        const spoilerContent = spoiler.querySelector('.spoiler-content');

        // Обработчик события при клике на заголовок спойлера
        spoilerHeader.addEventListener('click', () => {
            spoiler.classList.toggle('open'); // Переключаем класс "open"
        });
    });

</script>
<?php include '../end.php' ?>
</body>
</html>
