<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once '../config/database.php';
	include_once '../objects/historia.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$historia = new Historia($db);
	
	$data = json_decode(file_get_contents("php://input"));
	
	$historia->id_hist = $data->id_hist;

	$historia->id_epica = $data->id_epica;
	$historia->name_hist = $data->name_hist;
	$historia->desc_hist = $data->desc_hist;
	$historia->priority_hist = $data->priority_hist;
	$historia->status_hist = $data->status_hist;
	
	if($historia->update()){
	
		http_response_code(200);
		echo json_encode(array("message" => "Story was updated."));
	} else {
		http_response_code(503);
		echo json_encode(array("message" => "Unable to update story."));
	}
?>