<div>
  <h3><?= $post['title'] ?? null ?></h3>
  <h4><?= $post['subtitle'] ?></h4>
  <span><?= $post['author'] ?></span>
  <img src="<?= htmlspecialchars($post['image']) ?>"/>
  <a title='<?= $post['title'] ?>' href='/lab5/post.php?id=<?= $post['id'] ?>'>
    <?= $post['subtitle'] ?>
  </a>
  <p><?= $post['published_at'] ?></p>
</div>
