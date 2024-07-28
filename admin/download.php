<?php
session_start();
include '../metrics.php';
if (!$_SESSION['isAdmin']){
    header("Location: login.php");
    exit();
}
require '../connection.php';

if (isset($_POST['download_csv'])) {
    // Получите название базы из скрытого поля
    $database_name = $_POST['database_name'];

    // Шаг 2: Выберите данные из вашей таблицы
    $result = $db->query("SELECT * FROM excurs_event;");
    $eres = $result->fetchAll(PDO::FETCH_ASSOC);

    // Шаг 3: Создайте CSV-файл
    $filename = "excursions.csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    foreach ($eres as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
}
?>
