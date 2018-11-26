<?php
  header("Access-Control-Allow-Origin: http://localhost:4200");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Credentials: true");
  header("Access-Control-Allow-Methods: POST, GET, DELETE, PATCH, PUT, OPTIONS");
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, X-Auth-Token");
  
  include_once '../config/database.php';
  include_once '../objects/epica.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $epic = new Epica($db);

  $data = json_decode(file_get_contents("php://input"));

  if(!empty($data->id_proyecto)&&
     !empty($data->name_epica)) {

    // $epic->id_epica = $data->id_epica;
    $epic->id_proyecto = $data->id_proyecto;
    $epic->name_epica = $data->name_epica;
    $epic->desc_epica = $data->desc_epica;
    $epic->status_epica = $data->status_epica;
   
    if($epic->create()){
      http_response_code(201);
      echo json_encode(array("message" => "Epic was created."));
    } else {
      http_response_code(503);
      echo json_encode(array("message" => "Unable to create epic."));
    }
  } else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create epic. Data is incomplete."));
  }
?>