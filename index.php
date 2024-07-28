<?php
session_start();
include 'posl.php';
include 'metrics.php';
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='img/rk9ico.ico' type='image/x-icon'>
    <link rel="stylesheet" href="styles.css"> <!-- Общие стили -->
    <link rel="stylesheet" href="temp.css"> <!-- Временные стили -->
    <link rel="stylesheet" href="news/news.css">
    <title>Кафедра РК9</title>
    <style>
        /*.registration-button {*/
        /*    padding: 3px 60px;*/
        /*    color: #fff;*/
        /*    border: none;*/
        /*    border-radius: 3px;*/
        /*    font-size: 17px;*/
        /*    cursor: pointer;*/
        /*    text-decoration: none;*/
        /*    background-color: var(--bmblue);*/
        /*}*/
    </style>
</head>
<body>

<?php include "nav.php"; ?> <!--навбар-->

<div class="container">
    <p>Кафедра занимается спектром технологий, которые являются составными частями концепции «Индустрия 4.0». Решаются
        задачи разработки интегрированных систем компьютерной автоматизации производственных процессов на разных
        уровнях, от станков с ЧПУ до интеллектуальных систем управления производством.</p>

    <!-- Вечер кафедры -->
    <!--    <section class="section" style="background-color: #ffd700;">-->
    <!--        <p>🔥 Мы напоминаем, что уже завтра для студентов нашей кафедры пройдёт презентация компании <a href="https://www.infra.ru/">"Инфраструктура ТК"</a> (дочерняя фирма компании ЛУКОЙЛ).-->
    <!--           Компанию представит руководитель департамента цифровых технологий Афонин Константин Игоревич-->
    <!--            <br><b>📆 1-го декабря (пятница)-->
    <!--            <br>🕘 15:00-->
    <!--            <br>🏫 аудитория 433-->
    <!--            </b>-->
    <!--            <br>Для участия в мероприятии регистрируйтесь на <a href="http://rk9.bmstu.ru/education/events.php">сайте!</a></p>-->


    <section class="section">
        <h2>Специальности</h2>
        <div class="card-container">
            <div class="card">
                <h2>Бакалавриат</h2>
                <p>15.03.04 Автоматизация технологических процессов и производств <span class="badge">4 года</span></p>
                <p>15.03.04 Автоматизация технологических процессов и производств <span class="badge">6 лет</span><br>
                    Профиль: <i>Цифровые технологии в автоматизации производства</i>
                </p>
            </div>
            <div class="card">
                <h2>Магистратура</h2>
                <p>15.04.04 Автоматизация технологических процессов и производств <span class="badge">2 года</span><br>
                    Профили:<br><i>
                        1. Интеллектуальные системы управления жизненным циклом продукции<br>
                        2. Промышленный интернет вещей в цифровом производстве
                    </i>
                </p>
            </div>
            <div class="card">
                <h2>Аспирантура</h2>
                <p>2.3.3 Автоматизация и управление технологическими процессами и производствами <span
                            class="badge">3 года</span></p>
                <p>2.5.4 Роботы, мехатроника и робототехнические системы <span
                            class="badge">4 года</span></p>
            </div>
        </div>
    </section> <!-- Специальности -->

    <!--<section class="section">
        <h2>Специальности</h2>
        <ul>
            <li>15.03.04 Автоматизация технологических процессов и производств <span
                        class="badge">бакалавриат, 4 года</span></li>
            <li>15.03.04 Автоматизация технологических процессов и производств <span
                        class="badge">бакалавриат, 6 лет</span><br>
             <ul style="font-size: 100%;">
                    <li style="list-style: none">Профиль:</li>
                    <li>Цифровые технологии в автоматизации производства</li>
                </ul>
            </li>
            <li>15.04.04 Автоматизация технологических процессов и производств <span
                        class="badge">магистратура, 2 года</span><br>
                <ul style="font-size: 100%;">
                    <li style="list-style: none">Профили:</li>
                    <li>Интеллектуальные системы управления жизненным циклом продукции</li>
                    <li>Промышленный интернет вещей в цифровом производстве</li>
                </ul>
            </li>
            <li>2.3.3 Автоматизация и управление технологическими процессами и производствами <span
                        class="badge">аспирантура, 3 года</span></li>
            <li>2.5.4 Роботы, мехатроника и робототехнические системы <span
                        class="badge">аспирантура, 4 года</span></li>
        </ul>
    </section>--> <!-- Старая карта -->

    <section class="section">
        <div class="card-container">
            <div class="card">
                <h2>Предметы ЕГЭ</h2>
                <p>
                    Физика / Информатика<br>
                    Математика (профиль)<br>
                    Русский язык
                </p>
            </div>
            <div class="card">
                <h2>Проходной балл по основному конкурсу в 2023 году</h2>
                <p>260 баллов</p>
            </div>
            <div class="card">
                <h2>Стоимость обучения в бакалавриате</h2>
                <p>329 761 ₽</p>
            </div>
        </div>
    </section> <!-- Предметы ЕГЭ -->

    <section class="section">
        <h2>Слово руководителя</h2>
        <div class="leader">
            <img src="img/leader.png" alt="Фото руководителя">
            <div class="leader-info">
                <div class="leader-text">
                    <p>
                        Уважаемые абитуриенты и студенты!<br>
                        Поступая в Московский государственный технический университет имени Н.Э. Баумана (ранее МВТУ
                        им.
                        Н.Э. Баумана) вы выбираете свое достойное будущее, гарантированное высоким уровнем
                        инженерного
                        профессионализма, который вы приобретете в стенах нашего Университета.
                        <span id="moreText">Всем выпускникам нашего вуза знаком и близок девиз: МВТУ это Мужество, Воля, Труд и Упорство.
                        Среди большего количества специальностей, предлагаемых Университетом, Вам нужно выбрать лишь
                        одну, и, мы уверены, что Вы не пожалеете, если выберете кафедру РК9 «Компьютерные системы
                        автоматизации производства». Кафедра осуществляет подготовку бакалавров и магистров по традиционному направлению «Автоматизация технологических процессов и производств». Выпускники кафедры способны применить свои знания на всем этапе жизненного цикла продукции включая проектирование изделия, проведение инженерных расчетов, разработку технологических процессов изготовления, организацию производства и управление ресурсами предприятия, вплоть до утилизации продукции.<br>
