<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/database.php';
	include_once '../objects/repositorio.php';

	$database = new Database();
	$db = $database->getConnection();

	$repositorio = new Repositorio($db);

	$repositorio->id_repo = isset($_GET['id_repo']) ? $_GET['id_repo'] : die();
	
	if($repositorio->delete()) {
		http_response_code(200);
		echo json_encode(array("message" => "Repository was deleted."));
	} else {
		http_response_code(503);
		echo json_encode(array("message" => "Unable to delete repository."));
	}
?>