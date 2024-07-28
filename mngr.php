<?php
class BanManager {
    private $banned_ips_file;

    public function __construct($banned_ips_file_path) {
        $this->banned_ips_file = $banned_ips_file_path;
    }

    public function checkIPBan() {
        $user_ip = $this->getUserIP();
        $banned_ips_json = file_get_contents($this->banned_ips_file);
        $banned_ips = json_decode($banned_ips_json, true);
        // Проверяем наличие IP-адреса в списке забаненных
        foreach ($banned_ips as $banned_ip) {
            if ($banned_ip['ip'] === $user_ip) {
                // Если IP-адрес заблокирован, выводим информацию и завершаем выполнение скрипта
                $this->showBanInfo($banned_ip);
                // Подключаем Bootstrap CSS
                echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
                exit;
            }
        }
    }

    private function showBanInfo($banned_ip) {
        // Создаем карточку Bootstrap с информацией о заблокированном IP-адресе
        echo <<<HTML
<div class="container d-flex justify-content-center">
  <div class="card text-white bg-danger">
    <div class="card-body">
    <h1>Ваш IP-адрес заблокирован!</h1>
      <h1>IP: <b>{$banned_ip['ip']}</b><br>
      Причина: {$banned_ip['reason']}<br>
      Дата бана: {$this->formatTimestamp($banned_ip['timestamp'])}
      </h1>
    </div>
  </div>
</div>
HTML;
    }

    private function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    private function formatTimestamp($timestamp) {
        return date('d.m.Y H:i:s', $timestamp);
    }
}

// Пример использования:
$banned_ips_file_path = '/var/www/fastuser/data/www/rk9.bmstu.ru/banned.json';
$banManager = new BanManager($banned_ips_file_path);
$banManager->checkIPBan();
?>
