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