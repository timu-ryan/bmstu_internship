<?php
session_start();
include '../metrics.php';
require "../connection.php";

$query = $db->prepare("SELECT * FROM personal ORDER BY weight DESC, name ASC;"); //WHERE id = 1
$query->execute();
$employees = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='../img/rk9ico.ico' type='image/x-icon'>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="pers.css">
    <title>Сотрудники</title>
</head>
<body>
<?php include "../nav.php"; ?>

<div class="modal" id="myModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-text">
            <h2 id="modalName"></h2>
            <p id="modalObiaz"></p>
            <p id="modalPosition"></p>
            <p id="modalDegree"></p>
            <p id="modalRank"></p>
            <p id="modalEmail"></p>
        </div>
        <div class="modal-image">
            <img src="" alt="" id="modalImage">
        </div>
    </div>
</div>

<div class="container">
    <h1>Сотрудники кафедры</h1>
    <!--    <div class="section">-->
    <div class="card-container">
        <?php
        foreach ($employees as $employee) {
            $name = $employee['name'];
            $email = $employee['email'];
            $image = $employee['image'];

            $obiaz = $employee['obiaz']; //обязанность (заместитель)
            $position = $employee['position']; //должность на кафедре (профессор, препод)
            $degree = $employee['degree']; //степень (д.т.н, к.т.н)
            $rank = $employee['rank']; //звание (доцент, проф)

            echo <<<HTML
<div class="card" onclick="showModal('{$employee['name']}', '{$employee['obiaz']}', '{$employee['position']}', '{$employee['degree']}', '{$employee['rank']}', '{$employee['email']}', 'persimg/{$image}.png')">
HTML;
            echo '<div class="card-content">';
            echo '<h2>' . $name . '</h2>';

            echo '<p style="font-size: 1.2em;">';
            if (!empty($obiaz)): echo $obiaz . '<br>'; endif;
            if (!empty($position)): echo $position . '<br>'; endif;
            if (!empty($degree)): echo $degree . '<br>'; endif;
            if (!empty($rank)): echo $rank . '<br>'; endif;
            if (!empty($email)): echo $email . '<br>'; endif;
            echo '</p>';
            echo '</div>';
            echo '<img class="employee-image" src="persimg/' . $image . '.png" alt="' . $name . '">';
            echo '</div>';
        }
        ?>
    </div>
    <!--    </div>-->
</div>
<!-- ... Ваш существующий HTML-код ... -->

<script>
    // Функция для отображения модального окна с информацией о сотруднике
    function showModal(name, obiaz, position, degree, rank, email, imageSrc) {
        const modal = document.getElementById('myModal');
        const modalContent = modal.querySelector('.modal-content');

        // Обновим информацию о сотруднике
        modal.querySelector('#modalName').textContent = name;
        modal.querySelector('#modalObiaz').textContent = obiaz;
        modal.querySelector('#modalPosition').textContent = position;
        modal.querySelector('#modalDegree').textContent = degree;
        modal.querySelector('#modalRank').textContent = rank;
        modal.querySelector('#modalEmail').innerHTML = email;
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;

        // Плавное отображение модального окна
        modal.classList.add('show'); // Добавим класс "show" для показа с анимацией
    }

    // Функция для плавного закрытия модального окна
    function closeModal() {
        const modal = document.getElementById('myModal');

        // Плавное скрытие модального окна
        modal.classList.remove('show'); // Удалим класс "show" для скрытия с анимацией
    }
</script>

<?php include '../end.php' ?>
</body>
</html>
