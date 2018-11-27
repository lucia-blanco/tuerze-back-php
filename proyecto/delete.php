<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/database.php';
	include_once '../objects/proyecto.php';

	$database = new Database();
	$db = $database->getConnection();

	$proyecto = new Proyecto($db);

	$proyecto->id_proyecto = isset($_GET['id_proyecto']) ? $_GET['id_proyecto'] : die();
	
	if($proyecto->delete()) {
		http_response_code(200);
		echo json_encode(array("message" => "Project was deleted."));
	} else {
		http_response_code(503);
		echo json_encode(array("message" => "Unable to delete project."));
	}
?>