<?php
    include_once('database/connection.php');
    $id = $_GET['id'];
    include('templates/common/header.php');
    include('templates/news/edit_news.php');
    include('templates/common/footer.php');
?>