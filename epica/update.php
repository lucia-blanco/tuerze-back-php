<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/database.php';
	include_once '../objects/epica.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$epic = new Epica($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$epic->id_epica = $data->id_epica;
	
	$epic->id_proyecto = $data->id_proyecto;
	$epic->name_epica = $data->name_epica;
	$epic->desc_epica = $data->desc_epica;
	$epic->status_epica = $data->status_epica;
	
	if($epic->update()){
		http_response_code(200);
		echo json_encode(array("message" => "Epic was updated."));
	} else {
		http_response_code(503);
		echo json_encode(array("message" => "Unable to update epic."));
	}
?>