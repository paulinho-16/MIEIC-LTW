<form action="actions/action_add_news.php" method="post">
    <h2>Add News</h2>
    <input type="hidden" name="id" value="<?=$id?>">
    <label>Title:
        <div><input type="text" name="title"></div>
    </label> <br>
    <label>Introduction:
        <div><textarea name="introduction" cols="30" rows="4"></textarea></div>
    </label> <br>
    <label>Fulltext:
        <div><textarea name="fulltext" cols="80" rows="20"></textarea></div>
    </label> <br>
    <label>Tags:
        <div><input type="text" name="tags"></div>
    </label>
    <input type="submit" value="Add">
</form>