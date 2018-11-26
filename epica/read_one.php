<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
   
  include_once '../config/database.php';
  include_once '../objects/epica.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $epica = new Epica($db);
   
  $epica->id_epica = isset($_GET['id_epica']) ? $_GET['id_epica'] : die();
   
  $epica->readOne();
   
  if($epica->id_epica!=null){

    $epica_arr = array(
          "id_epica" =>  $epica->id_epica,
          "id_proyecto" =>  $epica->id_proyecto,
          "name_epica" => $epica->name_epica,
          "desc_epica" => $epica->desc_epica,
          "status_epica" => $epica->status_epica
    );
   
    http_response_code(200);
    echo json_encode($epica_arr);
  }
   
  else {
    http_response_code(404);
    echo json_encode(array("message" => "Epic does not exist."));
  }
?>