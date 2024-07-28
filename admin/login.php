<?php
include '../metrics.php';
session_start();
if ($_SESSION['isAdmin']) {
    header("Location: /admin");
    exit();
}
require '../connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT id, is_admin FROM users WHERE username = :username AND password = :password";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Проверка результата
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row["is_admin"] == 1) {
            $_SESSION['isAdmin'] = $username;
            header("Location: /admin");
            exit();
        } else {
            echo '<script>alert("Вы не являетесь администратором.")</script>';
        }
    } else {
        echo '<script>alert("Неверное имя пользователя или пароль.")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Вход в админку</title>
    <style>
        /* Твои базовые стили */

        .centered-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: var(--bmwhite);
        }

        .login-form {
            width: 100%;
            max-width: 300px;
            padding: 2em;
            background-color: white;
            border-radius: 1.25em;
            box-shadow: 0 0.625em 1.25em rgba(0, 0, 0, 0.1);
        }

        .login-form input {
            display: block;
            width: 100%;
            padding: 0.5em;
            margin: 0.5em 0;
            border: 1px solid var(--bmgray);
            border-radius: 0.3125em;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .login-form button {
            margin-top: 1em;
            padding: 0.5em 1em;
            font-size: 1.2em;
            background-color: var(--bmblue);
            border: none;
            border-radius: 0.3125em;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="centered-section">
        <h2>Вход в админку</h2>
        <form class="login-form" method="post">
            <input type="text" id="username" name="username" placeholder="Имя пользователя" required>
            <input type="password" id="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
        </form>
    </div>
</div>
</body>
</html>
