<?php 
    header('Content-Type: application/json');
    include_once('database/connection.php');
    include_once('database/comments.php');

    $id = $_POST['id'];
    $username = $_POST['username'];
    $text = $_POST['text'];
    $comment_id = $_POST['comment_id'];

    addComment($id, $username, $text);
    $comments = fetchComments($id, $comment_id);

    echo json_encode($comments);
?>