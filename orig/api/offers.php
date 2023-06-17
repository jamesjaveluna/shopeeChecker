<?php

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
	ob_start();
	$action = $_GET['op'];
	include $_SERVER['DOCUMENT_ROOT'].'/api/class/offers.php';
	$crud = new Offers();
	
	if($action == 'get_user_offer'){
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