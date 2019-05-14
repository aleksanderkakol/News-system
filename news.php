<?php
class News {
  private $conn;
  private $table_name = "news";

  public $name;
  public $description;
  public $is_active;
  public $author_id;

  public function __construct($db){
    $this->conn = $db;
  }

  function getNews() {

    $query = "SELECT * FROM " .$this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    if($stmt->execute()){
      $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return print_r(json_encode($data));
    }
  }
}
?>
