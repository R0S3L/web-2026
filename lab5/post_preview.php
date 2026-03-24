<div>
  <h3><?= $post['title'] ?></h3>
  <h4><?= $post['subtitle'] ?></h4>
  <span><?= $post['author'] ?></span>
  <a title='<?= $post['title'] ?>' href='/lab5/post.php?id=<?= $post['id'] ?>'>
    <?= $post['subtitle'] ?>
  </a>
  <p><?= $post['published_at'] ?></p>
</div>
