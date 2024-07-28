<?php
session_start();
include '../metrics.php';
require '../connection.php';

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, что все необходимые поля заполнены
    if (isset($_POST["event_id"]) && isset($_POST["name"]) && isset($_POST["group"]) && isset($_POST["email"])) {
        // Получаем данные из формы
        $event_id = $_POST["event_id"];
        $name = $_POST["name"];
        $group = $_POST["group"];
        $email = $_POST["email"];

        if ($event_id === "own") {
            $event_id = 19;
            $ownOrg = $_POST["ownOrg"];
        } else {
            $ownOrg = '';
        }

// Проверяем, существует ли уже запись с таким email
        $stmt_check = $db->prepare("SELECT COUNT(*) FROM practice_event WHERE email = ?");
        $stmt_check->execute([$email]);
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            // Если запись с таким email уже существует, обновляем данные
            $stmt_update = $db->prepare("UPDATE practice_event SET fio = ?, orgID = ?, groupnum = ?, useragent = ?, ip = ?, timestamp = ?, ownOrg = ? WHERE email = ?");
            $stmt_update->execute([$name, $event_id, $group, $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR'], time(), $ownOrg, $email]);
        } else {
            // Иначе, если запись не существует, добавляем новую
            $stmt_insert = $db->prepare("INSERT INTO practice_event (fio, orgID, groupnum, email, useragent, ip, timestamp, ownOrg) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt_insert->execute([$name, $event_id, $group, $email, $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR'], time(), $ownOrg]);
        }


        // Выводим сообщение об успешной отправке формы
        echo "Данные успешно отправлены!";
    }
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
    <title>Практика</title>
    <style>
        /* Стиль для центрирования кнопки */
        .center-btn {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <style>
        .svg-icon {
            list-style-type: none;
            padding-left: 0;
        }

        .svg-icon::before {
            content: "";
            display: inline-block;
            width: 16px; /* Укажите желаемую ширину и высоту для вашей иконки */
            height: 16px;
            background-size: cover;
            margin-right: -8px; /* Отступ между иконкой и текстом */
            transform: translateX(-16px);
        }

        .svg-icon a {
            color: #020fff;
        }

        /* Стили для задания фонового изображения на основе атрибута данных */
        .svg-icon[data-icon="word"]::before {
            background: url('../img/svg/file-earmark-word.svg') no-repeat;
        }

        .svg-icon[data-icon="exel"]::before {
            background: url('../img/svg/filetype-xlsx.svg') no-repeat;
        }

        .svg-icon[data-icon="pdf"]::before {
            background: url('../img/svg/filetype-pdf.svg') no-repeat;
        }
    </style>
</head>
<body>

<?php include "../nav.php"; ?>

<div class="container">
    <section class="section">
        <h2>Практика</h2>
        <p style="text-indent: 30px;">Уважаемые студенты! Для выбора места прохождения летней практики (01.07.2024 -
            28.07.2024) Вам необходимо
            зарегистрироваться <b>до 25.04.2024 (включительно)</b>.
            После этого списки зарегистрированных студентов будут переданы Шильникову П.С. для оформления
            документов.
        </p>

        <p style="text-indent: 30px;">При повторной регистрации за студентом будет закреплено место практики, указанное
            последним.</p>
        <p style="text-indent: 30px;">При регистрации более запрошенного предприятием количества студентов, предприятие
            выбирает из
            зарегистрировавшихся студентов, кого возьмет на практику, а остальные студенты повторно выбирают доступное
            место практики.
        </p>

        <p style="text-indent: 30px;">Обращаем внимание, что кафедра интенсивно ведет переговоры с предприятиями и
            список будет периодически
            пополняться.</p>
        <p style="text-indent: 30px;">При возникновении вопросов по выбору места практики или о прохождении практики на
            кафедре обращаться к
            Мурашову Михаилу Владимировичу (ауд.427).
        </p>
        <!--        <p>Бланки заданий, календарных планов и титульных листов:</p>-->
        <ul>
            <li class="svg-icon" data-icon="word"><a href="files/Student_practice_report_form.doc">Форма отчета
                    студента о практике</a></li>
            <li class="svg-icon" data-icon="pdf"><a href="files/Program_technological_practice_bachelors.pdf">Программа
                    технологической практики бакалавры</a></li>
            <li class="svg-icon" data-icon="pdf"><a href="files/Master's_technological_practice_program.pdf">Программа
                    технологической практики магистры</a></li>
        </ul>
        <div class="center-btn">
            <button type="button" style="background-color: var(--bmblue); color: var(--bmwhite)" class="btn btn-lg"
                    data-bs-toggle="modal" data-bs-target="#registrationModal">
                Запись на практику
            </button>
        </div>
        <div class="container mt-3">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr class="text-center" style="vertical-align: middle;">
                        <th>ID</th>
                        <th>Организация</th>
                        <th>Адрес</th>
                        <th>Сайт</th>
                        <th>Профиль</th>
                        <th>Запрашиваемое организацией количество студентов/Зарегистрировалось</th>
                        <th>Пожелания организации</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM practice";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['organization'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td><a href="<?= $row['website'] ?>"><?= $row['website'] ?></a></td>
                            <td><?= $row['profile'] ?></td>
                            <?php
                            $sqll = "SELECT COUNT(*) FROM practice_event WHERE orgID = :orgid";
                            $stmtl = $db->prepare($sqll);
                            $stmtl->execute([':orgid' => $row['id']]);
                            $r = $stmtl->fetchColumn();
                            ?>
                            <td class="text-center"><?= $row['requested'] ?> / <?= $r ?></td>
                            <td><?= $row['wishes'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Регистрация на практику</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="mb-3">
                        <label for="eventSelect" class="form-label">Выберите организацию для прохождения летней
                            практики</label>
                        <select class="form-select" id="eventSelect" name="event_id" required>
                            <!--                            <option selected disabled value="">Выберите организацию...</option>-->
                            <?php foreach ($rows as $row): ?>
                                <?php if ($row['id'] == 19) {
                                    continue;
                                } ?>
                                <option value="<?= $row['id'] ?>"><?= $row['organization'] ?></option>
                            <?php endforeach; ?>
                            <option value="own">Другое место практики</option>
                        </select>
                    </div>

                    <div class="mb-3" id="ownOrganizationField" style="display: none;">
                        <label for="ownOrganization" class="form-label">Название организации</label>
                        <input type="text" class="form-control" id="ownOrg" name="ownOrg">
                    </div>


                    <div class="mb-3">
                        <label for="fullName" class="form-label">ФИО (полностью)</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="groupNumber" class="form-label">Номер группы</label>
                        <input type="text" class="form-control" id="group" name="group" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Записаться</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="successModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content bg-success text-light">
            <div class="modal-header">
                <h4 class="modal-title">Вы успешно записаны!</h4>
                <button type="button" class="btn-close" style="background-color: white;" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--        <p>Ваш EventID:</p>-->
                <!--        <p style="color: var(&#45;&#45;bmbblue); text-align: center;" class="fs-bold fs-1">$userEventId</p>-->
                <!--        <p>Сохраните его для прохода на мероприятие</p>-->
            </div>
        </div>
    </div>
</div>

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
                    $('#registrationModal').modal('hide')
                    $('#successModal').modal('show')
                })
                .catch(function (error) {
                    console.error('Error:', error);
                });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var eventSelect = document.getElementById('eventSelect');
        var ownOrganizationField = document.getElementById('ownOrganizationField');

        eventSelect.addEventListener('change', function () {
            if (eventSelect.value === 'own') {
                ownOrganizationField.style.display = 'block';
            } else {
                ownOrganizationField.style.display = 'none';
            }
        });
    });

</script>

<?php include '../end.php' ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
