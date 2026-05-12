
  <div class="user_bar">
    <img class="user_photo" src="<?= $post['author_photo'] ?? '../images/user_default.png' ?>" alt="Пользователь">
    <h2 class="nickname"><?= $post['author'] ?></h2>
    <img class="icons pen" src="../images/icons/pen.svg" alt="Редактировать">
  </div>
  <div>
      <a href="/lab5/home/post.php?id=<?= $post['id'] ?>">
          <img class="photo_post" src='<?= $post['image'] ?>' alt="Пост" >
      </a>
  </div> 
  <div class="react_border">
      <img class="react_border likes" src="../images/icons/like.png" alt="Лайки" >
      <h2 class="react_border counter"><?= (int)($post['likes'] ?? 0) ?></h2>    
  </div>
  <div>
      <h3 class="comments"><?= $post['content'] ?></h3>
      <h3 class="comments description">ещё</h3>
      <h3 class="comments description"><?= $post['published_at'] ?></h3>
  </div>

