<?php

/**
 * File Name: upload.php
 *
 * Description: This file contains process of identifying the link sent by the user.
 *
 * Author: James Javeluna
 *
 * Version: 1.0
 *
 * Last Modified: March 12, 2023
 */

header('Content-Type: application/json');

function create_result_json(){
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
	    'results' => ''
    );

    return json_encode($json);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '../../includes/config.php';
    require_once __DIR__ . '../../includes/utils/database_utils.php';
    require_once __DIR__ . '../../includes/utils/upload_utils.php';
    require_once __DIR__ . '../../includes/utils/global_utils.php';

    $url = isset($_POST['url']) ? $_POST['url'] : 'Invalid';

    // Identify if a valid URL
    if (filter_var($url, FILTER_VALIDATE_URL)) {
     
        // Identify Platform
        $platform = json_decode(identify_platform($url), true);

        // Shopee Platform
        if(strtolower($platform['platform']) === 'shopee'){

            // Identify if the shopee link is shortened or not.
            if (isShopeeShortenedLink($url) && $url != 'Invalid') {
                $url = URLDecode(getOriginalLink($url));
            } 

            $linkData = extractShopeeIds($url);
            $itemid = $linkData['itemid'];
            $shopid = $linkData['shopid'];

            $debug = array(
                'url' => $url,
                'itemid' => $itemid,
                'shopid' => $shopid
            );

            if($itemid === '' || $shopid === ''){
               $data = array(
                    'type' => 'error',
                    'message' => 'Invalid Shopee URL.',
                    'debug' => $debug
                ); 
            } else {
                // Shopee: Valid itemid and shopid
                $productDetails = json_decode(getShopeeProductDetails($itemid, $shopid), true)['data'];

                $name = $productDetails['name'];
                $slug = slugify($productDetails['name']);
                $json = create_result_json();

                // Identify if this product is already scanned
                if(checkShopeeResultExist($itemid, $shopid)){
                    //TODO: Get the ID
                    $productDetails = json_decode(getShopeeResultByShopeeData($itemid, $shopid), true);

                    $id = $productDetails['id'];
                    $name = $productDetails['name'];
                    $slug = $productDetails['slug'];
                    $link = SITE_URL.'/shopee/'.$slug;
                } else {
                    //TODO: Insert new row in table
                    $result_id = save_shopee_result_db(remove_url_params($url), $itemid, $shopid, $name, $slug, $json);
                    $link = SITE_URL.'/analyze/shopee/'.$slug.'-i.'.$result_id;
                }

                $country = array(
                    'name' => $platform['country'],
                    'code' => strtoupper($platform['country_code'])
                );

                $result = array(
                    'link' => $link,
                	'platform' => $platform['platform'],
                    'country' => $country
                );

                $data = array(
                    'type' => "success",
                    'message' => 'Valid Shopee URL',
                	'data' => $result
                );
            }
        }
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