Выпускники кафедры овладевают, как знаниями в области машиностроительного производства, так и информационными технологиями, владеют как искусством программирования, так и навыками в области наладки и диагностики компьютерных систем управления технологическим оборудованием. Среди новых современных научных направлений, осваиваемых в прочесе обучения студентами кафедры, следует отметить: робототехнику, цифровое производство, машинное обучение, большие данные, мягкие вычисления и нечеткую логику, искусственный интеллект.<br>
Студенты получают фундаментальные теоретические знания и практические умения, необходимые для успешной карьеры. Свои знания и опыт студентам кафедры передает высококвалифицированный коллектив преподавателей. В процессе обучения, имеется возможность стажироваться в ведущих научно-образовательных центрах России и зарубежья.<br>
После обучения в бакалавриате, лучшие студенты могут продолжить обучение в магистратуре, а затем и в аспирантуре кафедры.<br>На кафедре создан дружный коллектив студентов и преподавателей, проводятся культурные и спортивные мероприятия. Большой популярность пользуется традиционный вечер кафедры РК9, проходящий ежегодно в первую субботу октября. Выпускники и преподаватели выезжают для празднования окончания учебы в подмосковные пансионаты и дома отдыха.<br>
Если ты талантлив, у тебя есть профессиональные и жизненные амбиции, ты стремишься раскрыть все свои способности и обрести яркую индивидуальность, то именно тебя ждёт кафедра РК9 «Компьютерные системы автоматизации производства».
Пусть учёба на нашей кафедре станет успешным стартом в достойное будущее!</span>
                        <button style="font-size: 0.8em;" id="toggleButton" onclick="toggleLeaderText()">Продолжение
                        </button>
                    </p>
                    <p>д.т.н., проф., заведующий кафедрой<br>Гаврюшин Сергей Сергеевич</p>
                </div>
            </div>
        </div>
    </section> <!-- Слово руководителя -->

    <section class="section">
        <h2>Дисциплины</h2>
        <ul>
            <li>Автоматизация управления жизненным циклом продукции</li>
            <li>Распределенные компьютерные информационно-управляющие системы</li>
            <li>Информационное обеспечение компьютерно-интегрированных производств</li>
            <li>Программирование в цифровом производстве</li>
            <li>Оборудование цифрового производства</li>
            <li>Архитектура промышленного интернета вещей</li>
            <li>Метаэвристические алгоритмы и нейронные сети</li>
            <li>Методы машинного обучения и распознавания образов</li>
            <li>Интеллектуальные системы</li>
            <li>Аддитивные технологии и прототипирование</li>
            <li>Промышленная робототехника</li>
            <li>Роботы параллельной структуры</li>
            <li>Микропроцессоры в роботизированных системах управления</li>
            <li>Информационная безопасность технологических процессов и производств</li>
        </ul>
    </section> <!-- Дисциплины -->

    <section class="section">
        <h2>Стажировки и будущая карьера</h2>
        <p>Практика студентов организуется как на базе IT-компаний, так и промышленных предприятий. Среди основных
            партнёров кафедры можно выделить следующих: Инфраструктура ТК, Лукойл-Технологии, Технорэд, Нью
            Лайн Инжиниринг, Промэнерго Автоматика, Центр СПРУТ, НТЦ АПМ, Яковлев, Цифровая инфраструктура, ИВК, МАРТ-Консалтинг, отраслевые НИИ Газпрома, РЖД, Транснефти и целый ряд других.</p>
    </section> <!-- Стажировки -->

    <section class="section">
        <h2>Новости</h2>
        <?php
        $stmt = $db->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($post) {
            $date = date('d.m.Y H:i', $post['date']);
            $text = base64_decode($post['title']);
            $images = json_decode($post['photos'], true);
            ?>
            <h3><?= $date ?></h3>
            <?php
            if (!empty($images)) {
                if (count($images) === 1) {
                    echo '<img src="' . $images[0] . '" alt="News Image" class="single-image">';
                } else {
                    echo '<div class="image-gallery">';
                    foreach ($images as $image) {
                        echo '<img src="' . $image . '" alt="News Image" class="multi-image">';
                    }
                    echo '</div>';
                }
            }
            ?>
            <p class="text"><?= $text ?></p>
            <a href="https://rk9.bmstu.ru/news/" target="_blank" class="telegram-button">Читать в новостях</a>
            <?php
        } else {
            echo "<p>Нет доступных новостей.</p>";
        }
        ?>
    </section> <!-- Новости -->

</div>

<?php include 'end.php' ?> <!-- подвал -->

<!--<script src="script.js"></script>-->
<script>
    function toggleLeaderText() {
        var moreText = document.getElementById("moreText");
        var button = document.getElementById("toggleButton");

        if (moreText.style.display === "inline") {
            moreText.style.display = "none";
            button.innerHTML = "Продолжение";
        } else {
            moreText.style.display = "inline";
            button.innerHTML = "Скрыть";
        }
    }
</script>
<script src="uscr.js"></script>
</body>
</html>