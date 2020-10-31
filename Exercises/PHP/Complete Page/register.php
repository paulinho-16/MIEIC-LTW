<?php
    session_start();
    include_once('database/connection.php');
    include_once('database/news.php');

    include('templates/common/header.php');
    include('templates/users/register.php');
    include('templates/common/footer.php');
?>