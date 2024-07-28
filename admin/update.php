<?php //include '../metrics.php'; ?>
<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>Форма для ссылки на последний TG пост</title>-->
<!--    <link rel="stylesheet" href="../styles.css">-->
<!--    <style>-->
<!--        body {-->
<!--            display: flex;-->
<!--            align-items: center;-->
<!--            justify-content: center;-->
<!--            height: 100vh;-->
<!--            margin: 0;-->
<!--        }-->
<!---->
<!--        .form-container {-->
<!--            max-width: 600px;-->
<!--            padding: 20px;-->
<!--            background-color: #fff;-->
<!--            border-radius: 10px;-->
<!--            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);-->
<!--        }-->
<!---->
<!--        .alert {-->
<!--            padding: 10px;-->
<!--            border-radius: 5px;-->
<!--            margin-top: 10px;-->
<!--        }-->
<!---->
<!--        .success {-->
<!--            background-color: #d4edda;-->
<!--            color: #155724;-->
<!--        }-->
<!---->
<!--        .error {-->
<!--            background-color: #f8d7da;-->
<!--            color: #721c24;-->
<!--        }-->
<!---->
<!--        .info {-->
<!--            background-color: #cce5ff;-->
<!--            color: #004085;-->
<!--        }-->
<!---->
<!--        label {-->
<!--            display: block;-->
<!--            margin-bottom: 5px;-->
<!--        }-->
<!---->
<!--        input[type="text"] {-->
<!--            width: 96%;-->
<!--            padding: 8px;-->
<!--            border: 1px solid #ccc;-->
<!--            border-radius: 5px;-->
<!--            margin-bottom: 10px;-->
<!--        }-->
<!---->
<!--        input[type="submit"] {-->
<!--            background-color: #007bff;-->
<!--            color: white;-->
<!--            border: none;-->
<!--            padding: 10px 20px;-->
<!--            border-radius: 5px;-->
<!--            cursor: pointer;-->
<!--        }-->
<!---->
<!--        input[type="submit"]:hover {-->
<!--            background-color: #0056b3;-->
<!--        }-->
<!---->
<!--        h3 {-->
<!--            margin-top: 0;-->
<!--        }-->
<!--    </style>-->
<!--</head>-->
<!--<body>-->
<?php
//
//use voku\helper\HtmlDomParser;
//
//require_once '../vendor/autoload.php';
//
//require '../connection.php';
//
//session_start();
//if (!$_SESSION['isAdmin'] and $_SERVER['REMOTE_ADDR'] != '5.228.10.229') {
//    header("Location: /");
//    exit();
//}
//
//$last_post_id = file_get_contents('lastpost.txt');
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    ob_implicit_flush(true);
//    ob_end_flush();
//    $tgLink = $_POST["tgLink"];
//    $post_id = explode('/', $tgLink)[4];
//    if ($post_id <= $last_post_id) {
//        echo "<div class='alert error'>Вы ошиблись ссылкой или просто не было постов(</div>";
//    } else {
//        $razn = $post_id - $last_post_id;
//        echo "<div class='alert info'>Найдено' . $razn . 'постов.<br>Запускаем обновление!<br></div>";
//        flush();
//
//        $prevDateFile = 'prev_date.txt'; // Путь к файлу с предыдущей датой
//
//        if (file_exists($prevDateFile)) {
//            $prevDate = intval(file_get_contents($prevDateFile)); // Загрузить предыдущую дату из файла
//        } else {
//            $prevDate = 0; // Если файл не существует, начать с нулевой даты
//        }
//
//        for ($i = $last_post_id; $i <= $post_id; $i++) {
//            $url = "https://t.me/RK9_MGTU/$i?embed=1";
//            $html = HtmlDomParser::file_get_html($url);
//
//            $errors = $html->findOne('.tgme_widget_message_error')->text(); // Ошибки
////            echo $errors;
//            if ($errors == 'Post not found') {
//                $out = "<div class='alert error'>Пост №' . $i . ' не найден!</div>";
//            } else {
//                $title = $html->findOne('.tgme_widget_message_text')->html(); // Текст поста
//                $title = base64_encode($title);
//                $dateString = $html->findOne('time.datetime')->datetime; // Дата поста
//                $dateString = strtotime($dateString);
//
//                if ($dateString <= $prevDate) {
//                    continue; // Пропустить сохранение, если дата меньше или равна предыдущей
//                }
//
//                $photos = array();
//                $images = $html->find('.tgme_widget_message_photo_wrap'); // Массив элементов с фото
//                $folder = "/img/tg/";
//                foreach ($images as $image) {
//                    $style = $image->getAttribute('style');
//                    preg_match('/url\((.*?)\)/', $style, $matches);
//                    $image_url = str_replace("'", '', $matches[1]);
//                    $filename = substr(basename($image_url), -10);
//                    $path = $_SERVER['DOCUMENT_ROOT'] . $folder . $filename;
//
//                    if (is_writable(dirname($path))) {
//                        $out = copy($image_url, $path);
//                        echo $out;
//                    } else {
//                        echo "Нет прав на запись в папку " . dirname($path);
//                    }
//
//                    // Добавить URL фото в массив
//                    array_push($photos, $folder . $filename);
//                }
//
//                try {
//                    $photosJson = json_encode($photos);
//
//                    $stmt = $db->prepare("INSERT INTO posts (post_id, title, date, photos) VALUES (:post_id, :title, :date, :photos)");
//                    $stmt->bindParam(':post_id', $i);
//                    $stmt->bindParam(':title', $title);
//                    $stmt->bindParam(':date', $dateString);
//                    $stmt->bindParam(':photos', $photosJson);
//                    $stmt->execute();
//
//                    if (empty($errors)) {
//                        $out = "<div class='alert success'>Пост №' . $i . ' успешно сохранен!</div>";
//                    } else {
//                        $out = "<div class='alert error'>При сохранении поста №" . $i . "возникли ошибки: " . $errors . "</div>";
//                    }
//
//                    file_put_contents($prevDateFile, $dateString); // Сохранить текущую дату в файл
//                    $prevDate = $dateString; // Обновить предыдущую дату
//                } catch (PDOException $e) {
//                    $out = "<div class='alert error'>Ошибка при сохранении в базу данных: " . $e->getMessage() . '</div>';
//                }
//            }
//            echo $out . '<br>';
//            flush();
//        }
//        echo "<div class='alert info'>Обновление завершено!</div><br>";
//        flush();
//        file_put_contents('lastpost.txt', $post_id);
//        file_put_contents('prev_date.txt', 0);
//        exit();
//    }
//}
//?>
<!---->
<!--<div class="form-container">-->
<!--    <h3>Предыдущий сохраненный пост: <a href="https://t.me/RK9_MGTU/--><?php //= $last_post_id ?><!--">--><?php //= $last_post_id ?><!--</a></h3>-->
<!--    <h3>Отправь мне ссылку на последний пост в Telegram:<br></h3>-->
<!--    <form method="post" action="--><?php //echo $_SERVER['PHP_SELF']; ?><!--">-->
<!--        <label for="tgLink">Ссылка на пост:</label><br>-->
<!--        <input type="text" id="tgLink" name="tgLink"><br>-->
<!--        <input type="submit" value="ОБНОВИТЬ НОВОСТИ НА САЙТЕ">-->
<!--    </form>-->
<!--</div>-->
<!--</body>-->
<!--</html>-->