<div>
  <h3><?= $post['title'] ?? null ?></h3>
  <h4><?= $post['subtitle'] ?></h4>
  <h2 class="nickname"><?= $post['author'] ?></h2>
  <img class="photo_post" src="<?= htmlspecialchars($post['image']) ?>"/>
  <a title='<?= $post['title'] ?>' href='/lab5/post.php?id=<?= $post['id'] ?>'>
    <?= $post['subtitle'] ?>
  </a>
  <p><?= $post['published_at'] ?></p>
</div>
