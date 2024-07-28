<?php
session_start();
include '../metrics.php';
require '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='../img/rk9ico.ico' type='image/x-icon'>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="news.css">
    <title>Новости</title>
    <!--    <meta http-equiv="Refresh" content="1"/>-->
</head>
<body>
<?php include "../nav.php"; ?>

<div class="container">
    <h1>Новости</h1>
    <?php
    // Get the current page number from the URL
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Define the number of posts per page
    $postsPerPage = 4;

    // Calculate the starting index of posts for the current page
    $startIndex = ($page - 1) * $postsPerPage;

    $ct = $db->prepare("SELECT COUNT(*) FROM posts;");
    $ct->execute();
    $all_posts = $ct->fetchColumn();

    // Query to get posts for the current page
    $reversedStart = $all_posts - $startIndex - $postsPerPage + 1;
    $reversedEnd = $all_posts - $startIndex;
    //    echo $reversedStart . ' ' . $reversedEnd;
    $stmt = $db->prepare("SELECT * FROM posts WHERE id BETWEEN :start AND :end ORDER BY id DESC");
    $stmt->bindValue(':start', $reversedStart, PDO::PARAM_INT);
    $stmt->bindValue(':end', $reversedEnd, PDO::PARAM_INT);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //    echo '<pre>';
    //    print_r($posts);
    foreach ($posts as $post) {
        $p_id = $post['post_id'];
        $id = $post['id'];
        $text = base64_decode($post['title']);
        $images = json_decode($post['photos'], true);
        $date = date('d.m.Y H:i', $post['date']+60*60*3);
//
        echo <<<HTML
<div class="section">
<h3>$date</h3>
HTML;

        if (!empty($images)) {
            if (count($images) === 1) {
                echo '<img src="' . $images[0] . '" alt="News Image" class="single-image">';
            } else {
                echo '<div class="image-gallery">';
                foreach ($images as $image) {
                    echo '<img src="' . $image . '" alt="News Image" class="multi-image">';
                }
                echo '</div>';
            }
        }

        echo '<p>' . $text . '</p>';

        // Telegram URL for opening the post
        $telegramUrl = 'https://t.me/RK9_MGTU/' . $p_id;

        // Output the "Open in Telegram" button
        echo '<a href="' . $telegramUrl . '" target="_blank" class="telegram-button">Открыть в Telegram</a>';

        echo '</div>';
    }
    ?>

</div>

<div class="pagination">
    <?php
    // Calculate the total number of pages
    $totalPages = ceil($all_posts / $postsPerPage);

    // Output pagination links
    $currentPage = $page;

    // Display "Назад" button if not on the first page
    if ($currentPage > 1) {
        echo '<a href="?page=' . ($currentPage - 1) . '">Назад</a>';
    }

    // Display first page
    echo '<a href="?page=1">1</a>';

    // Display ellipsis after the first page if there are more pages
    if ($currentPage > 4) {
        echo '<span class="ellipsis">...</span>';
    }

    // Display page links
    // Display page links
    for ($i = max(2, $currentPage - 1); $i <= min($totalPages - 1, $currentPage + 1); $i++) {
        $activeClass = ($i == $currentPage) ? 'active' : '';
        echo '<a href="?page=' . $i . '" class="' . $activeClass . '">' . $i . '</a>';
    }


    // Display ellipsis before the last page if there are more pages
    if ($currentPage < $totalPages - 3) {
        echo '<span class="ellipsis">...</span>';
    }

    // Display last page
    if ($totalPages > 1) {
        echo '<a href="?page=' . $totalPages . '">' . $totalPages . '</a>';
    }

    // Display "Далее" button if not on the last page
    if ($currentPage < $totalPages) {
        echo '<a href="?page=' . ($currentPage + 1) . '">Далее</a>';
    }
    ?>
</div>


<?php include '../end.php' ?>
</body>
</html>

