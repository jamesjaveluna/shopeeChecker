<?php
ob_start();
$action = $_GET['op'];
include 'class/notification.php';
include 'class/user.php';
$crud = new Notification();

if($action == 'get_notifications'){
	$notification = $crud->get_user_notification();
	if($notification)
		echo $notification;
}

if($action == 'get_notifications_bell'){
	$notification = $crud->get_user_notification_bell();
	if($notification)
		echo $notification;
}

if($action == 'mark_read_all'){
	$notification = $crud->mark_notification_read();
	if($notification)
		echo $notification;
}

if($action == 'mark_toasted_all'){
	$notification = $crud->mark_notification_toasted();
	if($notification)
		echo $notification;
}

if($action == 'get_count'){
	$get_count = $crud->get_user_notification_count();
	if($get_count)
		echo $get_count;
}


?>