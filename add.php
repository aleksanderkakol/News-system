<?php
session_start();
require("connection.php");
require("news.php");

$database = new Database();
$db = $database->getConnection();

$news = new News($db);
$news->name = $_POST['name'];
$news->description = $_POST['description'];
$news->is_active = 1;
$news->author_id = $_SESSION['author_id'];
if($news->addNews()){
  $news_arr=array(
    "status" => true,
    "message" => "Successfully Added!"
  );
} else {
  $news_arr=array(
    "status" => false,
    "message" => "News arleady exists!"
  );
}
print_r(json_encode($news_arr));
 ?>
