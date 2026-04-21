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

    <nav class="side-panel">
        <button class="side-panel-button">
            <img class="side-panel-icon" src="../images/icons/home.png" width="24" height="24" alt="Дом">
            <img class="icons dot" src="../images/icons/dot.png" alt="Dot">
        </button>
        <button class="side-panel-button">
            <img class="side-panel-icon" src="../images/icons/user.png" width="24" height="24" alt="Профиль">
        </button>
        <button class="side-panel-button">
            <img class="side-panel-icon" src="../images/icons/plus.png" width="24" height="24" alt="Создать">
        </button>
    </nav>

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
            <div class="post">

                <div class="user_bar">
                    <img class="user_photo"
                         src="../images/<?= $userImage ?>"
                         alt="<?= $fullName ?>">
                    <h2 class="nickname"><?= $fullName ?></h2>
                    <img class="icons pen" src="../images/icons/pen.svg" alt="Редактировать">
                </div>

                <div>
                    <img class="photo_post"
                         src="../images/<?= $postImage ?>"
                         alt="Пост">
                </div>

                <div class="react_border">
                    <img class="react_border likes" src="../images/icons/like.png" alt="Лайки">
                    <h2 class="react_border counter"><?= $likes ?></h2>
                </div>

                <div>
                    <h3 class="comments"><?= $description ?></h3>
                    <h3 class="comments description">ещё</h3>
                    <h3 class="comments description"><?= $dateLabel ?></h3>
                </div>

            </div>
        <?php endforeach; ?>

    </div>

</body>
</html>