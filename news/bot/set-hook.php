<?php
$botToken  = '';
$hook_url = 'https://rk9.bmstu.ru/news/bot/bot.php';

$website = "https://api.telegram.org/bot".$botToken;

$url = $website."/setWebhook?url=".$hook_url;
echo file_get_contents($url);