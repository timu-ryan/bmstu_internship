<!DOCTYPE html>
<html>
<head>
    <title>Выберите файл или папку для редактирования</title>
</head>
<body>
    <h1>Выберите файл или папку для редактирования</h1>
    <?php
        $currentDir = isset($_GET['dir']) ? $_GET['dir'] : '../../';
        $files = scandir($currentDir);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $fileOrDir = $currentDir . $file;
                if (is_dir($fileOrDir)) {
                    echo '<li><a href="individual.php?dir=' . urlencode($fileOrDir) . '">' . htmlspecialchars($file) . '/</a></li>';
                } else {
                    echo '<li><a href="editor.php?file=' . urlencode($file) . '&dir=' . urlencode($currentDir) . '">' . htmlspecialchars($file) . '</a></li>';
                }
            }
        }
    ?>
</body>
</html>
