<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
   
  include_once '../config/database.php';
  include_once '../objects/historia.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $historia = new Historia($db);
   
  $historia->id_hist = isset($_GET['id_hist']) ? $_GET['id_hist'] : die();
   
  $historia->readOne();
   
  if($historia->name_hist!=null){

    $historia_arr = array(
          "id_hist" =>  $historia->id_hist,
          "id_epica" => $historia->id_epica,
          "name_hist" => $historia->name_hist,
          "desc_hist" => $historia->desc_hist,
          "priority_hist" => $historia->priority_hist,
          "status_hist" => $historia->status_hist
    );
   
    http_response_code(200);
    echo json_encode($historia_arr);
  } else {
    http_response_code(404);
    echo json_encode(array("message" => "Story does not exist."));
  }
?>