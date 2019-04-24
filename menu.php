<?php
session_start();
require("CONNECTDB.php");
require("news_Table.php");

//set email and password to SESSION
if(isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST["email"];
  $password = md5($_POST["password"]);
} else {
  $email = $_SESSION['email'];
  $password = md5($_SESSION['password']);
}

$connect = new dbconn();
$link = $connect->db();
$value;
$userID;
//check is user email and password in DB are correct
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $query = "SELECT count(*) AS 'user' from registred where email='$email' and password=md5('$password')";
  $result = mysqli_query($link,$query);
  $data = mysqli_fetch_assoc($result);
  $value = $data['user'];
}

//after login
if($value === '1' || $_SESSION['status'] === 'logged_in') {
  if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
    $_SESSION['email'] = $_POST["email"];
    $_SESSION['password'] = $_POST["password"];
  }
  $_SESSION['status'] = 'logged_in';
  //change is_active column in DB
  $is_active = "UPDATE registred SET is_active = 1 WHERE email = '$email' AND password = '$password'";
  mysqli_query($link,$is_active) or die(mysqli_error($link));
  //select all news list
  $news_Query = "SELECT * FROM news";
  $news_Result = mysqli_query($link, $news_Query) or die(mysqli_error($link));

//add News
if (isset($_POST['add'])) {
  readfile("add_Form.html");
}
if (isset($_POST['add_news'])) {
  //user ID
  $email = $_SESSION['email'];
  $password = $_SESSION['password'];
  $userID_Query = "SELECT id from registred where email='$email' and password=md5('$password')";
  $userID_result = mysqli_query($link,$userID_Query);
  $id = mysqli_fetch_assoc($userID_result);
  $userID = $id['id'];
  //ADD
  $add_name = $_POST['add_name'];
  $add_dsc = $_POST['add_dsc'];
  $add_active = $_POST['add_active'];
  $news_Add = "INSERT news (name,description, is_active, created_at, updated_at, author_id) VALUES ('$add_name', '$add_dsc',$add_active, current_timestamp, current_timestamp,'$userID')";
  $news_Update_Result = mysqli_query($link, $news_Add) or die(mysqli_error($link));
  $news_Result = mysqli_query($link, $news_Query) or die(mysqli_error($link));
}
//edit News
  if(isset($_POST['edit'])){
    $update_table = New Table();
    $update_table->editNews();
  }
  if(isset($_POST['save_changes']) && $_POST['save_changes']==='save') {
    $old_name = $_SESSION['name'];
    $update_name = $_POST['update_name'];
    $update_dsc = $_POST['update_dsc'];
    $update_active = $_POST['active'];
    $news_Update = "UPDATE news SET name = '$update_name',description = '$update_dsc',is_active = $update_active, updated_at = current_timestamp WHERE name = '$old_name'";
    $news_Update_Result = mysqli_query($link, $news_Update) or die(mysqli_error($link));
    $news_Result = mysqli_query($link, $news_Query) or die(mysqli_error($link));
    unset($_SESSION['name']);
  }
//delete news
if (isset($_POST['delete'])) {
  $delete_table = New Table();
  $delete_table->removeNews();
}
if(isset($_POST['remove'])) {
  $remove = $_POST['remove'];
  $news_Remove = "DELETE FROM news WHERE name = '$remove'";
  $news_Remove_Result = mysqli_query($link, $news_Remove) or die(mysqli_error($link));
  $news_Result = mysqli_query($link, $news_Query) or die(mysqli_error($link));
}

  readfile("head.html");
  readfile("add_News.html");
  $table = New Table();
  $table->createTable($news_Result);
  echo "<a class='btn' href='logout.php'>Wyloguj</a>";
  readfile("foot.html");
} else {
  echo "Błędne hasło";
}
 ?>
