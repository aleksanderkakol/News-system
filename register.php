<?php
require("connection.php");
require("user.php");
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// set user property values
$user->first_name = $_POST['first_name'];
$user->last_name = $_POST['last_name'];
$user->email = $_POST['email'];
$user->gender = $_POST['gender'];
$user->is_active = 0;
$user->password = $_POST['password'];
$user->passsword_check = $_POST['passsword_check'];
$user->created_at = date('Y-m-d H:i:s');

// create the user
if($user->singUp()){
  $user_arr=array(
    "status" => true,
    "message" => "Successfully Signup!",
    "created_at" => $user->created_at
  );
}
else if($_POST['password']!==$_POST['passsword_check']){
  $user_arr=array(
    "status" => false,
    "message" => "Passwords are not match!"
  );
}
else{
  $user_arr=array(
    "status" => false,
    "message" => "User already exists!"
  );
}
print_r(json_encode($user_arr));
?>
