<?php
require("coo.php");
require("f.php");
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// set user property values
$user->first_name = $_POST['first_name'];
$user->last_name = $_POST['last_name'];
$user->email = $_POST['email'];
$user->gender = $_POST['gender'];
$user->is_active = true;
$user->password = $_POST['password'];
$user->created_at = date('Y-m-d H:i:s');
$user->updated_at = date('Y-m-d H:i:s');

// create the user
if($user->singUp()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "first_name" => $user->first_name
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );
}
print_r(json_encode($user_arr));
?>
