<?php
declare(strict_types=1);

$posts = [
    1 => [
        'id'           => 1,
        'title'        => 'The Road Ahead',
        'subtitle'     => 'Thoughts on tomorrow',
        'content'      => 'Так красиво сегодня на улице! Настоящая зима)) Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне...',
        'author'       => 'Ваня Денисов',
        'author_photo' => '../images/user_first.png', // Добавлено для шаблона
        'published_at' => time() - 7200,              // ~2 часа назад
        'image'        => '../images/content_image_1.png',
        'likes'        => 203,                        // Добавлено для шаблона
    ],
    2 => [
        'id'           => 2,
        'title'        => 'Future Past',
        'subtitle'     => 'Less I know the better',
        'content'      => 'Ещё один прекрасный зимний день. Снег хрустит под ногами, а воздух морозный и свежий.',
        'author'       => 'Лиза Демина',
        'author_photo' => '../images/user_second.png',
        'published_at' => time() - 172800,            // ~2 дня назад
        'image'        => '../images/content_image_2.png',
        'likes'        => 204,
    ],
];
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
        <?php foreach ($posts as $post) { 
            include 'post_preview.php'; 
            } ?>
    </div>
</body>
</html>