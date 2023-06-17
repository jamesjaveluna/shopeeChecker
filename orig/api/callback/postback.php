<?php
ob_start();
$action = $_GET['ptr'];
include 'function.php';
$crud = new Action();

if($action == 'kiwiwall'){
	$partner = $crud->kiwiwall();
	if($partner)
		echo $partner;
}

?>