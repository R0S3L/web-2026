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
        </style>
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
       <div class="scroll_bar">
          <div style="width: 474px; height: 700px;">
            <div class="user_bar">
                <img class="user_photo" src="../images/user_first.png" alt="User First">
                <h2 class="nickname">Ваня Денисов</h2>
                <img class="icons pen" src="../images/icons/pen.svg" alt="Edit">
            </div>
            <div>
                <a href='/lab5/post.php?id=1'>
                    <img class="photo_post" src="../images/content_image_1.png" alt="Content 1"/>
                </a>
            </div> 
            <div class="react_border">
                <img class="react_border likes" src="../images/icons/like.png" alt="Likes">
                <h2 class="react_border counter">203</h2>    
            </div>
            <div>
               <h3 class="comments">Так красиво сегодня на улице! Настоящая зима)) 
                Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне... </h3>
                <h3 class="comments description">ещё</h3>
                <h3 class="comments description">2 часа назад</h3>
            </div>
          </div>
          <div style="width: 474px; height: 700px;">
            <div class="user_bar">
                <img class="user_photo" src="../images/user_second.png" alt="User Second">
                <h2 class="nickname">Лиза Демина</h2>
                <img class="icons pen" src="../images/icons/pen.svg" alt="Edit">
            </div>
            <div>
<<<<<<< HEAD
                <a  href='/lab5/post.php?id=2'>
=======
                <a href='/lab5/post.php?id=2'>
>>>>>>> a3917d706710d29ba17101c5ebb4dbcad1df254e
                    <img class="photo_post" src="../images/content_image_2.png" alt="Content 2">
                </a>
            </div> 
            <div class="react_border">
                <img class="react_border likes" src="../images/icons/like.png" alt="Likes">
                <h2 class="react_border counter">204</h2>    
            </div>
            <div>
               <h3 class="comments">Так красиво сегодня на улице! Настоящая зима)) 
                Вспоминается Бродский: «Поздно ночью, в уснувшей долине, на самом дне... </h3>
                <h3 class="comments description">ещё</h3>
                <h3 class="comments description">2 дня назад</h3>
            </div>
          </div>
       </div>
    </body>
</html>