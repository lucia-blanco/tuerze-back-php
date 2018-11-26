<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
   
  include_once '../config/database.php';
  include_once '../objects/proyecto.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $proyecto = new Proyecto($db);
   
  $proyecto->id_proyecto = isset($_GET['id_proyecto']) ? $_GET['id_proyecto'] : die();
   
  $proyecto->readOne();
   
  if($proyecto->name_proyecto!=null){

    $proyecto_arr = array(
          "id_proyecto" =>  $proyecto->id_proyecto,
          "id_user" => $proyecto->id_user,
          "name_proyecto" => $proyecto->name_proyecto
    );
   
    http_response_code(200);
    echo json_encode($proyecto_arr);
  } else {
    http_response_code(404);
    echo json_encode(array("message" => "Project does not exist."));
  }
?>