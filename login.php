<?php
session_start();
session_destroy();
readfile("head.html");
readfile("login.html");
readfile("foot.html");
 ?>
