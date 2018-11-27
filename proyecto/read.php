<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
    
  include_once '../config/database.php';
  include_once '../objects/proyecto.php';
    
  $database = new Database();
  $db = $database->getConnection();
    
  $proyecto = new Proyecto($db);

  $proyecto->id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die();
    
  $stmt = $proyecto->read();
   $num = $stmt->rowCount();

  if($num>0){

    $proyecto_arr=array();
    
    // fetch() is faster than fetchAll() ??
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      // extract row to make $row['whatever'] as $whatever
      extract($row);
      
      $proyecto_item=array(
                "id_proyecto" => $id_proyecto,
                "id_user" => $id_user,
                "name_proyecto" => $name_proyecto
      );
    
      array_push($proyecto_arr, $proyecto_item);
    }
    
    http_response_code(200);
    echo json_encode($proyecto_arr);
    
  } else {
    
    http_response_code(404);
    echo json_encode(array("message" => "No projects found."));
  }
?>
