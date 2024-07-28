<?php require 'mngr.php'; ?>
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();
        for (var j = 0; j < document.scripts.length; j++) {
            if (document.scripts[j].src === r) {
                return;
            }
        }
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(95009032, "init", {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/95009032" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!--<script src="https://app.embed.im/snow.js" defer></script>-->
<div class="navbar">
    <a href="/"> <!-- Обертка к ссылке на главную -->
        <div class="logo-container">
            <div class="logo">
                <img src="/img/gerb.png" style="margin: auto 10px;" alt="Логотип">
                <img src="/img/logo_rk9_curves_300_png.png" alt="Логотип">
            </div>
            <div class="additional-info">
                <p>Mосковский государственный технический университет имени Н.Э. Баумана<br>
                    Факультет «Робототехника и комплексная автоматизация»</p>
                <p><b>Кафедра РК9<br>«Компьютерные системы автоматизации производства»</b></p>
            </div>
        </div>
    </a>
    <div class="nav-links">
        <ul>
            <?php
            if ($_SESSION["isAdmin"]) {
                $isActiveAdmin = ($_SERVER['REQUEST_URI'] === '/admin/') ? 'active' : '';
                echo <<<HTML
                <li class="dropdown">
                    <a href="/admin" class="$isActiveAdmin">Админка</a>
                    <ul class="dropdown-content">
                        <li><a href="logout.php">Выйти</a></li>
                    </ul>
                </li>
            HTML;
            }
            $isActiveNews = ($_SERVER['REQUEST_URI'] === '/news/') ? 'active' : '';
            $isActiveEducation = (strpos($_SERVER['REQUEST_URI'], '/education/') === 0) ? 'active' : '';
            $isActiveScience = (strpos($_SERVER['REQUEST_URI'], '/science/') === 0) ? 'active' : '';
            $isActiveKafedra = (strpos($_SERVER['REQUEST_URI'], '/kafedra/') === 0) ? 'active' : '';
            ?>

            <li><a href="/news" class="<?= $isActiveNews ?>">Новости</a></li>

            <li class="dropdown <?= $isActiveEducation ?>">
                <a>Образование ▾</a>
                <ul class="dropdown-content">
                    <li><a href="/education/individual.php"
                           class="<?= ($isActiveEducation && $_SERVER['REQUEST_URI'] === '/education/individual.php') ? 'active' : '' ?>">Индивидуальная
                            работа</a></li>
                    <li><a href="/education/events.php"
                           class="<?= ($isActiveEducation && $_SERVER['REQUEST_URI'] === '/education/events.php') ? 'active' : '' ?>">Мероприятия</a>
                    </li>
                    <li><a href="/education/practice.php"
                           class="<?= ($isActiveEducation && $_SERVER['REQUEST_URI'] === '/education/practice.php') ? 'active' : '' ?>">Практика</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown <?= $isActiveScience ?>">
                <a>Наука ▾</a>
                <ul class="dropdown-content">
                    <li><a href="/science/activities.php"
                           class="<?= ($isActiveScience && $_SERVER['REQUEST_URI'] === '/kafedra/activities.php') ? 'active' : '' ?>">Направления
                            деятельности</a></li>
                    <li><a href="/science/publications.php">Публикации</a></li>
                </ul>
            </li>

            <li class="dropdown <?= $isActiveKafedra ?>">
                <a>О кафедре ▾</a>
                <ul class="dropdown-content">
                    <li><a href="/kafedra/personal.php"
                           class="<?= ($isActiveKafedra && $_SERVER['REQUEST_URI'] === '/kafedra/personal.php') ? 'active' : '' ?>">Сотрудники</a>
                    </li>
                    <li><a href="/kafedra/history.php"
                           class="<?= ($isActiveKafedra && $_SERVER['REQUEST_URI'] === '/kafedra/history.php') ? 'active' : '' ?>">История</a>
                    </li>
                    <li><a href="/kafedra/contacts.php"
                           class="<?= ($isActiveKafedra && $_SERVER['REQUEST_URI'] === '/kafedra/contacts.php') ? 'active' : '' ?>">Контакты</a>
                    </li>
                </ul>
            </li>
            <!--            <li><a href="/lk" class="">Войти</a></li>-->
        </ul>
    </div>
</div>
<!--<button class="burger-button">Меню</button>-->

<script>
</script>