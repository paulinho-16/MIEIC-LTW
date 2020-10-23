<section id="news">
  <?php foreach($articles as $article) { 
    $tags = explode(',', $article['tags']); ?>
    <article>
      <header>
        <h1><a href="news_item.php?id=<?= $article['id'] ?>"><?= $article['title'] ?></a></h1>
      </header>
      <img src="http://lorempixel.com/600/300/business/" alt="">
      <p><?= $article['introduction'] ?></p>
      <p><?= $article['fulltext'] ?></p>
      <footer>
        <span class="author"><?= $article['username'] ?></span>
        <span class="tags"><?php foreach($tags as $tag) { ?>
          <a href="#"><?= '#' . $tag ?></a>
        <?php } ?>
        </span>
        <span class="date"><?= date("d-m-Y H:i:s", substr($article['published'],0,10)) ?></span>
        <a class="comments" href="news_item.php?id=<?= $article['id'] ?>"><?= $article['comments'] ?></a>
      </footer>
    </article>
  <?php } ?>
</section>