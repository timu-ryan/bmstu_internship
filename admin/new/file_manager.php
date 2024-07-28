<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filename = $_POST['filename'];
    $content = $_POST['content'];

    $file = fopen('../../' . $filename, 'w');
    if ($file) {
        fwrite($file, $content);
        fclose($file);
        echo 'Файл успешно сохранен.';
    } else {
        echo 'Ошибка при сохранении файла.';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['file'])) {
    $filename = $_GET['file'];
    $filepath = '../../' . $filename;

    if (file_exists($filepath)) {
        $content = file_get_contents($filepath);
        echo '<h1>Редактирование файла: ' . htmlspecialchars($filename) . '</h1>';
        echo '<form action="file_manager.php" method="post">';
        echo '<input type="hidden" name="filename" value="' . htmlspecialchars($filename) . '">';
        echo '<textarea name="content" rows="10" cols="50">' . htmlspecialchars($content) . '</textarea>';
        echo '<br>';
        echo '<input type="submit" value="Сохранить">';
        echo '</form>';
    } else {
        echo 'Файл не найден.';
    }
}
