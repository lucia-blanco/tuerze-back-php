<?php

class Historia{
  private $conn;
  private $table_name = "historia";
 
  public $id_hist;
  public $id_epica;
  public $name_hist;
  public $desc_hist;
  public $priority_hist;
  public $status_hist;
  
  public function __construct($db){
    $this->conn = $db;
  }

  function read(){
    $query = "SELECT
                id_hist, id_epica, name_hist, desc_hist, priority_hist, status_hist
            FROM
                " . $this->table_name ;

    $stmt = $this->conn->prepare($query);

    // $stmt->bindParam(':id_epica' , $this->id_epica, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt;
  }

  function readOne(){

    $query = "SELECT
                id_hist, id_epica, name_hist, desc_hist, priority_hist, status_hist
              FROM
                " . $this->table_name . "
              WHERE
              id_hist = :id_hist";

    $stmt = $this->conn->prepare( $query );

    $stmt->bindParam(':id_hist' , $this->id_hist, PDO::PARAM_STR);

    $var = $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id_hist = $row['id_hist'];
    $this->id_epica = $row['id_epica'];
    $this->name_hist = $row['name_hist'];
    $this->desc_hist = $row['desc_hist'];
    $this->priority_hist = $row['priority_hist'];
    $this->status_hist = $row['status_hist'];
  }

  function create(){

    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            id_epica=:id_epica, name_hist=:name_hist, desc_hist=:desc_hist, priority_hist=:priority_hist, status_hist=:status_hist";

    $stmt = $this->conn->prepare($query);

    $this->id_epica=htmlspecialchars(strip_tags($this->id_epica));
    $this->name_hist=htmlspecialchars(strip_tags($this->name_hist));
    $this->desc_hist=htmlspecialchars(strip_tags($this->desc_hist));
    $this->priority_hist=htmlspecialchars(strip_tags($this->priority_hist));
    $this->status_hist=htmlspecialchars(strip_tags($this->status_hist));

    $stmt->bindParam(":id_epica", $this->id_epica);
    $stmt->bindParam(":name_hist", $this->name_hist);
    $stmt->bindParam(":desc_hist", $this->desc_hist);
    $stmt->bindParam(":priority_hist", $this->priority_hist);
    $stmt->bindParam(":status_hist", $this->status_hist);

    if($stmt->execute()){
      return true;
    }
    return false;
  }
  
  function update(){

    $query = "UPDATE
                " . $this->table_name . "
            SET
            id_epica=:id_epica, name_hist=:name_hist, desc_hist=:desc_hist, priority_hist=:priority_hist, status_hist=:status_hist
            WHERE
            id_hist = :id_hist";

    $stmt = $this->conn->prepare($query);

    $this->id_hist=htmlspecialchars(strip_tags($this->id_hist));
    $this->id_epica=htmlspecialchars(strip_tags($this->id_epica));
    $this->name_hist=htmlspecialchars(strip_tags($this->name_hist));
    $this->desc_hist=htmlspecialchars(strip_tags($this->desc_hist));
    $this->priority_hist=htmlspecialchars(strip_tags($this->priority_hist));
    $this->status_hist=htmlspecialchars(strip_tags($this->status_hist));

    $stmt->bindParam(':id_hist', $this->id_hist);
    $stmt->bindParam(':id_epica', $this->id_epica);
    $stmt->bindParam(':name_hist', $this->name_hist);
    $stmt->bindParam(':desc_hist', $this->desc_hist);
    $stmt->bindParam(':priority_hist', $this->priority_hist);
    $stmt->bindParam(':status_hist', $this->status_hist);

    if($stmt->execute()){
      return true;
    }
 
    return false;
  }

  function delete(){

    $query = "DELETE FROM 
                ". $this->table_name . " 
              WHERE 
              id_hist = :id_hist";

    $stmt = $this->conn->prepare($query);

    $this->id_hist=htmlspecialchars(strip_tags($this->id_hist));

    $stmt->bindParam(':id_hist' , $this->id_hist, PDO::PARAM_STR);

    if($stmt->execute()){
      return true;
    }

    return false;
   
  }
}

?>