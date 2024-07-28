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
    <title>Вечер кафедры</title>
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

    </style>
</head>
<body>
<?php include "../nav.php"; //Пятого 15 00?>
<div class="container">
    <div id="alert-container" style="font-size: 1.4em;"></div>
    <h1>Регистрация на вечер кафедры</h1>
    <h3 style="color: red;">Для прохода по разовому пропуску на территорию университета зарегистрируйтесь до 15:00 05.10.2023</h3>
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
                <label for="email">Email: <span>*</span></label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Телефон:</label>
                <input type="tel" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="graduationYear">Год окончания кафедры РК9:</label>
                <input type="text" id="graduationYear" name="graduationYear">
            </div>
            <div class="form-group">
                <label for="workplace">Место работы:</label>
                <input type="text" id="workplace" name="workplace">
            </div>
            <div class="form-group">
                <label for="position">Должность:</label>
                <input type="text" id="position" name="position">
            </div>
            <div class="form-group">
                <label>Требуется ли пропуск: <span>*</span></label>
                <input type="radio" id="passYes" name="needPass" value="Да"> Да
                <input type="radio" id="passNo" name="needPass" value="Нет"> Нет
            </div>
            <!--            <div class="form-group">-->
            <!--                <label>Формат участия: <span>*</span></label>-->
            <!--                <input type="radio" id="inPerson" name="participationType" value="Очно"> Очно-->
            <!--                <input type="radio" id="remote" name="participationType" value="Дистанционно"> Дистанционно-->
            <!--            </div>-->
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
        var email = document.getElementById("email").value;
        var needPass = document.querySelector('input[name="needPass"]:checked');
        // var participationType = document.querySelector('input[name="participationType"]:checked');

        if (!name || !lastname || !patronymic || !email || !needPass) {
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
        }, 10000);
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
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $graduationYear = $_POST["graduationYear"];
    $workplace = $_POST["workplace"];
    $position = $_POST["position"];
    $needPass = $_POST["needPass"];
//    $participationType = $_POST["participationType"];

    // Проверка заполнения обязательных полей
//    if (empty($name) || empty($lastname) || empty($patronymic) || empty($email) || empty($needPass) || empty($participationType)) {
//        echo "Заполните все обязательные поля (помечены *) и вернитесь назад.";
//        exit;
//    }

    // Подготовка и выполнение SQL-запроса для вставки данных в базу
    $sql = "INSERT INTO evening_event (name, lastname, patronymic, email, phone, graduationYear, workplace, position, needPass, useragent, ip, timestamp)
            VALUES (:name, :lastname, :patronymic, :email, :phone, :graduationYear, :workplace, :position, :needPass, :useragent, :ip, :timestamp)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':patronymic', $patronymic);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':graduationYear', $graduationYear);
    $stmt->bindParam(':workplace', $workplace);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':needPass', $needPass);
//    $stmt->bindParam(':participationType', $participationType);
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
