<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/database.php';
	include_once '../objects/epic.php';

	$database = new Database();
	$db = $database->getConnection();

	$epica = new Epica($db);

	$epica->id_epica = isset($_GET['id_epica']) ? $_GET['id_epica'] : die();
	
	if($epica->delete()) {
		http_response_code(200);
		echo json_encode(array("message" => "Epic was deleted."));
	} else {
		http_response_code(503);
		echo json_encode(array("message" => "Unable to delete epic."));
	}
?>