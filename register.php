<?php
require("CONNECTDB.php");
$connect = new dbconn();
$link = $connect->db();

if (isset($_POST['first_name'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $password = md5($_POST['password']);
  $sql = "INSERT INTO registred (first_name, last_name, email, gender, password) VALUES ('$first_name','$last_name','$email','$gender','$password')";
  mysqli_query($link,$sql) or die(mysqli_error($link));
}

// if (isset($_POST['register'])) {
//   $first_name = $_POST['first_name'];
//   $last_name = $_POST['last_name'];
//   $email = $_POST['email'];
//   $gender = $_POST['gender'];
//   $password = md5($_POST['password']);
//   $second_password = md5($_POST['passsword_check']);
//   if ($password === $second_password) {
//   } else {
//     echo "<h3>Hasła nie są identyczne!</h3>";
//   }
// }
 ?>
