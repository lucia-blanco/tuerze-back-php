<?php
  header("Access-Control-Allow-Origin: http://localhost:4200");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Credentials: true");
  header("Access-Control-Allow-Methods: POST, GET, DELETE, PATCH, PUT, OPTIONS");
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, X-Auth-Token");
  
   
  include_once '../config/database.php';
  include_once '../objects/historia.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $hist = new Historia($db);

  $data = json_decode(file_get_contents("php://input"));
   
  if(!empty($data->id_epica) &&
     !empty($data->name_hist)) {

    // $hist->id_hist = $data->id_hist;
    $hist->id_epica = $data->id_epica;
    $hist->name_hist = $data->name_hist;
    $hist->desc_hist = $data->desc_hist;
    $hist->priority_hist = $data->priority_hist;
    $hist->status_hist = $data->status_hist;
   
    if($hist->create()){
      http_response_code(201);
      echo json_encode(array("message" => "Story was created."));
    } else {
      http_response_code(503);
      echo json_encode(array("message" => "Unable to create story."));
    }
  } else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create story. Data is incomplete."));
  }
?>