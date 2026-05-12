<?php
declare(strict_types=1);

$posts = [
   1 => [
        'id' => 1,
        'title' => 'The Road Ahead',
        'subtitle' => 'Thoughts on tomorrow',
        'content' => '<p>Full content of the post...</p>',
        'author' => 'Ваня Денисов',
        'published_at' => 	1356116400,
        'image' => '/lab5/static/images/post1.png',
    ],
    2 => [
        'id' => 2,
        'title' => 'Future Past',
        'subtitle' => 'Less I know the better',
        'content' => '<p>Full content of the second post...</p>',
        'author' => 'Tame Impala',
        'published_at' => 	1320995471,
        'image' => '/lab5/static/images/post2.png',
    ],
];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        <meta charset="utf-8">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body class="block">
        <nav class="side-panel">
            <button class="side-panel-button">
                <img class="side-panel-icon" src="../images/icons/home.png" width="24px" height="24px">
                <img class="side-panel-icon" src="../images/icons/dot.png" alt="Dot" class="icons dot">
            </button>
            <button class="side-panel-button">
                <img class="side-panel-icon" src="../images/icons/user.png" width="24px" height="24px">
            </button>   
            <button class="side-panel-button">
                <img class="side-panel-icon" src="../images/icons/plus.png" width="24px" height="24px">
            </button>
        </nav>
       <div class="scroll-bar" >
        <?php 
        foreach ($posts as $post) {
        include 'post_preview.php';
        }
        ?>
        </div>
    </body>
</html>