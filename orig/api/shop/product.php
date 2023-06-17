<?php

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {
	ob_start();
	$action = $_GET['op'];
	include $_SERVER['DOCUMENT_ROOT'].'/api/class/shop.php';
	include $_SERVER['DOCUMENT_ROOT'].'/api/class/user.php';
	$crud = new Shop();
	
	if($action == 'search_product_v2'){
		header('Content-Type: application/json'); 
		$search = $crud->search_product_v2();
		if($search)
			echo $search;
	}
	
	if($action == 'get_products_v2'){
		header('Content-Type: application/json'); 
		$get = $crud->get_products_v2();
		if($get)
			echo $get;
	}
	
	
	if($action == 'buy'){
		//header('Content-Type: application/json'); 
		$buy = $crud->buy_item();
		if($buy)
			echo $buy;
	}

} else {
    http_response_code(404);
	include($_SERVER['DOCUMENT_ROOT'].'/page/not_found.php'); // provide your own HTML for the error page
	die();
}

?>