<?php
  header("Access-Control-Allow-Origin: http://localhost:4200");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Credentials: true");
  header("Access-Control-Allow-Methods: POST, GET, DELETE, PATCH, PUT, OPTIONS");
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, X-Auth-Token");
  
   
  include_once '../config/database.php';
  include_once '../objects/tarea.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $tarea = new Tarea($db);

  $data = json_decode(file_get_contents("php://input"));

  if(!empty($data->id_proyecto) &&
     !empty($data->id_epica) &&
     !empty($data->name_tarea)) {

    // $tarea->id_tarea = $data->id_tarea;
    $tarea->id_proyecto = $data->id_proyecto;
    $tarea->id_epica = $data->id_epica;
    $tarea->id_historia = $data->id_historia;
    $tarea->name_tarea = $data->name_tarea;
    $tarea->desc_tarea = $data->desc_tarea;
    $tarea->priority_tarea = $data->priority_tarea;
    $tarea->status_tarea = $data->status_tarea;

    if($tarea->create()){
      http_response_code(201);
      echo json_encode(array("message" => "Task was created."));
    } else {
      http_response_code(503);
      echo json_encode(array("message" => "Unable to create task."));
    }
  } else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create task. Data is incomplete."));
  }
?>