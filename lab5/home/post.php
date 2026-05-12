<?php
declare(strict_types=1);

// Получаем и валидируем postId из GET-параметра
$postId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($postId === false || $postId === null) {
    http_response_code(400);
    echo 'Invalid post ID';
    exit;
}

$postsDatabase = [
    1 => [
        'id' => 1,
        'title' => 'The Road Ahead',
        'subtitle' => 'Thoughts on tomorrow',
        'content' => '<p>Full content of the post...</p>',
        'author' => 'John Doe',
        'published_at' => 	1356116400,
        'image' => '/lab5/images/content_image_1.png',
    ],
    2 => [
        'id' => 2,
        'title' => 'Future Past',
        'subtitle' => 'Less I know the better',
        'content' => '<p>Full content of the second post...</p>',
        'author' => 'Лиза Демина',
        'published_at' => 	1320995471,
        'image' => '/lab5/images/content_image_2.png',
    ],
];

// Проверяем существование поста
if (!isset($postsDatabase[$postId])) {
    http_response_code(404);
    echo 'Post not found';
    exit;
}

$post = $postsDatabase[$postId];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link href="lab5/css/style.css" rel="stylesheet">
</head>
<body>
    <article class="post">
        <header>
            <h1><?= htmlspecialchars($post['title']) ?></h1>
            <?php if (!empty($post['subtitle'])): ?>
                <h2><?= htmlspecialchars($post['subtitle']) ?></h2>
            <?php endif; ?>           
            <?php if (!empty($post['image'])): ?>
                <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>">
            <?php endif; ?>           
            <div class="post-meta">
                <span class="author"><?= htmlspecialchars($post['author']) ?></span>
                <time datetime="<?= date('c', $post['published_at']) ?>">
                    Опубликовано: <?= date('d.m.Y H:i', $post['published_at']) ?>
                </time>
            </div>          
        </header>        
        <div class="post-content">
            <?= $post['content'] ?>
        </div>        
    </article>    
    <nav>
        <a href="/lab5/home/index.php">← Назад к списку постов</a>
    </nav>
</body>
</html>