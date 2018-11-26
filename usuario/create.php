<?php
  header("Access-Control-Allow-Origin: http://localhost:4200");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Credentials: true");
  header("Access-Control-Allow-Methods: POST, GET, DELETE, PATCH, PUT, OPTIONS");
  header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, X-Auth-Token");
  
   
  include_once '../config/database.php';
  include_once '../objects/usuario.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $usuario = new Usuario($db);

  $data = json_decode(file_get_contents("php://input"));

  if(!empty($data->id_user) &&
     !empty($data->display_name) &&
     !empty($data->username) &&
     !empty($data->pic_url)) {

      $usuario->id_user = $data->id_user;
      $usuario->display_name = $data->display_name;
      $usuario->username = $data->username;
      $usuario->pic_url = $data->pic_url;
   
      if($usuario->create()){
        http_response_code(201);
        echo json_encode(array("message" => "User was created."));
      } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create user."));
      }
  } else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
  }
?>