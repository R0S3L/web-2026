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
            ?>
            <?php include 'post.php'; ?>
        <?php endforeach; ?>

    </div>

</body>
</html>