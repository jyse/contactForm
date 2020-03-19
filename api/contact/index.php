<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	echo 'Hello World';
	exit(0);
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
	header("Access-Control-Allow-Headers: Authorization, Content-Type,Accept, Origin");
	header("Access-Control-Allow-Origin: http://localhost:3000");
	header("Content-Type: application/json");
	exit(0);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
	// header("Access-Control-Allow-Headers: Authorization, Content-Type,Accept, Origin");
	header("Content-Type: application/json");

	// parse payload
	$rest_json = file_get_contents("php://input");
	$payload = json_decode($rest_json, true);

	// build email
	$subject = $payload['fname'];
	$to = "jessythe@gmail.com";
	$from = $payload['email'];
	$msg =  $payload['message'];
	$headers = "MIME-Version: 1.0\r\n";
	$headers.= "Content-type: text/html; charset=UTF-8\r\n";
	$headers.= "From: <" . $from . ">";

	// if you don't have a local email server running, then the following line will not work:
	// mail($to, $subject, $msg, $headers);

	// log to debug console
	error_log("");
	error_log("--------------------------------------------");
	error_log("headers: ");
	error_log($headers);
	error_log("subject: " . $subject);
	error_log("to: " . $to);
	error_log("from: " . $from);
	error_log("msg: " . $msg);
	error_log("--------------------------------------------");

	// write response
	http_response_code(200);
	echo json_encode(array(
		"sent" => true
	));

	exit(0);
}

?>