<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
    
  include_once '../config/database.php';
  include_once '../objects/usuario.php';
    
  $database = new Database();
  $db = $database->getConnection();
    
  $usuario = new Usuario($db);
    
  $stmt = $usuario->read();
   $num = $stmt->rowCount();

  if($num>0){

    $usuario_arr=array();
    
    // fetch() is faster than fetchAll() ??
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      // extract row to make $row['whatever'] as $whatever
      extract($row);
      
      $usuario_item=array(
                "id_user" => $id_user,
                "display_name" => $display_name,
                "username" => $username,
                "pic_url" => $pic_url
      );
    
      array_push($usuario_arr, $usuario_item);
    }
    
    http_response_code(200);
    echo json_encode($usuario_arr);
    
  } else {
    http_response_code(404);
    echo json_encode(array("message" => "No users found."));
  }
?>
