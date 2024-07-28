<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Столбчатая диаграмма</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 80%; margin: 0 auto;">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        // Получи данные о языках из базы данных
        <?php
            require '../connection.php';
        $query = "SELECT browser_language, COUNT(*) as count FROM metrics GROUP BY browser_language";
        $result = $db->query($query);

        $languages = [];
        $counts = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $languages[] = $row['browser_language'];
            $counts[] = $row['count'];
        }
        ?>

        // Данные для графика
        var data = {
            labels: <?php echo json_encode($languages); ?>,
            datasets: [{
                label: 'Количество',
                data: <?php echo json_encode($counts); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Опции для графика
        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Получи элемент canvas
        var ctx = document.getElementById('myChart').getContext('2d');

        // Создай столбчатую диаграмму
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    </script>
</body>
</html>
