<section id="news">
  <article>
    <header>
      <h1><a href="news_item.php?id=<?= $article['id'] ?>"><?= $article['title'] ?></a></h1>
    </header>
    <img src="http://lorempixel.com/600/300/business/" alt="">
    <p><?= $article['introduction'] ?></p>
    <p><?= $article['fulltext'] ?></p>
    <?php if (array_key_exists('username', $_SESSION) && !empty($_SESSION['username'])) { ?>
    <div>
      <a style="color:black;" id="edit" href="edit_news.php?id=<?=$article['id']?>">Edit</a>
    </div>
    <?php } ?>

    <section id="comments">
      <?php include('templates/comments/list_comments.php') ?>  

      <form>
        <h2>Add your voice...</h2>
        <label>Username 
          <input type="text" name="username">
        </label>
        <label>E-mail
          <input type="email" name="email">
        </label>
        <label>Comment
          <textarea name="comment"></textarea>            
        </label>
        <input type="submit" value="Reply">
      </form>
    </section>

    <footer>
      <span class="author"><?= $article['username'] ?></span>
      <?php $tags = explode(',', $article['tags']); ?>
      <span class="tags"><?php foreach($tags as $tag) { ?>
          <a href="#"><?= '#' . $tag ?></a>
        <?php } ?>
      </span>
      <span class="date"><?= date("d-m-Y H:i:s", substr($article['published'],0,10)) ?></span>
      <a class="comments" href="#"><?= count($comments) ?></a>
    </footer>
  </article>
</section>