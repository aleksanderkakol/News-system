<?php
session_start();
require("CONNECTDB.php");
if(isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST["email"];
  $password = md5($_POST["password"]);
} else {
  $email = $_SESSION['email'];
  $password = md5($_SESSION['password']);
}
$connect = new dbconn();
$link = $connect->db();

$is_active = "UPDATE registred SET is_active = 0, updated_at = current_timestamp WHERE email = '$email' AND password = '$password'";
mysqli_query($link,$is_active) or die(mysqli_error($link));
session_destroy();
header("Location: index.html");
 ?>
