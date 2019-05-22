<?php
require("connection.php");
require("news.php");

$database = new Database();
$db = $database->getConnection();

$news = new News($db);
$news->id = $_POST['id'];
$news->name = $_POST['name'];
$news->description = $_POST['description'];
$news->is_active = $_POST['is_active'];
$news->updateNews();

 ?>
