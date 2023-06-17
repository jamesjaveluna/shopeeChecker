<?php

/**
 * File Name: process.php
 *
 * Description: This file does the process like fetching data from shopee
 *
 * Author: James Javeluna
 *
 * Version: 1.0
 *
 * Last Modified: March 12, 2023
 */

header('Content-Type: application/json');
require_once __DIR__ . '../../includes/config.php';
$stats = array(
	'min' => 0,
	'max' => GEN_SCORE_MAX,
	'gap' => GEN_SCORE_MAX
);

$catStat = array(
	'summary' => false,
	'product_info' => false,
    'seller_info' => false,
    'price_discount' => false,
    'community' => false,
    'history' => false
);

$json = array(
    'status' => 'queueing',
    'category_status' => $catStat,
	'stats' => $stats,
	'results' => array()
);

function addScore($category, $name, $desc, $result, $type, $raw, &$json) {
    $scoreArray = array(
        'category' => $category,
        'name' => $name,
        'desc' => $desc,
        'result' => $result,
        'type' => $type,
        'raw' => $raw
    );
    
    $json['results'][] = $scoreArray;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '../../includes/config.php';
    require_once __DIR__ . '../../includes/utils/database_utils.php';
    require_once __DIR__ . '../../includes/utils/upload_utils.php';
    require_once __DIR__ . '../../includes/utils/global_utils.php';

    $resultID = isset($_POST['id']) ? $_POST['id'] : 'Invalid';
    $shopeeResultData = getShopeeResultByID($resultID);
    $retry_count = 0;
    $max_retry_count = 3;
    $retry_delay = 5; // in seconds

    // Check if data is valid.
    if($resultID != 'Invalid' && $shopeeResultData != false){
        // Assuming that the Shopee Result is valid, then let's decode it.
        $shopeeResultData = json_decode($shopeeResultData, true);
        
        // Stage 1 - Getting all data from Shopee
        $json['status'] = 'processing'; 
        $stage_1 = update_shopee_result_json($json, $resultID);

        $item_id = $shopeeResultData['product_id'];
        $shop_id = $shopeeResultData['seller_id'];
        
        $max_retry_count = 5; // Maximum number of retries
        $retry_delay = 5; // Delay in seconds between retries
        

        for ($retry_count = 0; $retry_count < $max_retry_count; $retry_count++) {
            $product_details = json_decode(getShopeeProductDetails($item_id, $shop_id), true);
            if ($product_details['error'] != null) {
                save_error_log('process.php', $resultID, 'getShopeeProductDetails', json_encode($product_details), $item_id, $shop_id);
                sleep($retry_delay);
                continue; // Retry the function
            }

            // Save product details to database
            save_product_db($product_details['data']);

            addScore('summary', 'Shopee Score', 'Rates from Shopee Users.', 'Average', 3, '3/5', $json);
            addScore('summary', 'Community Score', 'Rates from Lazada Users.', 'Good', 0, '4/5', $json);
            addScore('summary', 'Shopee Verified', '', 'No', 1, false, $json);
            addScore('summary', 'Shopee Mall', '', 'No', 1, false, $json);
            addScore('summary', 'Business Permit', '', 'No', 1, false, $json);
            addScore('summary', 'BIR Form 2303', '', 'No', 1, false, $json);
            addScore('summary', 'Brand Certification', '', 'No', 1, false, $json);
            addScore('summary', 'Lower Price Guarantee', '', 'No', 1, false, $json);
            $stage_1_1 = update_shopee_result_json($json, $resultID);
            sleep(1);
            addScore('summary', 'Sold', '', 'No', 1, false, $json);
            //addScore('summary', 'Community Score', 'Rates from here.', 'Not Scored', 0, '0/5', $scoreArray);
            $catStat['summary'] = true; 
            $stage_1_1 = update_shopee_result_json($json, $resultID);

            $shop_details = json_decode(getShopeeShopDetails($shop_id), true);
            if ($shop_details['error'] != null) {
                save_error_log('process.php', $resultID, 'getShopeeShopDetails', json_encode($shop_details), $item_id, $shop_id);
                sleep($retry_delay);
                continue; // Retry the function
            }
        
            $product_rating = json_decode(getShopeProductRating($item_id, $shop_id), true);
            if ($product_rating['error'] != null) {
                save_error_log('process.php', $resultID, 'getShopeProductRating', json_encode($product_rating), $item_id, $shop_id);
                sleep($retry_delay);
                continue; // Retry the function
            }
        
            // If all three functions succeeded, update the Shopee result JSON with the "done" status
            $json['status'] = 'done'; 
            $stage_2 = update_shopee_result_json($json, $resultID);
        
            break; // Exit the while loop
        }



        // Stage 2 - Computation of Scores
        //$json = create_result_json('done');
        //$stage_2 = update_shopee_result_json($json, $resultID);
        //sleep(10);

        // Stage 3 - Fetching Similar Products
        //$json = create_result_json('completing');
        //$stage_3 = update_shopee_result_json($json, $resultID);
        //sleep(10);

        // Stage 3 - All things are complete
        //$json = create_result_json('complete');
        //$stage_3 = update_shopee_result_json($json, $resultID);


        $data = array(
            'type' => "success",
            'message' => 'Process is now queued.'
        );
    } else {
        $data = array(
            'type' => 'error',
            'message' => 'Kindly enter a valid URL.'
         ); 
    }
    
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Allow: POST');

    $data = array(
        'type' => 'error',
        'message' => 'This endpoint only accepts POST requests.'
    );
}

echo json_encode($data);


?>