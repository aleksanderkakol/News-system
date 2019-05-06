<?php
class User {
  private $conn;
  private $table_name = "registred";

  public $first_name;
  public $last_name;
  public $email;
  public $gender;
  public $is_active;
  public $password;
  public $password_check;

  public function __construct($db){
    $this->conn = $db;
  }

  function singUp() {

    if($this->isAlreadyExist()){
      return false;
    }

    $query = "INSERT INTO ".$this->table_name."(first_name, last_name, email, gender, is_active, password) VALUES (:first_name,:last_name,:email,:gender, :is_active, :password)";

    $stmt = $this->conn->prepare($query);

    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->email=$this->email;
    $this->gender=htmlspecialchars(strip_tags($this->gender));
    $this->is_active=$this->is_active;
    $this->password=$this->password;
    $this->password_check=$this->password_check;


    $stmt->bindParam(":first_name", $this->first_name);
    $stmt->bindParam(":last_name", $this->last_name);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":gender", $this->gender);
    $stmt->bindParam(":is_active", $this->is_active);
    $stmt->bindParam(":password", $this->password);

    if($stmt->execute()){
        $this->id = $this->conn->lastInsertId();
        return true;
    }
    return false;

  }

  function login(){
    $query = "SELECT email, password FROM " . $this->table_name . " WHERE email='".$this->email."' AND password='".$this->password."'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}

function isAlreadyExist(){
    $query = "SELECT * FROM " . $this->table_name . " WHERE email='".$this->email."'";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        return true;
    }
    else{
        return false;
    }
}
}

 ?>
