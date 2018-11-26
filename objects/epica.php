<?php

  class Epica {
    private $conn;
    private $table_name = "epica";

    public $id_epica;
    public $id_proyecto;
    public $name_epica;
    public $desc_epica;
    public $status_epica;
  
    public function __construct($db){
      $this->conn = $db;
    }

    function read(){
      $query = "SELECT
                id_epica, id_proyecto, name_epica, desc_epica, status_epica
            FROM
                " . $this->table_name ;

      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }

    function readOne() {

      $query = "SELECT
                id_epica, id_proyecto, name_epica, desc_epica, status_epica
              FROM
                " . $this->table_name . "
              WHERE
              id_epica = :id_epica";

      $stmt = $this->conn->prepare( $query );

      $stmt->bindParam(':id_epica' , $this->id_epica, PDO::PARAM_STR);

      $var = $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id_epica = $row['id_epica'];
      $this->id_proyecto = $row['id_proyecto'];
      $this->name_epica = $row['name_epica'];
      $this->desc_epica = $row['desc_epica'];
      $this->desc_epica = $row['status_epica'];
    }

    function create() { 
      $query = "INSERT INTO
                " . $this->table_name . "
            SET
            id_proyecto=:id_proyecto, name_epica=:name_epica, desc_epica=:desc_epica, status_epica=:status_epica";

      $stmt = $this->conn->prepare($query);

      $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
      $this->name_epica=htmlspecialchars(strip_tags($this->name_epica));
      $this->desc_epica=htmlspecialchars(strip_tags($this->desc_epica));
      $this->status_epica=htmlspecialchars(strip_tags($this->status_epica));

      $stmt->bindParam(":id_proyecto", $this->id_proyecto);
      $stmt->bindParam(":name_epica", $this->name_epica);
      $stmt->bindParam(":desc_epica", $this->desc_epica);
      $stmt->bindParam(":status_epica", $this->status_epica);

      if($stmt->execute()){
        return true;
      }
      return false;
    }

    function update(){

      $query = "UPDATE
                " . $this->table_name . "
            SET
            id_proyecto=:id_proyecto, name_epica=:name_epica, desc_epica=:desc_epica, status_epica=:status_epica
            WHERE
            id_epica = :id_epica";

      $stmt = $this->conn->prepare($query);

      $this->id_epica=htmlspecialchars(strip_tags($this->id_epica));
      $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
      $this->name_epica=htmlspecialchars(strip_tags($this->name_epica));
      $this->desc_epica=htmlspecialchars(strip_tags($this->desc_epica));
      $this->status_epica=htmlspecialchars(strip_tags($this->status_epica));

      $stmt->bindParam(':id_epica', $this->id_epica);
      $stmt->bindParam(':id_proyecto', $this->id_proyecto);
      $stmt->bindParam(':status_epica', $this->status_epica);
      $stmt->bindParam(':desc_epica', $this->desc_epica);
      $stmt->bindParam(':status_epica', $this->status_epica);

      if($stmt->execute()){
        return true;
      }
  
      return false;
    }

    function delete(){

      $query = "DELETE FROM 
                ". $this->table_name . " 
              WHERE 
              id_epica = :id_epica";

      $stmt = $this->conn->prepare($query);

      $this->id_epica=htmlspecialchars(strip_tags($this->id_epica));

      $stmt->bindParam(':id_epica' , $this->id_epica, PDO::PARAM_STR);

      if($stmt->execute()){
        return true;
      }

      return false;
    
    }
  }
?>