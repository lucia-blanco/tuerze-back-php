<?php

  class Usuario {
    private $conn;
    private $table_name = "usuario";
  
    public $id_user;
    public $display_name;
    public $username;
    public $pic_url;
    
    public function __construct($db){
      $this->conn = $db;
    }

    function read(){
      $query = "SELECT
                  display_name, username, id_user, pic_url
              FROM
                  " . $this->table_name . " ";

      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }

    function readOne(){

      $query = "SELECT
                  display_name, username, id_user, pic_url
                FROM
                  " . $this->table_name . "
                WHERE
                id_user = :id_user ;";

      $stmt = $this->conn->prepare( $query );

      $stmt->bindParam(':id_user' , $this->id_user, PDO::PARAM_STR);

      $var = $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id_user = $row['id_user'];
      $this->display_name = $row['display_name'];
      $this->username = $row['username'];
      $this->pic_url = $row['pic_url'];
    }

    function create(){

      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
              display_name=:display_name, username=:username, id_user=:id_user, pic_url=:pic_url";

      $stmt = $this->conn->prepare($query);

      $this->display_name=htmlspecialchars(strip_tags($this->display_name));
      $this->username=htmlspecialchars(strip_tags($this->username));
      $this->id_user=htmlspecialchars(strip_tags($this->id_user));
      $this->pic_url=htmlspecialchars(strip_tags($this->pic_url));

      $stmt->bindParam(":display_name", $this->display_name);
      $stmt->bindParam(":username", $this->username);
      $stmt->bindParam(":id_user", $this->id_user);
      $stmt->bindParam(":pic_url", $this->pic_url);

      if($stmt->execute()){
        return true;
      }
      return false;
    }
  }

?>