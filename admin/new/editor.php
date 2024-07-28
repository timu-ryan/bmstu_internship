<!DOCTYPE html>
<html>
<head>
    <title>Редактор файла</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .editor-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #f0f0f0;
        }
        textarea {
            flex: 1;
            width: 100%;
            resize: none; /* Запрещаем изменение размеров текстового поля */
        }
    </style>
</head>
<body>
    <?php
        $currentDir = isset($_GET['dir']) ? $_GET['dir'] : '../../';
        $filename = isset($_GET['file']) ? $_GET['file'] : '';
        $filepath = $currentDir . '/' . $filename;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'];

            $file = fopen($filepath, 'w');
            if ($file) {
                fwrite($file, $content);
                fclose($file);
                echo 'Файл успешно сохранен.';
            } else {
                echo 'Ошибка при сохранении файла.';
            }
        }

        if (file_exists($filepath)) {
            // Проверяем, что файл находится в той же директории, что указана в URL
            $realPath = realpath($filepath);
            $realCurrentDir = realpath($currentDir);
            if (strpos($realPath, $realCurrentDir) !== 0) {
                echo 'Доступ к файлу запрещен.';
            } else {
                $content = file_get_contents($filepath);
                echo '<div class="editor-title">';
                echo '<h1>Редактор файла: ' . htmlspecialchars($currentDir . $filename) . '</h1>';
                echo '<form action="editor.php?file=' . urlencode($filename) . '&dir=' . urlencode($currentDir) . '" method="post">';
                echo '<input type="submit" value="Сохранить">';
                echo '</form>';
                echo '<a href="individual.php?dir=' . urlencode($currentDir) . '">Назад</a>';
                echo '</div>';
                echo '<textarea name="content">' . htmlspecialchars($content) . '</textarea>';
            }
        } else {
            echo 'Файл не найден.';
        }
    ?>
</body>
</html>
