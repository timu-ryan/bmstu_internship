<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config.php';
@header('Content-Type: text/html; charset=utf-8');
if (!isset($port))
    $port = 3306;
try {
    $db = new PDO("mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password, array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false
    ));
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
