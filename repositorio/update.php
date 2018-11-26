<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/database.php';
	include_once '../objects/repositorio.php';

	$database = new Database();
	$db = $database->getConnection();

	$repositorio = new Repositorio($db);

	$data = json_decode(file_get_contents("php://input"));

	$repositorio->id_epica = $data->id_epica;

	$repositorio->id_proyecto = $data->id_proyecto;
	$repositorio->name_epica = $data->name_epica;
	$repositorio->desc_epica = $data->desc_epica;

	if($repositorio->update()){
		http_response_code(200);
		echo json_encode(array("message" => "Repository was updated."));
	} else {
		http_response_code(503);
		echo json_encode(array("message" => "Unable to update repository."));
	}
?>