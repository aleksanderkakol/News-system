<?php
session_start();
require("connection.php");
require("news.php");
$database = new Database();
$db = $database->getConnection();

$news = new News($db);
$news->getNews();
 ?>
