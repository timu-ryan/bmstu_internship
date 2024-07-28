<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Подключаем PHPMailer

// Создаем объект PHPMailer
$mail = new PHPMailer(true);

try {
    // Настройки SMTP
    $mail->isSMTP();
    $mail->Host = ''; // Замените на адрес SMTP-сервера
    $mail->SMTPAuth = true;
    $mail->Username = ''; // Ваш логин
    $mail->Password = ''; // Ваш пароль
    $mail->SMTPSecure = 'tls'; // Используйте 'tls' или 'ssl' в зависимости от настроек вашего сервера
    $mail->Port = 587; // Порт SMTP-сервера

    // От кого
    $mail->setFrom('', 'RK9 INFO');

    // Кому
    $mail->addAddress('', 'Daniil');

    // Тема письма
    $mail->Subject = 'Привет';

    // HTML-тело письма
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8'; // Установите кодировку UTF-8
    $mail->Body = '<html><body><p>Это HTML-тело вашего письма.</p></body></html>';

    // Отправка письма
    $mail->send();
    echo 'Письмо успешно отправлено';
} catch (Exception $e) {
    echo 'Письмо не удалось отправить. Ошибка: ', $mail->ErrorInfo;
}
