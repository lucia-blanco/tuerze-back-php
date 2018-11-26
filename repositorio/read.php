<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
    
  include_once '../config/database.php';
  include_once '../objects/repositorio.php';
    
  $database = new Database();
  $db = $database->getConnection();
    
  $repositorio = new Usuario($db);
    
  $stmt = $repositorio->read();
   $num = $stmt->rowCount();

  if($num>0){

    $repositorio_arr=array();
    
    // fetch() is faster than fetchAll() ??
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      // extract row to make $row['whatever'] as $whatever
      extract($row);
      
      $repositorio_item=array(
                "id_repo" => $id_repo,
                "id_proyecto" => $id_proyecto,
                "URL_repo" => $URL_repo
      );
    
      array_push($repositorio_arr, $repositorio_item);
    }
    
    http_response_code(200);
    echo json_encode($repositorio_arr);
    
  } else {
    
    http_response_code(404);
    echo json_encode(
      array("message" => "No repository found.")
    );
  }
?>
