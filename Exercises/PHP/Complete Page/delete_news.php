<?php
    session_start();
    include_once('database/connection.php');
    include_once('database/news.php');

    if (!array_key_exists('username',$_SESSION) || empty($_SESSION['username']))
        header("Location: list_news.php");

    $id = $_GET['id'];

    include('templates/common/header.php');
    include('templates/news/delete_news.php');
    include('templates/common/footer.php');
?>