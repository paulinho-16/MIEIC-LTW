<h1><?= count($comments) ?> Comments</h1>
<?php foreach($comments as $comment) { ?>
    <article class="comment">
        <span class="user"><?= $comment['username'] ?></span>
        <span class="date"><?= date("d-m-Y H:i:s", substr($comment['published'],0,10)) ?></span>
        <p><?= $comment['text'] ?></p>
    </article>
<?php } ?>