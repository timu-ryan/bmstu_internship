<?php
//error_reporting(E_ALL);
//ini_set('error_reporting', 1);

require 'connection.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем JSON-данные из тела запроса
    $data = json_decode(file_get_contents("php://input"), true);

    $smtp = $db->prepare('INSERT INTO metrics (ip_address, screen_width, screen_height, browser_language, timezone, referrer, platform, cookies_enabled, user_agent, page_url, timestamp) 
                                            VALUES (:ipaddress, :screen_width, :screen_height, :browser_language, :timezone, :referrer, :platform, :cookies_enabled, :user_agent, :page_url, :timestamp)');
    $smtp->execute([
        ':ipaddress' => $data['ip_address'],
        ':screen_width' => $data['sw'],
        ':screen_height' => $data['sh'],
        ':browser_language' => $data['bl'],
        ':timezone' => $data['tz'],
        ':referrer' => $data['ref'],
        ':platform' => $data['platform'],
        ':cookies_enabled' => $data['cookies'],
//        ':javascript_enabled' => $data['js'],
        ':user_agent' => $data['user_agent'],
        ':page_url' => $data['page_url'],
        ':timestamp' => time(),
    ]);
//    $res = $smtp->fetchAll();
//    print_r($res);
    // Готовим и выполняем SQL запрос для записи в базу
//    $stmt = $db->prepare("INSERT INTO metrics
//            (ip_address, screen_width, screen_height, browser_language, timezone, referrer, platform,
//            cookies_enabled, javascript_enabled, user_agent, page_url, timestamp)
//            VALUES
//            (:ip_address, :sw, :sh, :bl, :tz, :ref, :platform,
//            :cookies, :js, :user_agent, :page_url, :timestamp)");
//
//    $stmt->execute([

//        ':js' => $data['js'],
//        ':user_agent' => $data['user_agent'],
//        ':page_url' => $data['page_url'],
//        ':timestamp' => time()
//    ]);

//    echo "Данные успешно записаны в базу данных.";
}
?>
