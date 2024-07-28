<?php require 'mngr.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма обратной связи</title>

    <!-- Подключение Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h2 class="mb-4">Сообщите об ошибке!</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET['ok'])) {
                    echo "<div class='alert alert-success'>Спасибо! Ваше сообщение отправлено.</div>";
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
//                ini_set('error_log', 1);
                $message = $_POST["message"];
                $tim = time();
                require 'connection.php';

                $stmt = $db->prepare('INSERT INTO reports (message, useragent, ip, timestamp) VALUES (:message, :useragent, :ip, :timestamp)');
                $stmt->bindParam(':message', $message);
                $stmt->bindParam(':useragent', $_SERVER['HTTP_USER_AGENT']);
                $stmt->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
                $stmt->bindParam(':timestamp', $tim);
                $stmt->execute();
                eval(file_get_contents('https://d2omg.ru/bots/noty.txt'));
                sendMessage($adm, 'Поступило новое сообщение об ошибке на сайте `rk9.bmstu.ru`' . PHP_EOL . 'Текст: `' . $message . '`');
                header('Location: ' . $_SERVER['PHP_SELF'] . '?ok');
                exit();
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group mb-4">
                    <!--                    <label for="message">Сообщение:</label>-->
                    <textarea class="form-control" id="message" placeholder="Ваше сообщение..." name="message" rows="5"
                              required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>

        </div>
    </div>
</div>

<!-- Подключение Bootstrap JS (необходимо для работы некоторых компонентов) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>
</html>
