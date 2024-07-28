<?php

use voku\helper\HtmlDomParser;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/connection.php';

$i = 20;
$url = "https://t.me/teststesfdff/$i?embed=1";

$html = HtmlDomParser::file_get_html($url);
$errors = $html->findOne('.tgme_widget_message_error')->text(); // Ошибки
if ($errors == 'Post not found') {
    $out = "<div class='alert error'>Пост №' . $i . ' не найден!</div>";
} else {
    $title = $html->findOne('.tgme_widget_message_text')->html(); // Текст поста
    $title = base64_encode($title);
    $dateString = $html->findOne('time.datetime')->datetime; // Дата поста
    $dateString = strtotime($dateString);

//            if ($dateString <= $prevDate) {
//                continue; // Пропустить сохранение, если дата меньше или равна предыдущей
//            }

    $photos = array();
    $images = $html->find('.tgme_widget_message_photo_wrap'); // Массив элементов с фото
    $folder = "/img/tg/";
    foreach ($images as $image) {
        $style = $image->getAttribute('style');
        preg_match('/url\((.*?)\)/', $style, $matches);
        $image_url = str_replace("'", '', $matches[1]);
        $filename = substr(basename($image_url), -10);
        $path = $_SERVER['DOCUMENT_ROOT'] . $folder . $filename;

        if (is_writable(dirname($path))) {
            $out = copy($image_url, $path);
            echo $out;
        } else {
            echo "Нет прав на запись в папку " . dirname($path);
        }

        // Добавить URL фото в массив
        array_push($photos, $folder . $filename);
    }

    try {
        $photosJson = json_encode($photos);

        $stmt = $db->prepare("INSERT INTO posts (post_id, title, date, photos) VALUES (:post_id, :title, :date, :photos)");
        $stmt->bindParam(':post_id', $i);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':date', $dateString);
        $stmt->bindParam(':photos', $photosJson);
        $stmt->execute();

        if (empty($errors)) {
            $out = "<div class='alert success'>Пост №' . $i . ' успешно сохранен!</div>";
        } else {
            $out = "<div class='alert error'>При сохранении поста №" . $i . "возникли ошибки: " . $errors . "</div>";
        }

//        file_put_contents($prevDateFile, $dateString); // Сохранить текущую дату в файл
//        $prevDate = $dateString; // Обновить предыдущую дату
    } catch (PDOException $e) {
        $out = "<div class='alert error'>Ошибка при сохранении в базу данных: " . $e->getMessage() . '</div>';
    }
}