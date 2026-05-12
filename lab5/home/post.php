<?php
declare(strict_types=1);
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
        'image' => '../images/content_image_1.png',
    ],
    2 => [
        'id' => 2,
        'title' => 'Future Past',
        'subtitle' => 'Less I know the better',
        'content' => '<p>Full content of the second post...</p>',
        'author' => 'Лиза Демина',
        'published_at' => 	1320995471,
        'image' => '../images/content_image_2.png',
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
    <link href="../css/style.css" rel="stylesheet">
</head>
<body class="block">
    <article class="scroll_bar">
        <div class="user_bar">
            <img
                class="user_photo"
                src="../images/user_first.png"
                alt="Пользователь"
            >
            <h2 class="nickname">
                <?= htmlspecialchars($post['author']) ?>
            </h2>
        </div>
        <div>
            <?php if (!empty($post['image'])): ?>
                <img
                    class="photo_post"
                    src="<?= htmlspecialchars($post['image']) ?>"
                    alt="<?= htmlspecialchars($post['title']) ?>"
                >
            <?php endif; ?>
        </div>
        <div class="react_border">
            <img
                class="react_border likes"
                src="../images/icons/like.png"
                alt="Лайки"
            >
            <h2 class="react_border counter">
                203
            </h2>
        </div>
        <div class="comments">
            <h1 class="nickname">
                <?= htmlspecialchars($post['title']) ?>
            </h1>
            <?php if (!empty($post['subtitle'])): ?>
                <h3 class="comments description">
                    <?= htmlspecialchars($post['subtitle']) ?>
                </h3>
            <?php endif; ?>
            <div class="comments">
                <?= $post['content'] ?>
            </div>
            <h3 class="comments description">
                <?= date('d.m.Y H:i', $post['published_at']) ?>
            </h3>
        </div>
        <nav>
            <a class="comments description"
               href="/lab5/home/index.php">
                ← Назад к списку постов
            </a>
        </nav>
    </article>
</body>
</html>