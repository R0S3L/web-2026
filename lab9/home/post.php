<?php
$imageCount = count($postImages);
$sliderId = 'slider_' . $post['id_post'];
?>
<div class="post">
    <div class="user_bar">
        <img class="user_photo"
             src="../images/<?= $userImage ?>"
             alt="<?= $fullName ?>">
        <h2 class="nickname"><?= $fullName ?></h2>
        <img class="icons pen" src="../images/icons/pen.svg" alt="Редактировать">
    </div>

    <div class="slider" id="<?= $sliderId ?>">
        <div class="slider__track">
            <?php foreach ($postImages as $img): ?>
                <div class="slider__slide">
                    <img class="photo_post"
                         src="../images/<?= htmlspecialchars($img) ?>"
                         alt="Фото поста">
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($imageCount > 1): ?>
            <button class="slider__btn slider__btn--prev" aria-label="Назад">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </button>
            <button class="slider__btn slider__btn--next" aria-label="Вперёд">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
            <div class="slider__counter">
                <span class="slider__current">1</span>/<span class="slider__total"><?= $imageCount ?></span>
            </div>
        <?php endif; ?>
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