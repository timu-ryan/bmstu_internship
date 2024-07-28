<?php
// Создаем файл timer.txt, если он не существует
$filename = "timer.txt";
if (!file_exists($filename)) {
    file_put_contents($filename, time());
}

// Читаем текущее время из файла
$timer = file_get_contents($filename);

// Вычисляем разницу между текущим временем и временем из файла в секундах
$diff = time() - $timer;

// Выводим разницу на экран
echo "Таймер: $diff секунд";

// Обновляем файл с новым временем
//file_put_contents($filename, time());
?>