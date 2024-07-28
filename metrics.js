// Отправляем данные на сервер
function sendMetrics() {
    var data = {
        sw: window.screen.width,
        sh: window.screen.height,
        bl: navigator.language,
        tz: new Date().getTimezoneOffset(),
        ref: document.referrer,
        platform: navigator.platform,
        cookies: navigator.cookieEnabled,
        js: (typeof navigator.javaEnabled === 'function' && navigator.javaEnabled())
        // Добавь дополнительные параметры по желанию
        // additional_param: value
    };

    fetch('metrics.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.ok) {
            console.log('Данные успешно отправлены на сервер.');
        } else {
            console.error('Ошибка при отправке данных на сервер.');
        }
    })
    .catch(error => {
        console.error('Ошибка при отправке данных:', error);
    });
}

// Вызываем функцию при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    sendMetrics();
});
