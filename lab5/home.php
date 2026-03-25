<?php
declare(strict_types=1);

$posts = [
   1 => [
        'id' => 1,
        'title' => 'The Road Ahead',
        'subtitle' => 'Thoughts on tomorrow',
        'content' => '<p>Full content of the post...</p>',
        'author' => 'John Doe',
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab5</title>
</head>
<body>
    <div class="posts" >
        <?php 
        foreach ($posts as $post) {
        include 'post_preview.php';
        }
        ?>
    </div>
</body>
</html>