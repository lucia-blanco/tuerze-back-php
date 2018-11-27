<?php

class Repositorio{
  private $conn;
  private $table_name = "repositorio";
 
  public $id_repo;
  public $id_proyecto;
  public $URL_repo;
  
  public function __construct($db){
    $this->conn = $db;
  }

  function read(){
    $query = "SELECT
                id_repo, id_proyecto, URL_repo
            FROM
                " . $this->table_name ."
            WHERE
                id_proyecto = :id_proyecto";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':id_proyecto' , $this->id_proyecto, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt;
  }

  function readOne(){

    $query = "SELECT
                id_repo, id_proyecto, URL_repo
              FROM
                " . $this->table_name . "
              WHERE
              id_repo = :id_repo ;";

    $stmt = $this->conn->prepare( $query );

    $stmt->bindParam(':id_repo' , $this->id_repo, PDO::PARAM_STR);

    $var = $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id_repo = $row['id_repo'];
    $this->id_proyecto = $row['id_proyecto'];
    $this->URL_repo = $row['URL_repo'];
  }

  function create(){

    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            id_proyecto=:id_proyecto, URL_repo=:URL_repo";

    $stmt = $this->conn->prepare($query);

    $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
    $this->URL_repo=htmlspecialchars(strip_tags($this->URL_repo));

    $stmt->bindParam(":id_proyecto", $this->id_proyecto);
    $stmt->bindParam(":URL_repo", $this->URL_repo);

    if($stmt->execute()){
      return true;
    }
    return false;
  }

  function update(){

    $query = "UPDATE
                " . $this->table_name . "
            SET
            id_proyecto=:id_proyecto, URL_repo=:URL_repo
            WHERE
            id_repo = :id_repo";

    $stmt = $this->conn->prepare($query);

    $this->id_repo=htmlspecialchars(strip_tags($this->id_repo));
    $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
    $this->URL_repo=htmlspecialchars(strip_tags($this->URL_repo));

    $stmt->bindParam(':id_repo', $this->id_repo);
    $stmt->bindParam(':id_proyecto', $this->id_proyecto);
    $stmt->bindParam(':URL_repo', $this->URL_repo);

    if($stmt->execute()){
        return true;
    }
 
    return false;
  }

  function delete(){

    $query = "DELETE FROM 
                ". $this->table_name . " 
              WHERE 
              id_repo = :id_repo";

    $stmt = $this->conn->prepare($query);

    $this->id_repo=htmlspecialchars(strip_tags($this->id_repo));

    $stmt->bindParam(':id_repo' , $this->id_repo, PDO::PARAM_STR);

    if($stmt->execute()){
      return true;
    }

    return false;
   
  }
}

?>