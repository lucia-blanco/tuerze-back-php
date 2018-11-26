<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
   
  include_once '../config/database.php';
  include_once '../objects/repositorio.php';
   
  $database = new Database();
  $db = $database->getConnection();
   
  $repositorio = new Repositorio($db);

  $repositorio->id_repo = isset($_GET['id_repo']) ? $_GET['id_repo'] : die();
   
  $repositorio->readOne();
   
  if($repositorio->id_proyecto!=null){

    $repositorio_arr = array(
          "id_repo" =>  $repositorio->id_repo,
          "id_proyecto" => $repositorio->id_proyecto,
          "URL_repo" => $repositorio->URL_repo
    );
   
    http_response_code(200);
    echo json_encode($repositorio_arr);
  } else {
    http_response_code(404);
    echo json_encode(array("message" => "Repository does not exist."));
  }
?>