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

	$historia->id_hist = isset($_GET['id_hist']) ? $_GET['id_hist'] : die();
	
	if($historia->delete()) {
			http_response_code(200);
			echo json_encode(array("message" => "Story was deleted."));
	} else {
			http_response_code(503);
			echo json_encode(array("message" => "Unable to delete story."));
	}
?>