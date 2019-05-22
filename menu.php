<?php
session_start();
require("connection.php");
require("news.php");
  $database = new Database();
  $db = $database->getConnection();
if (isset($_SESSION['status']['status']) && $_SESSION['status']['status'] == true) {
  $news = new News($db);
  $news->getNews();
}
else {
  $error = array(
    "status" => "false",
    "message" => "Invalid Email or Password!",
  );
  print_r(json_encode($error));
}
 ?>
