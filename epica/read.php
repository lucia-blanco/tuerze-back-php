<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
    
  include_once '../config/database.php';
  include_once '../objects/epica.php';
    
  $database = new Database();
  $db = $database->getConnection();
    
  $epic = new Epica($db);
    
  $stmt = $epic->read();
  $num = $stmt->rowCount();

  if($num>0){
    $epic_arr=array();
    // fetch() is faster than fetchAll() ??
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      // extract row to make $row['whatever'] as $whatever
      extract($row);
      
      $epic_item=array(
                "id_epica" => $id_epica,
                "id_proyecto" => $id_proyecto,
                "name_epica" => $name_epica,
                "desc_epica" => $desc_epica,
                "status_epica" => $status_epica
      );
    
      array_push($epic_arr, $epic_item);
    }

    http_response_code(200);
    echo json_encode($epic_arr);
    
  } else {
    http_response_code(404);
    echo json_encode(array("message" => "No epics found."));
  }
?>
