<?php
declare(strict_types=1);

$posts = [
    [
        'id' => 1,
        'title' => 'The Road Ahead',
        'subtitle' => 'Thoughts on tomorrow',
        'author' => 'John Doe',
        'published_at' => 	1356116400, // 	Fri Dec 21 2012 19:00:00 GMT+0000
    ],
    [
        'id' => 2,
        'title' => 'Minimalist Living',
        'subtitle' => 'Less is more',
        'author' => 'Jane Smith',
        'img_modifier' => 'large',
        'published_at' => 	1320995471, // 	Fri Nov 11 2011 07:11:11 GMT+0000
        'image' => '/static/post2.jpg',
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
    <blockquote class="posts">
        <?php 
        foreach ($posts as $post) {
        include 'post_preview.php';
        }
        ?>
    </blockquote>
</section>
</body>
</html>