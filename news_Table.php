<?php
class Table {
  private $save_changes;
  private $update_name;
  private $update_dsc;
  private $active;
  private $remove;

  function __construct() {
    $this->save_changes = isset($_POST['save_changes']) ? $_POST['save_changes'] : null;
    $this->update_name = isset($_POST['update_name']) ? $_POST['update_name'] : null;
    $this->update_dsc = isset($_POST['update_dsc']) ? $_POST['update_dsc'] : null;
    $this->active = isset($_POST['active']) ? $_POST['active'] : null;    $this->active = isset($_POST['active']) ? $_POST['active'] : null;
    $this->remove = isset($_POST['remove']) ? $_POST['remove'] : null;

  }
  function createTable($new_news) {
    $i=0;
    echo "<table class='table'><thead><tr>";
    while ($i<mysqli_num_fields($new_news)) {
      $fieldName = mysqli_fetch_field_direct($new_news, $i);
      $col = $fieldName->name;
      echo "<th>$col</th>";
      $i = $i + 1;
    }
    echo "<th>Edytuj</th>";
    echo "<th>Usuń</th>";
    echo "</tr></thead>";
    $i = 0;
    echo "<tbody>";
    while ($line = mysqli_fetch_array($new_news, MYSQLI_ASSOC)) {
      echo "<tr>";
      echo "<form action='menu.php' method='post'>";
      foreach ($line as $key=>$col_value) {
          echo "<td name='$key'><input type='hidden' name='$key' value='$col_value'>$col_value</td>";
        }
        echo "<td><button class='btn' type='submit' name='edit' value='edit'>Edytuj</button></td>";
        echo "<td><button class='btn' type='submit' name='delete' value={$line['name']}>Usuń</button></td>";
      echo "</form></tr>";
    }
    echo "</tbody></table>";
  }
  function editNews() {
    if (isset($_POST['edit'])) {
      $name = $_POST['name'];
      $_SESSION['name'] = $name;
      $dsc = $_POST['description'];
      $active = $_POST['is_active'];
      echo "<div class='wrap'>";
      echo "<form class='form_edit' action='menu.php' method='post'>";
      echo "<input type='text' name='update_name' value='$name'>";
      echo "<input type='text' name='update_dsc' value='$dsc'>";
      echo "<input type='number' min=0 max=1 name='active' value=$active>";
      echo "<button class='btn' type='submit' name='save_changes' value='save'>Zapisz zmiany</button>";
      echo "<a class='btn' href='menu.php'>Anuluj</a>";
      echo "</div>";
    }
  }
  function removeNews() {
    if (isset($_POST['delete'])) {
      $name = $_POST['name'];
      echo "<div class='wrap'>";
      echo "<form class='form_delete' action='menu.php' method='post'>";
      echo "<h3>Czy na pewno usunąć $name?</h3>";
      echo "<button class='btn' type='submit' name='remove' value='$name'>Tak</button>";
      echo "<a class='btn' href='menu.php'>Nie</a>";
      echo "</div>";
    }
  }
}
 ?>
