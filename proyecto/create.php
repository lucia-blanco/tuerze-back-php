<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Credentials: true");
  header("Access-Control-Allow-Methods: POST, GET, DELETE, PATCH, PUT, OPTIONS");
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, X-Auth-Token");
  
   
  include_once '../config/database.php';
  include_once '../objects/proyecto.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $proyecto = new Proyecto($db);

  $data = json_decode(file_get_contents("php://input"));

   
  if(!empty($data->id_user) &&
     !empty($data->name_proyecto)) {

      // $proyecto->id_proyecto = $data->id;
      $proyecto->id_user = $data->id_user;
      $proyecto->name_proyecto = $data->name_proyecto;
   
      if($proyecto->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Project was created."));
      } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create project."));
      }
  } else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create project. Data is incomplete."));
  }
?>