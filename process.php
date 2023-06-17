<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/includes/config.php';
    require_once __DIR__ . '/includes/functions.php';

    header('Content-Type: application/json');
    
    $url = isset($_POST['url']) ? $_POST['url'] : 'Invalid';

    //Identify if the link is shortened or not
    if (isShopeeShortenedLink($url) && $url != 'Invalid') {
        $url = URLDecode(getOriginalLink($url));
    } 

    $linkData = extractShopeeIds($url);
    $itemid = $linkData['itemid'];
    $shopid = $linkData['shopid'];

    if($itemid === '' && $shopid === ''){
        $response = array(
          'status' => 'error',
          'title' => 'Invalid link',
          'text' => 'The processing of the URL has been failed.',
          'debug' => array(
            'url' => $url,
            'itemid' => $itemid,
            'shopid' => $shopid
          )
        );
        
        echo json_encode($response);
        exit(0);
    }

     
    /*
    //Extract shop_id and item_id of the URL
    $regex = '/\.(\d+)\.(\d+)/';
    if (preg_match($regex, $url, $matches)) {
        $shopid = $matches[1]; 
        $itemid = $matches[2]; 
    } else {
        $response = array(
          'status' => 'error',
          'title' => 'Invalid link',
          'text' => 'The processing of the URL has been failed.'
        );
        
        echo json_encode($response);
        exit(0);
    }*/


    // Get Product Details
    function getProductDetails($itemid, $shopid){
        $url = 'https://shopee.ph/api/v4/item/get?itemid='.$itemid.'&shopid='.$shopid.'';
        $headers = array(
            'user-agent: '.SHOPEE_AGENT.''
        );
        return(make_get_request($url, $headers));
        
    }

    // Get Shop Details
    function getShopDetails($shopid){
        $url = 'https://corsproxy.io/?https://shopee.ph/api/v4/product/get_shop_info?shopid='.$shopid.'';
        $headers = array(
            'af-ac-enc-dat: '.SHOPEE_ENCRYPTION.'',
            'user-agent: '.SHOPEE_AGENT.''
        );
        
        return(make_get_request($url, $headers));
        
        //var_dump($response);
    }

    // Get Ratings
    function getRatings($itemid, $shopid){
        $url = 'https://corsproxy.io/?https://shopee.ph/api/v2/item/get_ratings?filter=0&flag=1&itemid='.$itemid.'&limit=10&offset=0&shopid='.$shopid.'&type=0';
        $headers = array(
            'af-ac-enc-dat: '.SHOPEE_ENCRYPTION.'',
            'user-agent: '.SHOPEE_AGENT.''
        );
        
        return(make_get_request($url, $headers));
        
        //var_dump($response);
    }

    function make_get_request($url, $headers) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    // Check seller in database
    function check_seller_db($id){
        // Connect to the database
        $pdo = db_connect();

        // Prepare the SQL statement
        $sql = "SELECT * FROM shopeeSeller WHERE shopid = ?";
        
        // Execute the query and retrieve a single row
        $row = db_query_one($pdo, $sql, [$id]);

        if($row) {
            return true;
        } else {
            return false;
        }

        $pdo = null;
    }

    // Adopt Seller
    function get_seller_db($id){
        // Connect to the database
        $pdo = db_connect();

        // Prepare the SQL statement
        $sql = "SELECT * FROM shopeeSeller WHERE shopid = ?";
        
        // Execute the query and retrieve a single row
        $row = db_query_one($pdo, $sql, [$id]);

        return $row['id'];

        $pdo = null;
    }


    // Save seller to database
    function save_seller_db($seller){
        // Get the id and json data
        $id = $seller['shopid']; 
        $userid = $seller['userid']; 
        $username = $seller['account']['username'];
        $data = json_encode($seller); 

        // Connect to the database
        $pdo = db_connect();

        // Insert the data into the table
        $table = 'shopeeSeller';
        $dataToInsert = array('shopid' => $id, 'userid' => $userid, 'username' => $username, 'data' => $data);
        $insertedRowId = db_insert($pdo, $table, $dataToInsert);

        $pdo = null;

        return $insertedRowId;
    }

    // Check product in database
    function check_product_db($id){
        // Connect to the database
        $pdo = db_connect();

        // Prepare the SQL statement
        $sql = "SELECT * FROM shopeeProduct WHERE id = ?";
        
        // Execute the query and retrieve a single row
        $row = db_query_one($pdo, $sql, [$id]);

        if($row) {
            return true;
        } else {
            return false;
        }

        $pdo = null;
    }

    // Save product to database
    function save_product_db($product){
        // Get the id and json data
        $id = $product['itemid']; 
        $shopid = $product['shopid']; 
        $name = $product['name'];
        $data = json_encode($product); 

        // Connect to the database
        $pdo = db_connect();

        // Insert the data into the table
        $table = 'shopeeProduct';
        $dataToInsert = array('itemid' => $id, 'shopid' => $shopid, 'name' => $name, 'data' => $data);
        $insertedRowId = db_insert($pdo, $table, $dataToInsert);

        $pdo = null;

        return $insertedRowId;
    }

    // Check ratings in database
    function check_ratings_db($id){
        // Connect to the database
        $pdo = db_connect();

        // Prepare the SQL statement
        $sql = "SELECT * FROM shopeeRatings WHERE id = ?";
        
        // Execute the query and retrieve a single row
        $row = db_query_one($pdo, $sql, [$id]);

        if($row) {
            return true;
        } else {
            return false;
        }

        $pdo = null;
    }

    // Save product to database
    function save_ratings_db($id, $ratings){
        // Get the id and json data
        $data = json_encode($ratings); 

        // Connect to the database
        $pdo = db_connect();

        // Insert the data into the table
        $table = 'shopeeRatings';
        $dataToInsert = array('itemid' => $id, 'data' => $data);
        $insertedRowId = db_insert($pdo, $table, $dataToInsert);

        $pdo = null;

        return $insertedRowId;
    }

    // Save review to database
    function save_review_db($productID, $sellerID, $ratingsID, $slug){
        // Connect to the database
        $pdo = db_connect();

        // Insert the data into the table
        $table = 'review';
        $dataToInsert = array('itemID' => $productID, 'slug' => $slug, 'url' => $_POST['url'],'sellerID' => $sellerID, 'ratingsID' => $ratingsID);
        $insertedRowId = db_insert($pdo, $table, $dataToInsert);

        $pdo = null;

        return $insertedRowId;
    }

    //Main Proces
    $productRaw = json_decode(getProductDetails($itemid, $shopid), true);
    $sellerRaw = json_decode(getShopDetails($shopid), true);
    $ratingsRaw = json_decode(getRatings($itemid, $shopid), true);
    
    
    // Checks if there are errors in fetching data
    if (isset($productRaw) && !empty($productRaw) && isset($sellerRaw) && !empty($sellerRaw) && isset($ratingsRaw) && !empty($ratingsRaw)) {
      // Proceed with your code
      $product = $productRaw['data'];
      $seller = $sellerRaw['data'];
      $ratings = $ratingsRaw['data'];

      // Check if product data already exist
      if(check_product_db($product['itemid']) && check_ratings_db($itemid)){
        // Product data is already saved.
        $response = array(
          'status' => 'warning',
          'title' => 'Processing complete',
          'text' => 'This product already exist in our system.',
          'slug' => 'https://djaveluna.online/shopee/'.slugify($product['name'])
        );
        
        echo json_encode($response);
        exit(0);
        //TODO: Check if there are some changes, then update.
      } else {
        // Product data doesn't exit yet. 

        // Check if shop already exist
        if(check_seller_db($product['shopid'])){
            // Shop already exist, adopt the shop details
            // TODO: Update shop details
            $sellerID = get_seller_db($product['shopid']);
        } else {
            // Shop didn't exist yet, create new
            $sellerID = save_seller_db($seller);
        }

        $itemID = save_product_db($product);
        $ratingsID = save_ratings_db($itemid, $ratings);
        save_review_db($itemID, $sellerID, $ratingsID, slugify($product['name']));

        $response = array(
          'status' => 'success',
          'title' => 'Processing complete',
          'text' => 'The processing of the URL has been completed successfully.',
          'slug' => slugify($product['name'])
        );
        
        echo json_encode($response);
        exit(0);
      }


    } else {
      // Handle the case where one or more of the data is null or 0
      echo 'Failed to perform action, kindly contact us.';
    }


} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Allow: POST');
    echo 'This endpoint only accepts POST requests.';
}

?>