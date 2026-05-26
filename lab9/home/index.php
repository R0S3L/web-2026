<?php
require_once __DIR__ . '\database.php';

$pdo = connectDB();

$ids = $pdo->query("SELECT id_post FROM post ORDER BY post_date DESC")->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body class="block">
    <?php include 'sidebar.php'; ?>
    <div class="scroll_bar">

        <?php if (empty($ids)): ?>
            <p>Постов пока нет.</p>
        <?php endif; ?>

        <?php foreach ($ids as $id): ?>
            <?php
                $post = findPostInDB($pdo, (int)$id);
                if ($post === null) continue;

                $fullName    = htmlspecialchars($post['user_name'] . ' ' . $post['user_surname']);
                $userImage   = htmlspecialchars($post['user_image'] ?? 'default_user.png');
                $postImage   = htmlspecialchars($post['post_image']);
                $description = htmlspecialchars($post['post_description'] ?? '');
                $likes       = (int)$post['post_likes'];
                $dateLabel   = formatPostDate($post['post_date']);

                // Массив изображений для слайдера
                $rawImages  = getPostImages($pdo, (int)$post['id_post'], $post['post_image']);
                $postImages = array_map(fn($img) => htmlspecialchars($img), $rawImages);
            ?>
            <?php include 'post.php'; ?>
        <?php endforeach; ?>

    </div>
    <div id="imageModal" class="modal">
    <button class="modal__close" aria-label="Закрыть">&times;</button>
    
    <div class="modal__content">
        <div class="slider" id="modalSlider">
            <div class="slider__track" id="modalTrack">
                </div>
            
            <button class="slider__btn slider__btn--prev" aria-label="Назад">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </button>
            <button class="slider__btn slider__btn--next" aria-label="Вперёд">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
            <div class="slider__counter">
                <span class="slider__current">1</span>/<span class="slider__total">1</span>
            </div>
        </div>
    </div>       
    <script src="../js/scripts.js"></script>
</body>
</html>