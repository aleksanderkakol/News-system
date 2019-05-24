<?php
session_start();
require("connection.php");
require("user.php");

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->email = isset($_POST['email']) ? $_POST['email'] : null;
$user->password = isset($_POST['password']) ? md5($_POST['password']) : null;
$stmt = $user->login();

if($stmt->rowCount() > 0){
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['author_id'] = $row['id'];
  $_SESSION['status'] = $user_arr=array(
    "status" => "true",
    "message" => "Successfully Login!",
    "email" => $row['email'],
  );
  $user->isActive();
}
else{
  $user_arr=array(
    "status" => "false",
    "message" => "Invalid Email or Password!",
  );
}
print_r(json_encode($user_arr));
 ?>
