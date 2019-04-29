<?php
require("coo.php");
require("f.php");
$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->first_name = isset($_GET['first_name']) ? $_GET['first_name'] : die();
$user->password = isset($_GET['password']) ? $_GET['password'] : die();

$stmt = $user->login();
if($stmt->rowCount() > 0){

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "first_name" => $row['first_name']
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}
print_r(json_encode($user_arr));
?>
