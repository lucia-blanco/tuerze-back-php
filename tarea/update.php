<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once '../config/database.php';
	include_once '../objects/tarea.php';
	
	$database = new Database();
	$db = $database->getConnection();
	
	$tarea = new Tarea($db);
	
	$data = json_decode(file_get_contents("php://input"));

	$tarea->id_tarea = $data->id_tarea;
	
	$tarea->id_proyecto = $data->id_proyecto;
	$tarea->id_epica = $data->id_epica;
	$tarea->id_historia = $data->id_historia;
	$tarea->name_tarea = $data->name_tarea;
	$tarea->desc_tarea = $data->desc_tarea;
	$tarea->priority_tarea = $data->priority_tarea;
	$tarea->status_tarea = $data->status_tarea;
	
	if($tarea->update()){
		http_response_code(200);
		echo json_encode(array("message" => "Task was updated."));
	} else {
		http_response_code(503);
		echo json_encode(array("message" => "Unable to update task."));
	}
?>