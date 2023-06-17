<?php
ob_start();
$action = $_GET['op'];
include 'class/support.php';
include 'class/user.php';
$crud = new Support();

if($action == 'getChat'){
	header('Content-Type: application/json');
	$chat = $crud->getChat();
	if($chat)
		echo $chat;
}

if($action == 'sendChat'){
	header('Content-Type: application/json');
	$chat = $crud->sendChat();
	if($chat)
		echo $chat;
}

if($action == 'create_ticket'){
	header('Content-Type: application/json');
	$chat = $crud->createTicket();
	if($chat)
		echo $chat;
}


?>