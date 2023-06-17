<?php
ob_start();
$action = $_GET['op'];
include 'function.php';
$crud = new Action();

if($action == 'get_toast'){
	$notification = $crud->get_user_toast();
	if($notification)
		echo $notification;
}

?>