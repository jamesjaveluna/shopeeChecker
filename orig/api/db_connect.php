<?php 
include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';

$conn= new mysqli(
	$_config['db']['server'],
	$_config['db']['username'],
	$_config['db']['password'],
	$_config['db']['database']
)or die("Could not connect to mysql".mysqli_error($con));
