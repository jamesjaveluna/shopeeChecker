<?php
ob_start();
$action = $_GET['op'];
include '../class/user.php';
$crud = new User();

if($action == 'process'){
	//header('Content-Type: application/json'); 
	$login = $crud->login();
	if($login)
		echo $login;
}

if($action == 'logout'){
	header('Content-Type: application/json'); 
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}


?>