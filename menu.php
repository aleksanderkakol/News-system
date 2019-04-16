<?php
session_start();
require("CONNECTDB.php");
$connect = new dbconn();
$link = $connect->db();
$value;
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $query = "SELECT count(*) AS 'user' from registred where email='$email' and password=md5('$password')";
  $result = mysqli_query($link,$query);
  $data = mysqli_fetch_assoc($result);
  $value = $data['user'];
}

if($value === '1' || $_SESSION['status'] === 'logged_in') {
  $_SESSION['status'] = 'logged_in';
  echo "zalogowany";
} else {
  echo "Błędne hasło";
}
 ?>
