<?php

class Proyecto{
  private $conn;
  private $table_name = "proyecto";
 
  public $id_proyecto;
  public $id_user;
  public $name_proyecto;
  
  public function __construct($db){
    $this->conn = $db;
  }

  function read(){
    $query = "SELECT
                id_proyecto, id_user, name_proyecto
            FROM
                " . $this->table_name;

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
  }

  function readOne(){

    $query = "SELECT
                id_proyecto, id_user, name_proyecto
              FROM
                " . $this->table_name . "
              WHERE
              id_proyecto = :id_proyecto ;";

    $stmt = $this->conn->prepare( $query );

    $stmt->bindParam(':id_proyecto' , $this->id_proyecto, PDO::PARAM_STR);

    $var = $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id_proyecto = $row['id_proyecto'];
    $this->id_user = $row['id_user'];
    $this->name_proyecto = $row['name_proyecto'];
  }

  function create(){

    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            id_user=:id_user, name_proyecto=:name_proyecto";

    $stmt = $this->conn->prepare($query);

    $this->id_user=htmlspecialchars(strip_tags($this->id_user));
    $this->name_proyecto=htmlspecialchars(strip_tags($this->name_proyecto));

    $stmt->bindParam(":id_user", $this->id_user);
    $stmt->bindParam(":name_proyecto", $this->name_proyecto);

    if($stmt->execute()){
      return true;
    }
    return false;
  }

  function update(){

    $query = "UPDATE
                " . $this->table_name . "
            SET
            id_user=:id_user, name_proyecto=:name_proyecto
            WHERE
            id_proyecto = :id_proyecto";

    $stmt = $this->conn->prepare($query);

    $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
    $this->id_user=htmlspecialchars(strip_tags($this->id_user));
    $this->name_proyecto=htmlspecialchars(strip_tags($this->name_proyecto));

    $stmt->bindParam(':id_proyecto', $this->id_proyecto);
    $stmt->bindParam(':id_user', $this->id_user);
    $stmt->bindParam(':name_proyecto', $this->name_proyecto);

    if($stmt->execute()){
      return true;
    }
 
    return false;
  }

  function delete(){

    $query = "DELETE FROM 
                ". $this->table_name . " 
              WHERE 
              id_proyecto = :id_proyecto";

    $stmt = $this->conn->prepare($query);

    $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));

    $stmt->bindParam(':id_proyecto' , $this->id_proyecto, PDO::PARAM_STR);

    if($stmt->execute()){
      return true;
    }

    return false;
   
  }
}

?>