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
    <title>Образование</title>
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

        .block-container {
            border: 1px solid var(--bmgray); /* Цвет и толщина обводки */
            padding: 8px; /* Внутренний отступ для контента блока */
            margin-bottom: 10px; /* Внешний отступ между блоками */
        }
    </style>
</head>
<body>
<?php include "../nav.php"; ?>
<div class="container">
    <section class="section">
        <h2>Образование</h2>
        <p>
        <ul>
            <li class="svg-icon" data-icon="exel"><a
                        href="https://mail.bmstu.ru/~murashov@bmstu.ru/%D0%9D%D0%98%D0%A0%20%D0%B8%20%D0%92%D0%9A%D0%A0%202024-25%20%D1%83%D1%87.%20%D0%B3%D0%BE%D0%B4.xlsx">
                    Закрепление
                    студентов за руководителями 2024-2025</a>
            </li>
            <li class="svg-icon" data-icon="exel"><a
                        href="https://mail.bmstu.ru/~murashov@bmstu.ru/%D0%9A%D0%9F%20%D0%B8%20%D0%92%D0%9A%D0%A0%202023-24%20%D1%83%D1%87.%20%D0%B3%D0%BE%D0%B4%20%20.xlsx">
                    Закрепление
                    студентов за руководителями 2023-2024</a>
            </li>
        </ul>
        <p>Бланки заданий, календарных планов и титульных листов:</p>
        <div class="block-container">
            <ul>
                <li class="svg-icon" data-icon="word"><a href="files/nirs_2023.docx">НИРС</a></li>
                <li class="svg-icon" data-icon="word"><a href="files/title_vkr.docx">ВКР. Титульный лист</a></li>
            </ul>
        </div>

        <div class="block-container">
            <p>Бакалавры:</p>
            <ul>
                <li class="svg-icon" data-icon="word"><a href="files/kp_bachelors_2023.docx">Курсовой проект.
                        Бакалавр</a></li>
                <li class="svg-icon" data-icon="word"><a href="files/vkr_task_kalendar_bakalavr.docx">ВКР. Задание и
                        календарный план. Бакалавр</a></li>
            </ul>
        </div>

        <div class="block-container">
            <p>Магистры:</p>
            <ul>
                <li class="svg-icon" data-icon="word"><a href="files/kp_masters_2024.docx">Курсовой проект. Магистр</a>
                </li>
                <li class="svg-icon" data-icon="word"><a href="files/blank_practice_master.docx">Преддипломная практика.
                        Магистр</a></li>
                <li class="svg-icon" data-icon="word"><a href="files/vkr_task_kalendar_master.docx">ВКР. Задание и
                        календарный
                        план. Магистр</a></li>
                <li class="svg-icon" data-icon="word"><a href="files/pedagogical_practice_2023.docx">Педагогическая
                        практика</a></li>
            </ul>
        </div>
        <p>
            Задания подписываются студентом и его руководителем.
            Оформленные и подписанные задания в 2 экземплярах сдаются не позднее <b>второй</b> недели семестра секретарю
            кафедры
            Ахтямовой Марии Львовне (ауд. 205) для подписи у заведующего кафедрой и регистрации.
        </p>
    </section>
</div>

<?php include '../end.php' ?>
</body>
</html>
