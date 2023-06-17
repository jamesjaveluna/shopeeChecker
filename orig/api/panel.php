<?php

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
	ob_start();
	$action = $_GET['op'];
	include $_SERVER['DOCUMENT_ROOT'].'/api/class/panel.php';
	$crud = new Panel();
	
	if($action == 'get_user_transaction'){
		header('Content-Type: application/json'); 
		$offers = $crud->getUserTransaction();
		if($offers)
			echo $offers;
	}

	if($action == 'get_user_withdrawals'){
		header('Content-Type: application/json'); 
		$offers = $crud->getUserWithdrawals();
		if($offers)
			echo $offers;
	}

	if($action == 'get_user_offers'){
		header('Content-Type: application/json'); 
		$offers = $crud->getUserOffers();
		if($offers)
			echo $offers;
	}

} else {
    http_response_code(404);
	include($_SERVER['DOCUMENT_ROOT'].'/page/not_found.php'); // provide your own HTML for the error page
	die();
}

?>