<?php

class Tarea{
  private $conn;
  private $table_name = "tarea";
 
  public $id_tarea;
  public $id_proyecto;
  public $id_epica;
  public $id_historia;
  public $name_tarea;
  public $desc_tarea;
  public $priority_tarea;
  public $status_tarea;
 
  public function __construct($db){
    $this->conn = $db;
  }

  function read(){
    $query = "SELECT
                id_tarea, id_proyecto, id_epica, id_historia, name_tarea, desc_tarea, priority_tarea, status_tarea
            FROM
                " . $this->table_name ;

    $stmt = $this->conn->prepare($query);

    // $stmt->bindParam(':id_historia' , $this->id_historia, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt;
  }

  function readOne(){

    $query = "SELECT
                id_tarea, id_proyecto, id_epica, id_historia, name_tarea, desc_tarea, priority_tarea, status_tarea
              FROM
                " . $this->table_name . "
              WHERE
              id_tarea = :id_tarea ;";

    $stmt = $this->conn->prepare( $query );

    $stmt->bindParam(':id_tarea' , $this->id_tarea, PDO::PARAM_STR);

    $var = $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->id_tarea = $row['id_tarea'];
    $this->id_proyecto = $row['id_proyecto'];
    $this->id_epica = $row['id_epica'];
    $this->id_historia = $row['id_historia'];
    $this->name_tarea = $row['name_tarea'];
    $this->desc_tarea = $row['desc_tarea'];
    $this->priority_tarea = $row['priority_tarea'];
    $this->status_tarea = $row['status_tarea'];
  }

  function create(){

    $query = "INSERT INTO
                " . $this->table_name . "
            SET
            id_proyecto=:id_proyecto, id_epica=:id_epica, id_historia=:id_historia, name_tarea=:name_tarea, desc_tarea=:desc_tarea, priority_tarea=:priority_tarea, status_tarea=:status_tarea";

    $stmt = $this->conn->prepare($query);

    $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
    $this->id_epica=htmlspecialchars(strip_tags($this->id_epica));
    $this->id_historia=htmlspecialchars(strip_tags($this->id_historia));
    $this->name_tarea=htmlspecialchars(strip_tags($this->name_tarea));
    $this->desc_tarea=htmlspecialchars(strip_tags($this->desc_tarea));
    $this->priority_tarea=htmlspecialchars(strip_tags($this->priority_tarea));
    $this->status_tarea=htmlspecialchars(strip_tags($this->status_tarea));

    $stmt->bindParam(":id_proyecto", $this->id_proyecto);
    $stmt->bindParam(":id_epica", $this->id_epica);
    $stmt->bindParam(":id_historia", $this->id_historia);
    $stmt->bindParam(":name_tarea", $this->name_tarea);
    $stmt->bindParam(":desc_tarea", $this->desc_tarea);
    $stmt->bindParam(":priority_tarea", $this->priority_tarea);
    $stmt->bindParam(":status_tarea", $this->status_tarea);

    if($stmt->execute()){
      return true;
    }
    return false;
  }

  function update(){

    $query = "UPDATE
                " . $this->table_name . "
            SET
            id_proyecto=:id_proyecto, id_epica=:id_epica, id_historia=:id_historia, name_tarea=:name_tarea, desc_tarea=:desc_tarea, priority_tarea=:priority_tarea, status_tarea=:status_tarea
            WHERE
            id_tarea = :id_tarea";

    $stmt = $this->conn->prepare($query);

    $this->id_tarea=htmlspecialchars(strip_tags($this->id_tarea));
    $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
    $this->id_epica=htmlspecialchars(strip_tags($this->id_epica));
    $this->id_historia=htmlspecialchars(strip_tags($this->id_historia));
    $this->name_tarea=htmlspecialchars(strip_tags($this->name_tarea));
    $this->desc_tarea=htmlspecialchars(strip_tags($this->desc_tarea));
    $this->priority_tarea=htmlspecialchars(strip_tags($this->priority_tarea));
    $this->status_tarea=htmlspecialchars(strip_tags($this->status_tarea));

    $stmt->bindParam(":id_tarea", $this->id_tarea);
    $stmt->bindParam(":id_proyecto", $this->id_proyecto);
    $stmt->bindParam(":id_epica", $this->id_epica);
    $stmt->bindParam(":id_historia", $this->id_historia);
    $stmt->bindParam(":name_tarea", $this->name_tarea);
    $stmt->bindParam(":desc_tarea", $this->desc_tarea);
    $stmt->bindParam(":priority_tarea", $this->priority_tarea);
    $stmt->bindParam(":status_tarea", $this->status_tarea);

    if($stmt->execute()){
      return true;
    }
 
    return false;
  }

  function delete(){

    $query = "DELETE FROM 
                ". $this->table_name . " 
              WHERE 
              id_tarea = :id_tarea";

    $stmt = $this->conn->prepare($query);

    $this->id_tarea=htmlspecialchars(strip_tags($this->id_tarea));

    $stmt->bindParam(':id_tarea' , $this->id_tarea, PDO::PARAM_STR);

    if($stmt->execute()){
      return true;
    }

    return false;
   
  }
}

?>