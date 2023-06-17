<?php

/**
 * File Name: status.php
 *
 * Description: This file contains process of identifying the link sent by the user.
 *
 * Author: James Javeluna
 *
 * Version: 1.0
 *
 * Last Modified: March 19, 2023
 */

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '../../includes/config.php';
    require_once __DIR__ . '../../includes/utils/database_utils.php';

    $result_id = isset($_POST['id']) ? $_POST['id'] : 0;

    if($result_id > 0){
        $result_db = json_decode(get_shopee_result_db($result_id), true);
		
        $data['status'] = $result_db['status'];
        $data['date'] = '1678600314';
		$data = $result_db;


        $response = array(
			'type' => 'success',
			'message' => null,
			'data' => $data
        );

    } else {
        $response = array(
		    'type' => 'error',
		    'message' => 'ID is Invalid.'
		);
    }

} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Allow: POST');

    $response = array(
        'type' => 'error',
        'message' => 'This endpoint only accepts POST requests.'
	);
}

echo json_encode($response);


?>