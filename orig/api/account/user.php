<?php
ob_start();
$action = $_GET['op'];
include '../class/user.php';
$crud = new User();

if($action == 'get_points'){
	//header('Content-Type: application/json'); 
	$get_points = $crud->get_user_points();
	if($get_points)
		echo $get_points;
}

if($action == 'get_details'){
	//header('Content-Type: application/json'); 
	$get_points = $crud->getUserDetails();
	if($get_points)
		echo $get_points;
}

if($action == 'update_user'){
	header('Content-Type: application/json'); 
	$user = $crud->updateSettings();
	if($user)
		echo $user;
}

?>