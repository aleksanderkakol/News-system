<?php
session_start();
require("connection.php");
require("user.php");

$email = $_SESSION['email'];
$password = $_SESSION['password'];

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->logout($email, $password);

session_destroy();
header("Location: index.html");
 ?>
