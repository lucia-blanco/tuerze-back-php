<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/database.php';
	include_once '../objects/proyecto.php';

	$database = new Database();
	$db = $database->getConnection();

	$proyecto = new Proyecto($db);

	$data = json_decode(file_get_contents("php://input"));

	$proyecto->id_proyecto = $data->id_proyecto;

	$proyecto->id_user = $data->id_user;
	$proyecto->name_proyecto = $data->name_proyecto;

	if($proyecto->update()){
	
		http_response_code(200);
		echo json_encode(array("message" => "Project was updated."));
	} else {
		http_response_code(503);
		echo json_encode(array("message" => "Unable to update project."));
	}
?>