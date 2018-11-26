<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
   
  include_once '../config/database.php';
  include_once '../objects/usuario.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $usuario = new Usuario($db);
   
  $usuario->id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die();
   
  $usuario->readOne();
   
  if($usuario->username!=null){

    $usuario_arr = array(
          "id_user" =>  $usuario->id_user,
          "display_name" => $usuario->display_name,
          "username" => $usuario->username,
          "pic_url" => $usuario->pic_url
    );
   
    http_response_code(200);
    echo json_encode($usuario_arr);
  } else {
    http_response_code(404);
    echo json_encode(array("message" => "User does not exist."));
  }
?>