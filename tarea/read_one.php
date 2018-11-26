<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
   
  include_once '../config/database.php';
  include_once '../objects/tarea.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $tarea = new Tarea($db);

  $tarea->id_tarea = isset($_GET['id_tarea']) ? $_GET['id_tarea'] : die();
   
  $tarea->readOne();
   
  if($tarea->name_tarea!=null){

    $tarea_arr = array(
          "id_tarea" =>  $tarea->id_tarea,
          "id_proyecto" =>  $tarea->id_proyecto,
          "id_epica" => $tarea->id_epica,
          "id_historia" => $tarea->id_historia,
          "name_tarea" => $tarea->name_tarea,
          "desc_tarea" => $tarea->desc_tarea,
          "priority_tarea" => $tarea->priority_tarea,
          "status_tarea" => $tarea->status_tarea
    );
   
    http_response_code(200);
    echo json_encode($tarea_arr);
  } else {
    http_response_code(404);
    echo json_encode(array("message" => "Task does not exist."));
  }
?>