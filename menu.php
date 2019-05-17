<?php
session_start();
require("connection.php");
require("news.php");
  $database = new Database();
  $db = $database->getConnection();
if (isset($_SESSION['status']['status']) && $_SESSION['status']['status'] == true) {
  $news = new News($db);
  $news->getNews();
  // print_r($_POST);
  if(isset($_POST['id'])){
    $news->id = $_POST['id'];
    $news->name = $_POST['name'];
    $news->description = $_POST['description'];
    $news->is_active = $_POST['is_active'];
    $news->updateNews();
  }
} else {
  $error = array(
    "status" => "false",
    "message" => "Invalid Email or Password!",
  );
  print_r(json_encode($error));
}
 ?>
