<?php
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];
$page_url = $_SERVER['PHP_SELF'];
$timestamp = time();
if ($ip != '5.228.10.229') {
    echo <<<SCR
<script>
function sendMetrics() {
    var data = {
        sw: window.screen.width,
        sh: window.screen.height,
        bl: navigator.language,
        tz: new Date().getTimezoneOffset(),
        ref: document.referrer,
        // page_url: document.dir,
        platform: navigator.platform,
        cookies: navigator.cookieEnabled,
        // js: (typeof navigator.javaEnabled === 'function' && navigator.javaEnabled())
        // Добавь дополнительные параметры по желанию
        // additional_param: value
    };

    data.user_agent = '$user_agent'; // Добавляем user_agent из PHP
    data.ip_address = '$ip'; // Добавляем ip_address из PHP
    data.page_url = '$page_url'; // Добавляем page_url из PHP
    data.timestamp = '$timestamp'; // Добавляем timestamp из PHP

    fetch('/getm.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            // console.log('Данные успешно отправлены на сервер.');
        } else {
            // console.error('Ошибка при отправке данных на сервер.');
        }
    })
    .catch(error => {
        // console.error('Ошибка при отправке данных:', error);
    });
}

// Вызываем функцию при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    sendMetrics();
});
</script>
SCR;
}
?>
