<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
    
  include_once '../config/database.php';
  include_once '../objects/tarea.php';
    
  $database = new Database();
  $db = $database->getConnection();
    
  $tarea = new Tarea($db);

  $tarea->id_historia = isset($_GET['id_historia']) ? $_GET['id_historia'] : die();
    
  $stmt = $tarea->read();
  $num = $stmt->rowCount();

  if($num>0){

    $tarea_arr=array();
    
    // fetch() is faster than fetchAll() ??
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      // extract row to make $row['whatever'] as $whatever
      extract($row);
      
      $tarea_item=array(
                "id_tarea" => $id_tarea,
                "id_proyecto" => $id_proyecto,
                "id_epica" => $id_epica,
                "id_historia" => $id_historia,
                "name_tarea" => $name_tarea,
                "desc_tarea" => $desc_tarea,
                "priority_tarea" => $priority_tarea,
                "status_tarea" => $status_tarea
      );
    
      array_push($tarea_arr, $tarea_item);
    }
    http_response_code(200);
    echo json_encode($tarea_arr);
  } else {
    http_response_code(404);
    echo json_encode(array("message" => "No tasks found."));
  }
?>
