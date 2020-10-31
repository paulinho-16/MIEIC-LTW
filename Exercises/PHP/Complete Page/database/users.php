<?php
    function userExists($username, $password) {
        $pass = sha1($password);

        global $db;
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
        $stmt->execute(array($username, $pass));
        $user = $stmt->fetch();

        if ($user) return true;
        else return false;
    }

    function addUser($username, $password, $name) {
        $pass = sha1($password);

        global $db;
        $stmt = $db->prepare('INSERT INTO users VALUES(?, ?, ?)');
        $stmt->execute(array($username, $pass, $name));
    }
?>