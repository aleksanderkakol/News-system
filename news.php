<?php
class News {
  private $conn;
  private $table_name = "news";

  public $id;
  public $name;
  public $description;
  public $is_active;
  public $author_id;

  public function __construct($db){
    $this->conn = $db;
  }


  function addNews() {

    // if($this->isAlreadyExist()){
    //   return false;
    // }

    $query = "INSERT INTO ".$this->table_name."(name, description, is_active, author_id) VALUES (:name, :description, :is_active, :author_id)";
    $stmt = $this->conn->prepare($query);

    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->is_active=$this->is_active;
    $this->author_id=$this->author_id;

    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":is_active", $this->is_active);
    $stmt->bindParam(":author_id", $this->author_id);

    if($stmt->execute()){
      $this->id = $this->conn->lastInsertId();
      return true;
    }
    return false;
  }

  function getNews() {
    $query = "SELECT .$this->table_name.id, .$this->table_name.name, .$this->table_name.description, .$this->table_name.is_active, .$this->table_name.created_at, .$this->table_name.updated_at, CONCAT(registred.first_name,' ', registred.last_name) AS author FROM  .$this->table_name, registred WHERE .$this->table_name.author_id = registred.id ORDER BY id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    if($stmt->execute()){
      $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return print_r(json_encode($data));
    }
  }
  function updateNews(){
    $this->id=$this->id;
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->is_active=$this->is_active;

    $query = "UPDATE ".$this->table_name." SET name= :name, description = :description, is_active = :is_active WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":is_active", $this->is_active);

    $stmt->execute();
  }

  function deleteNews(){
    $this->id=$this->id;
    $this->name=htmlspecialchars(strip_tags($this->name));

    $query = "DELETE FROM ".$this->table_name." WHERE id = $this->id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
  }

  // function isAlreadyExist(){
  //   $query = "SELECT * FROM " . $this->table_name . " WHERE name ='".$this->name."'";
  //   $stmt = $this->conn->prepare($query);
  //   $stmt->execute();
  //   if($stmt->rowCount() > 0){
  //     return true;
  //   }
  //   else{
  //     return false;
  //   }
  // }
}
?>
