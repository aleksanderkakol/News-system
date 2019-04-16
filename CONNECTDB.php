<?php
require('CONFIG.php');
class dbconn {

function __construct($dbName = null){
  $this->connect($dbName);
}
protected function connect($dbName) {
  global $ipAddress;
  global $userName;
  global $userPassword;
  global $dataBaseName;

  if($dbName!=null) {
    $this->database = mysqli_connect($ipAddress,$userName,$userPassword,$dbName);
  } else {
    $this->database = mysqli_connect($ipAddress,$userName,$userPassword,$dataBaseName);
  }
}

public function __destruct(){
    mysqli_close($this->database);
}

function db(){
     if (!isset($this->database)) {
        $this->connect();
     }
     return $this->database;
  }
}
 ?>
