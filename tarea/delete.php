<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	include_once '../config/database.php';
	include_once '../objects/tarea.php';

	$database = new Database();
	$db = $database->getConnection();

	$tarea = new Tarea($db);

	$tarea->id_tarea = isset($_GET['id_tarea']) ? $_GET['id_tarea'] : die();
	
	if($tarea->delete()) {
		http_response_code(200);
		echo json_encode(array("message" => "Task was deleted."));
	} else {
		http_response_code(503);
		echo json_encode(array("message" => "Unable to delete task."));
	}
?>