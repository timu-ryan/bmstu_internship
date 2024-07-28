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
    <title>Запись на экскурсии</title>
    <style>
        /* Обновленные стили для блока формы в виде карточки */
        .form-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0.625em 1.25em rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--bmgray);
            border-radius: 5px;
            font-size: 1em;
            margin-top: 5px;
            box-sizing: border-box; /* Добавлено это свойство */
        }

        button {
            background-color: var(--bmblue);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            width: 100%; /* Занимает всю ширину на мобильных устройствах */
        }

        .form-group label {
            font-size: 1.2em; /* Увеличиваем размер label-ов */
        }

        .form-group input[type="radio"] {
            transform: scale(1.5); /* Масштабируем radio-кнопки */
            margin-right: 5px; /* Увеличиваем расстояние между ними */
        }

        button:hover {
            background-color: var(--bmlight);
            color: var(--bmgray);
        }

        .form-group label span {
            color: red; /* Звездочки стали красными */
        }

        input[type="tel"] {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--bmgray);
            border-radius: 5px;
            font-size: 1em;
            margin-top: 5px;
            box-sizing: border-box;
        }

        /* Стили для выпадающего списка */
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--bmgray);
            border-radius: 5px;
            font-size: 1em;
            margin-top: 5px;
            box-sizing: border-box;
            appearance: none; /* Убираем стандартные стили браузера */
            background-color: white; /* Цвет фона списка */
            cursor: pointer;
            position: relative; /* Добавляем позиционирование */
        }

        /* Добавляем стили для стрелочки в выпадающем списке */
        select::after {
            content: '\25BC'; /* Юникод символ для стрелочки вниз */
            position: absolute;
            top: 0;
            right: 0; /* Меняем правое положение на 0 */
            padding: 10px;
            background-color: var(--bmgray); /* Цвет фона стрелочки */
            color: white; /* Цвет стрелочки */
            pointer-events: none; /* Стрелочка не активна для событий мыши */
            border-radius: 0 5px 5px 0;
        }

        /* Стили для выпадающего списка при наведении курсора */
        select:hover {
            border-color: var(--bmblue); /* Изменяем цвет рамки при наведении */
        }

        /* Стили для выпадающего списка при фокусе */
        select:focus {
            outline: none; /* Убираем стандартное подчеркивание при фокусе */
            border-color: var(--bmblue); /* Изменяем цвет рамки при фокусе */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); /* Добавляем тень при фокусе */
        }


    </style>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container">
    <div id="alert-container" style="font-size: 1.4em;"></div>
    <h1>Запись на экскурсии</h1>
    <!--    <h3 style="color: red;">Для прохода по разовому пропуску на территорию университета зарегистрируйтесь до 15:00 05.10.2023</h3>-->
    <div class="form-card">
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="lastname">Фамилия: <span>*</span></label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="name">Имя: <span>*</span></label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="patronymic">Отчество: <span>*</span></label>
                <input type="text" id="patronymic" name="patronymic" required>
            </div>
            <div class="form-group">
                <label for="groupnum">Номер Группы: <span>*</span></label>
                <input type="text" id="groupnum" name="groupnum" required>
            </div>
            <?php
            $sql = "SELECT * FROM excursions WHERE date > UNIX_TIMESTAMP(NOW());";
            $excursions = $db->prepare($sql);
            $excursions->execute();
            $excursions_res = $excursions->fetchAll();
//            echo '<pre>';
//            print_r($excursions_res);
            ?>
            <div class="form-group">
                <label for="typeex">Экскурсия: <span>*</span></label>
                <select id="typeex" name="typeex" required>
                    <?php
                    foreach ($excursions_res as $ex):
                        date_default_timezone_set('Europe/Moscow');
                        $normal_date = date('d.m.y H:i', $ex['date']);
                        ?>
                        <option value="<?= $ex['id'] ?>"><?= $ex['name'] ?> - <?= $normal_date ?> </option>
                    <?php
                    endforeach;
                    ?>

                </select>
            </div>
            <button type="submit">Отправить</button>
        </form>
    </div>
</div>
<script>
    function validateForm() {
        // Проверка заполнения обязательных полей
        var name = document.getElementById("name").value;
        var lastname = document.getElementById("lastname").value;
        var patronymic = document.getElementById("patronymic").value;
        var groupnum = document.getElementById("groupnum").value;
        var typeex = document.getElementById("typeex").value;
        // var participationType = document.querySelector('input[name="participationType"]:checked');

        if (!name || !lastname || !patronymic || !groupnum || !typeex) {
            alert("Пожалуйста, заполните все обязательные поля! (помечены *)");
            return false;
        }

        // Дополнительные проверки данных, если необходимо

        return true;
    }
</script>
<script>
    function showAlert(message, className) {
        const alertContainer = document.getElementById('alert-container');

        // Создаем элемент алерта
        const alertElement = document.createElement('div');
        alertElement.className = `alert ${className}`;
        alertElement.innerText = message;

        // Добавляем алерт в контейнер
        alertContainer.appendChild(alertElement);

        // Устанавливаем таймер на скрытие алерта через 5 секунд
        setTimeout(function () {
            alertContainer.removeChild(alertElement);
        }, 8000);
    }

    // Пример использования:
    // showAlert('Ваши данные приняты', 'alert-success');
    // showAlert('Внимание! Ошибка!', 'alert-error');
</script>
<?php include '../end.php';
//Обработчик формы:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();

    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $patronymic = $_POST["patronymic"];
    $typeex = $_POST["typeex"];
    $groupnum = $_POST["groupnum"];

    // Подготовка и выполнение SQL-запроса для вставки данных в базу
    $sql = "INSERT INTO excurs_event (name, lastname, patronymic, typeex, groupnum, useragent, ip, timestamp)
            VALUES (:name, :lastname, :patronymic, :typeex, :groupnum, :useragent, :ip, :timestamp)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':patronymic', $patronymic);
    $stmt->bindParam(':typeex', $typeex);
    $stmt->bindParam(':groupnum', $groupnum);

    $stmt->bindParam(':useragent', $user_agent);
    $stmt->bindParam(':ip', $ip);
    $stmt->bindParam(':timestamp', $timestamp);

    try {
        $stmt->execute();
        // Успешно сохранено
        echo "<script>
showAlert('Спасибо, ваши данные отправлены', 'alert-success');
</script>";

    } catch (PDOException $e) {
        $err = $e->getMessage();
        print_r($err);
        // Ошибка при сохранении
        echo "<script>
showAlert('Произошла ошибка при отправке данных: $err', 'alert-error');
</script>";
    }
}
?>
</body>
</html>
