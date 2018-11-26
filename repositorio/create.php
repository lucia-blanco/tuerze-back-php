<?php
  header("Access-Control-Allow-Origin: http://localhost:4200");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Credentials: true");
  header("Access-Control-Allow-Methods: POST, GET, DELETE, PATCH, PUT, OPTIONS");
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, X-Auth-Token");
  
  include_once '../config/database.php';
  include_once '../objects/repositorio.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $repositorio = new Repositorio($db);

  $data = json_decode(file_get_contents("php://input"));

  if(!empty($data->id_proyecto) &&
     !empty($data->URL_repo)) {

    // $usuario->id_repo = $data->id_repo;
    $repositorio->id_proyecto = $data->id_proyecto;
    $repositorio->URL_repo = $data->URL_repo;
   
    if($repositorio->create()){
      http_response_code(201);
      echo json_encode(array("message" => "Repository was created."));
    } else {
      http_response_code(503);
      echo json_encode(array("message" => "Unable to create repository."));
    }
  } else {

    http_response_code(400);
    echo json_encode(array("message" => "Unable to create repository. Data is incomplete."));
  }
?>