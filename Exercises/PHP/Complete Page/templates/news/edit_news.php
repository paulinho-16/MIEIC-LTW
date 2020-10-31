<form action="action_edit_news.php" method="post">
    <h2>Editing News</h2>
    <input type="hidden" name="id" value="<?=$id?>">
    <label>Title:
        <div><input type="text" name="title"></div>
    </label> <br>
    <label>Introduction:
        <div><textarea name="introduction" cols="30" rows="4"></textarea></div>
    </label> <br>
    <label>Fulltext:
        <div><textarea name="fulltext" cols="80" rows="20"></textarea></div>
    </label>
    <input type="submit" value="Submit">
</form>