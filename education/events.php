<?php
session_start();
include '../metrics.php';
require '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Проверка наличия необходимых данных
    if (isset($_POST['event_id'], $_POST['fullName'], $_POST['groupNumber'])) {
        $eventId = $_POST['event_id'];
        $fullName = $_POST['fullName'];
        $groupNumber = $_POST['groupNumber'];

        $tim = time();
        $tel = '';
        $pass = '';

        if (isset($_POST['tel'], $_POST['pass'])) {
            $tel = $_POST['tel'];
            $pass = $_POST['pass'];
        }

        $userEventId = rand(100000, 999999);
        $chkEID = $db->prepare('SELECT COUNT(*) FROM excurs_event WHERE eventID = :eventID');
        $chkEID->bindParam(':eventID', $userEventId, PDO::PARAM_INT);
        $chkEID->execute();
        if ($chkEID->fetchColumn() != 0) {
            $userEventId = rand(100000, 999999);
        }

        $sql = "INSERT INTO excurs_event (fio, typeex, groupnum, phone, passport, eventID, useragent, ip, timestamp)
            VALUES (:fio, :typeex, :groupnum, :tel, :pass, :evid, :useragent, :ip, :timestamp)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':fio', $fullName);
        $stmt->bindParam(':typeex', $eventId);
        $stmt->bindParam(':groupnum', $groupNumber);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':evid', $userEventId);

        $stmt->bindParam(':useragent', $_SERVER['HTTP_USER_AGENT']);
        $stmt->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
        $stmt->bindParam(':timestamp', $tim);
        $stmt->execute();

//        echo <<<MD
//<div class="modal" id="successModal">
//  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
//    <div class="modal-content">
//      <div class="modal-header">
//        <h4 class="modal-title">Вы успешно зарегистрировались!</h4>
//        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
//      </div>
//      <div class="modal-body">
//<!--        <p>Ваш EventID:</p>-->
//<!--        <p style="color: var(&#45;&#45;bmbblue); text-align: center;" class="fs-bold fs-1">$userEventId</p>-->
//<!--        <p>Сохраните его для прохода на мероприятие</p>-->
//      </div>
//    </div>
//  </div>
//</div>
//
//<script>
//  document.addEventListener("DOMContentLoaded", function() {
//    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
//    myModal.show();
//  });
//</script>
//MD;
    }
    // Подготовка сообщения об успешной регистрации
//        $successMessage = "Вы успешно зарегистрировались!" . Ваш EventID: <code>123456</code>";
//        $successMessage .= "Имя: $fullName\n";
//        $successMessage .= "Номер группы: $groupNumber";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='../img/rk9ico.ico' type='image/x-icon'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Мероприятия</title>
    <style>

    </style>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container">
    <section class="section">
        <h2>Мероприятия</h2>

        <?php
        $sql = "SELECT * FROM excursions WHERE date > UNIX_TIMESTAMP(NOW());";
        $excursions = $db->prepare($sql);
        $excursions->execute();
        $excursions_res = $excursions->fetchAll();
        if (count($excursions_res) == 0) {
            echo '<p>На данный момент мероприятий нет</p>';
        } else {
            echo '<p>Сейчас для записи доступны следующие события:</p>';
            echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">'; // Bootstrap grid
            foreach ($excursions_res as $ex) {
                if (!$ex['visible']) {continue;} // проверка на видимость
                $dt = date('d.m.Y H:i', $ex['date']);
                echo <<<EV
<div class="col">
    <div class="card h-100" data-bs-toggle="modal" data-bs-target="#registrationModal" 
         data-event-id="{$ex['id']}" data-event-name="{$ex['name']}" data-event-time="$dt" data-event-pass="{$ex['needpass']}" data-event-addit="{$ex['addit']}">
        <div class="card-body">
            <h5 class="card-title">{$ex['name']}</h5>
            <p class="card-text">$dt</p>
        </div>
    </div>
</div>
EV;
            }
            echo '</div>';
        }
        ?>
    </section>
</div>

<div class="modal" id="successModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-success text-light">
            <div class="modal-header">
                <h4 class="modal-title">Вы успешно зарегистрировались!</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--        <p>Ваш EventID:</p>-->
                <!--        <p style="color: var(&#45;&#45;bmbblue); text-align: center;" class="fs-bold fs-1">$userEventId</p>-->
                <!--        <p>Сохраните его для прохода на мероприятие</p>-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Запись на мероприятие</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="eventDetails"></p> <!-- Вывод названия и даты мероприятия -->
                <p style="color: #FF0000; font-size: 1.14em;" id="additinfo"></p>
                <!-- Вывод названия и даты мероприятия -->
                <form id="registrationForm" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="event_id" id="event_id_input">

                    <div class="mb-3">
                        <label for="fullName" class="form-label">ФИО (полностью) *</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" required>
                    </div>

                    <div class="mb-3">
                        <label for="groupNumber" class="form-label">Номер группы *</label>
                        <input type="text" class="form-control" id="groupNumber" name="groupNumber" required>
                    </div>

                    <div id="needpass" style="display: none;">
                        <div class="mb-3">
                            <label for="groupNumber" class="form-label">Телефон *</label>
                            <input type="tel" placeholder="" class="form-control" id="tel" name="tel">
                        </div>

                        <div class="mb-3">
                            <label for="groupNumber" class="form-label">Серия и номер паспорта *</label>
                            <input type="text" placeholder="XXXX XXXXXX" class="form-control" id="pass" name="pass">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Записаться</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var myModal = new bootstrap.Modal(document.getElementById('registrationModal'));

        // Обработчик клика по карточке мероприятия
        var eventCards = document.querySelectorAll('.card');
        eventCards.forEach(function (card) {
            card.addEventListener('click', function () {
                var eventId = card.getAttribute('data-event-id');
                var eventName = card.getAttribute('data-event-name');
                var eventTime = card.getAttribute('data-event-time');
                var needpass = card.getAttribute('data-event-pass');
                var addit = card.getAttribute('data-event-addit');

                if (needpass == 1) {
                    document.getElementById('needpass').style.display = 'block';
                    document.getElementById('tel').required = true;
                    document.getElementById('pass').required = true;
                } else {
                    document.getElementById('needpass').style.display = 'none';
                    document.getElementById('tel').required = false;
                    document.getElementById('pass').required = false;
                }
                // Заполнение данных в модальном окне
                document.getElementById('event_id_input').value = eventId;

                // Вывод названия и даты мероприятия в модальном окне
                document.getElementById('eventDetails').innerText = 'Название: ' + eventName + '\nВремя: ' + eventTime;
                document.getElementById('additinfo').innerText = addit;

                // Открытие модального окна
                myModal.show();
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var registrationForm = document.getElementById("registrationForm");

        registrationForm.addEventListener("submit", function (event) {
            event.preventDefault();

            var formData = new FormData(registrationForm);

            fetch(registrationForm.action, {
                method: registrationForm.method,
                body: formData,
            })
                .then(function (response) {
                    return response.text();
                })
                .then(function (data) {
                    // Assuming the response contains the HTML for the success modal
                    // console.log(data);
                    // document.body.innerHTML += data;
                    $('#registrationModal').modal('hide')
                    $('#successModal').modal('show')

                    // var registrationModal = new bootstrap.Modal(document.getElementById('registrationModal'));
                    // registrationModal._hideModal();

                    // var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    // successModal.show();


                })
                .catch(function (error) {
                    console.error('Error:', error);
                });
        });
    });
</script>

<?php include '../end.php' ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
