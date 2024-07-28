<?php
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $biography = $_POST['biography'];

    // Защита от SQL-инъекций (используем подготовленные запросы)
    $sql = "UPDATE personal SET bio = :bio WHERE id = 2"; // Замените на ваш запрос
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':bio', $biography, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Биография успешно сохранена.";
    } else {
        echo "Ошибка при сохранении биографии.";
    }
}

// Загрузка текущей биографии из базы данных
$bio = '';
$sql = "SELECT bio FROM personal WHERE id = 2"; // Замените на ваш запрос
$stmt = $db->prepare($sql);
if ($stmt->execute()) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $bio = $row['bio'];
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактор биографии</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>
<body>
<div id="summernote" name="biography"><?= $bio; ?></div>
<button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit</button>
<form method="post">
    <input type="hidden" name="biography" id="biographyInput">
    <button type="button" id="saveButton">Сохранить биографию</button>
</form>

<script>
    var edit = function () {
        $('#summernote').summernote({
            focus: true,
            tabsize: 2,
            // height: 102
            // 4,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    };

    $('#saveButton').click(function () {
        var biography = $('#summernote').summernote('code');
        $('#biographyInput').val(biography);
        $('form').submit(); // Отправить форму
        // $('#summernote').summernote('destroy');
    });
</script>
</body>
</html>