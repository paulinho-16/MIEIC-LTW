<?php
    function getAllNews() {
        global $db;
        $stmt = $db->prepare(
            'SELECT news.*, users.*, COUNT(comments.id) AS comments
            FROM news JOIN users USING (username) LEFT JOIN comments ON comments.news_id = news.id
            GROUP BY news.id, users.username
            ORDER BY published DESC'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getArticle($id) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM news JOIN users USING (username) WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    function updateNews($id, $title, $introduction, $fulltext) {
        global $db;
        $stmt = $db->prepare('UPDATE news 
                            SET title = ?, introduction = ?, fulltext = ?
                            WHERE id = ?');
        $stmt->execute(array($title, $introduction, $fulltext, $id));
    }

    function getNextNewsID() {
        global $db;
        $stmt = $db->prepare('SELECT MAX(id) FROM news');
        $stmt->execute();
        $next_id = ($stmt->fetch())[0] + 1;
        return $next_id;
    }

    function addNews($id, $title, $tags, $username, $introduction, $fulltext) {
        global $db;
        $stmt = $db->prepare('INSERT INTO news VALUES(?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($id, $title, time(), $tags, $username, $introduction, $fulltext));
    }

    function deleteNews($id) {
        global $db;
        $stmt = $db->prepare('DELETE FROM news WHERE id = ?');
        $stmt->execute(array($id));
    }
?>