<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
    
  include_once '../config/database.php';
  include_once '../objects/historia.php';
    
  $database = new Database();
  $db = $database->getConnection();
    
  $historia = new Historia($db);

  $historia->id_epica = isset($_GET['id_epica']) ? $_GET['id_epica'] : die();
    
  $stmt = $historia->read();
   $num = $stmt->rowCount();

  if($num>0){

    $historia_arr=array();
    
    // fetch() is faster than fetchAll() ??
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      // extract row to make $row['whatever'] as $whatever
      extract($row);
      
      $historia_item=array(
                "id_hist" => $id_hist,
                "id_epica" => $id_epica,
                "name_hist" => $name_hist,
                "desc_hist" => $desc_hist,
                "priority_hist" => $priority_hist,
                "status_hist" => $status_hist
      );
    
      array_push($historia_arr, $historia_item);
    }
    
    http_response_code(200);
    echo json_encode($historia_arr);
    
  } else {
    http_response_code(404);
    echo json_encode(
      array("message" => "No history found.")
    );
  }
?>
