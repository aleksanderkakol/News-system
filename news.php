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

  function getNews() {
    $query = "SELECT .$this->table_name.id, .$this->table_name.name, .$this->table_name.description, .$this->table_name.is_active, .$this->table_name.created_at, .$this->table_name.updated_at, CONCAT(registred.first_name,' ', registred.last_name) AS author FROM  .$this->table_name, registred WHERE .$this->table_name.author_id = registred.id";
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

    $query = "UPDATE .$this->table_name SET name = $this->name, description = $this->description, is_active = $this->is_active WHERE id = $this->id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $stmt->bindParam(":id", $this->id);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":is_active", $this->is_active);
  }
}
?>
