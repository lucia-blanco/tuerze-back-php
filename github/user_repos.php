<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: POST, GET, DELETE, PATCH, PUT, OPTIONS");
	header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, X-Auth-Token");

	$user = ($_GET['user']);

	$ch = curl_init('https://api.github.com/users/'.$user.'/repos');

  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/vnd.github.v3+json',
			'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36'
  ]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

  $json = curl_exec($ch);
  curl_close($ch);

	echo $json; 

?>