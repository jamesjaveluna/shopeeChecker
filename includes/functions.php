<?php

require_once __DIR__ . '/../app-assets/vendors/autoload.php'; // include the slugify library

use Cocur\Slugify\Slugify;

// Returns the current page URL
function current_url()
{
  $url = 'http';
  if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $url .= "s";
  }
  $url .= "://";
  if ($_SERVER['SERVER_PORT'] != "80") {
    $url .= $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
  } else {
    $url .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }
  return $url;
}

// Redirects the user to another page
function redirect($url)
{
  header("Location: $url");
  exit();
}

// Escapes HTML characters and special characters in a string
function escape($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Connects to the database and returns a PDO object
function db_connect()
{
  $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ];
  $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
  return $pdo;
}

// Retrieves a single row from the database using a prepared statement
function db_query_one($pdo, $sql, $params = [])
{
  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  return $stmt->fetch();
}

// Retrieves multiple rows from the database using a prepared statement
function db_query_all($pdo, $sql, $params = [])
{
  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  return $stmt->fetchAll();
}

// Inserts a new row into the database using a prepared statement
function db_insert($pdo, $table, $data)
{
  $keys = array_keys($data);
  $values = array_values($data);
  $sql = "INSERT INTO $table (" . implode(',', $keys) . ") VALUES (" . str_repeat('?,', count($values) - 1) . "?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($values);
  return $pdo->lastInsertId();
}

// Updates an existing row in the database using a prepared statement
function db_update($pdo, $table, $id, $data)
{
  $pairs = [];
  foreach ($data as $key => $value) {
    $pairs[] = "$key = ?";
  }
  $values = array_values($data);
  $values[] = $id;
  $sql = "UPDATE $table SET " . implode(',', $pairs) . " WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($values);
  return $stmt->rowCount();
}

// Deletes a row from the database using a prepared statement
function db_delete($pdo, $table, $id)
{
  $sql = "DELETE FROM $table WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  return $stmt->rowCount();
}

// Retrieves the current user ID from the session, or returns null if not logged in
function current_user_id()
{
  if (isset($_SESSION['user_id'])) {
    return $_SESSION['user_id'];
  } else {
    return null;
  }
}

function slugify($text) {
  $slugify = new Slugify(['lowercase' => false]);
  $slug = $slugify->slugify($text);
    
  return $slug;
}

// The other products owned by the user.
function getSiblingProducts($shopID, $itemID){
    // Connect to the database
    $pdo = db_connect();

    // Prepare the SQL statement
    $sql = "SELECT rev.slug, prod.name, prod.data FROM shopeeProduct prod LEFT JOIN review rev ON rev.itemID = prod.id WHERE prod.shopid = ? AND prod.itemid != ?";
    
    // Execute the query and retrieve a single row
    $rows = json_encode(db_query_all($pdo, $sql, [$shopID, $itemID]));

    if($rows) {
        // Create an array containing the data
        $data = array(
            'items' => json_decode($rows),
            'status' => true
        );

        return json_encode($data);
    } else {
        // Create an array containing the data
        $data = array(
            'status' => false
        );

        return json_encode($data);
    }

    $pdo = null;
}

function getOtherProducts($shopID, $itemID){
$other_products = json_decode(getSiblingProducts($shopID, $itemID))->items;

    if(empty($other_products)){
        echo 'No records to display.';
    } else {
        foreach ($other_products as $row) {
        echo '<div onclick="window.open(\'./'.$row->slug.'\', \'_self\');"  class="transaction-item">
                    <div class="d-flex">
                        <div class="avatar bg-light-primary rounded float-start">
                            <div class="avatar-content">
                                <img class="img-fluid rounded" src="https://cf.shopee.ph/file/'.json_decode($row->data)->image.'" height="40" width="40" alt="User avatar">
                            </div>
                        </div>
                        <div class="transaction-percentage">
                            <h6 class="transaction-title">'.$row->name.'</h6>
                            <small>Starbucks</small>
                        </div>
                    </div>
                    <div class="fw-bolder">
                         <button type="button" onclick="window.open(\'./'.$row->slug.'\', \'_self\');"  class="btn btn-icon btn-flat-primary">
                                <i data-feather="eye"></i>
                          </button>
                    </div>
              </div>';
        }
    }
}


// IMPLEMENTATION OF HISTORY : START

// Check if there are revisions.
function checkRevision($slug){
    // Connect to the database
    $pdo = db_connect();
    
    // Prepare the SQL statement
    $sql = "SELECT id, type, review_ID FROM shopeeVersions WHERE slug = ?";
    
    // Sanitize slug
    $slug_sanitized = filter_var($slug, FILTER_SANITIZE_STRING);
    
    // Execute the query and retrieve all rows that match the slug value
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$slug_sanitized]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if($rows) {
        // Create an array containing the data
        $data = array(
            'items' => $rows,
            'status' => true
        );
    
        return json_encode($data);
    } else {
        // Create an array containing the data
        $data = array(
            'status' => false
        );
    
        return json_encode($data);
    }
}


// Get the Data
function getHistory($slug){
    // Connect to the database
    $pdo = db_connect();

    // Prepare the SQL statement
    $sql = "SELECT * FROM shopeeVersions WHERE slug = ? ORDER BY date DESC LIMIT 1";

    // Sanitize slug
    $slug_sanitized = filter_var($slug, FILTER_SANITIZE_STRING);

    // Execute the query and retrieve a single row
    $row = db_query_one($pdo, $sql, [$slug_sanitized]);

    if($row) {
        // Create an array containing the data
        $data = array(
            'id' => $row['id'],
            'itemID' => $row['itemID'],
            'shopID' => $row['sellerID'],
            'shopee_link' => $row['url'],
            'shopee_refer' => $row['affiliate'],
            'ratingsID' => $row['ratingsID'],
            'result' => $row['result'],
            'info' => $row['info'],
            'image' => $row['image'],
            'status' => true,
            'createdDate' => $row['created_date']
        );

        return json_encode($data);
    } else {
        // Create an array containing the data
        $data = array(
            'status' => false
        );

        return json_encode($data);
    }

}


// IMPLEMENTATION OF HISTORY : END


// Get itemID and shopID and ratingsID
function getData($slug){
    // Connect to the database
    $pdo = db_connect();

    // Prepare the SQL statement
    $sql = "SELECT * FROM review WHERE slug = ?";

    // Sanitize slug
    $slug_sanitized = filter_var($slug, FILTER_SANITIZE_STRING);

    // Execute the query and retrieve a single row
    $row = db_query_one($pdo, $sql, [$slug_sanitized]);

    if($row) {
        // Create an array containing the data
        $data = array(
            'id' => $row['id'],
            'itemID' => $row['itemID'],
            'shopID' => $row['sellerID'],
            'shopee_link' => $row['url'],
            'shopee_refer' => $row['affiliate'],
            'ratingsID' => $row['ratingsID'],
            'result' => $row['result'],
            'info' => $row['info'],
            'image' => $row['image'],
            'status' => true,
            'createdDate' => $row['created_date']
        );

        return json_encode($data);
    } else {
        // Create an array containing the data
        $data = array(
            'status' => false
        );

        return json_encode($data);
    }

}

// Get product data
function getProductData($id){
    // Connect to the database
    $pdo = db_connect();

    // Prepare the SQL statement
    $sql = "SELECT * FROM shopeeProduct WHERE id = ?";
    
    // Execute the query and retrieve a single row
    $row = db_query_one($pdo, $sql, [$id]);

    if($row) {
        // Create an array containing the data
        $data = array(
            'shopID' => $row['shopid'],
            'name' => $row['name'],
            'data' => json_decode($row['data']),
            'added_date' => $row['added_date'],
            'status' => true
        );

        return json_encode($data);
    } else {
        // Create an array containing the data
        $data = array(
            'status' => false
        );

        return json_encode($data);
    }

    $pdo = null;
}

// Get seller data
function getSellerData($id){
    // Connect to the database
    $pdo = db_connect();

    // Prepare the SQL statement
    $sql = "SELECT * FROM shopeeSeller WHERE id = ?";
    
    // Execute the query and retrieve a single row
    $row = db_query_one($pdo, $sql, [$id]);

    if($row) {
        // Create an array containing the data
        $data = array(
            'shopID' => $row['shopid'],
            'username' => $row['username'],
            'data' => json_decode($row['data']),
            'added_date' => $row['added_date'],
            'status' => true
        );

        return json_encode($data);
    } else {
        // Create an array containing the data
        $data = array(
            'status' => false
        );

        return json_encode($data);
    }

    $pdo = null;
}

// Get ratings data
function getRatingsData($id){
    // Connect to the database
    $pdo = db_connect();

    // Prepare the SQL statement
    $sql = "SELECT * FROM shopeeRatings WHERE id = ?";
    
    // Execute the query and retrieve a single row
    $row = db_query_one($pdo, $sql, [$id]);

    if($row) {
        // Create an array containing the data
        $data = array(
            'data' => json_decode($row['data']),
            'added_date' => $row['created_date'],
            'status' => true
        );

        return json_encode($data);
    } else {
        // Create an array containing the data
        $data = array(
            'status' => false
        );

        return json_encode($data);
    }

    $pdo = null;
}

// Assigns check or wrong
function display_data_check($param) {
    if($param){
        echo '<div class="avatar bg-light-success round float-start">
                  <div class="avatar-content">
                       <i data-feather="check" class="avatar-icon font-medium-3"></i>
                  </div>
              </div>';
    } else {
        echo '<div class="avatar bg-light-danger round float-start">
                  <div class="avatar-content">
                       <i data-feather="x" class="avatar-icon font-medium-3"></i>
                  </div>
              </div>';
    }
}

// Assigns check or wrong
function display_data_yes_or_no($param) {
    if($param){
        echo '<span class="text-success"><i data-feather=\'check-circle\' class="me-50"></i><span>Yes</span></span>';
    } else {
        echo '<span class="text-danger"><i data-feather=\'alert-circle\' class="me-50"></i><span>No</span></span>';
    }
}


function getSellerRate($good, $bad, $normal){
    $rating_bad = $bad;
    $rating_good = $good;
    $rating_normal = $normal;
    
    $max_rating = $rating_bad + $rating_good + $rating_normal;
    
    $percent_bad = ($rating_bad / $max_rating) * 100;
    $percent_good = ($rating_good / $max_rating) * 100;
    $percent_normal = ($rating_normal / $max_rating) * 100;

    $data = array(
            'bad' => round($percent_bad, 0),
            'good' => round($percent_good, 0),
            'normal' => round($percent_normal, 0)
    );
    
    return json_encode($data);
}

function getResult($result){
    switch($result){
        case 0:
            $data = array(
                'color' => 'success',
                'text' => 'Potentially Legit',
                'icon' => 'check-circle',
                'desc' => 'We found nothing wrong with this product',
                'icon' => 'thumbs-up',
                'update' => '7d ago'
            );
        break;

        case 1:
        break;

        case 2:
        break;
    }

    return json_encode($data);
}

function getColor($value){
    if ($value < 50) {
      $color = 'danger';
    } else if ($value >= 50 && $value < 75) {
      $color = 'warning';
    } else {
      $color = 'success';
    }

    return $color;
}

function getRationale($ids) {
    // Define an array of items
    $items = array(
        array(
            "id" => 1,
            "title" => "Seller has high rating",
            "description" => "A high rating can indicate that the seller is trustworthy and has a good track record of delivering quality products and providing good customer service."
        ),
        array(
            "id" => 2,
            "title" => "Accurate to details",
            "description" => "The information provided is accurate and matches the actual product being sold."
        ),
        array(
            "id" => 3,
            "title" => "Reasonable Price",
            "description" => "The price of the product is reasonable and competitive. No indication of counterfeit or fake products."
        ),
        array(
            "id" => 4,
            "title" => "Seller is Verified",
            "description" => "The importance of a verified seller is that it gives buyers assurance that the seller is legitimate and trustworthy, reducing the risk of fraud or scams."
        ),
        array(
            "id" => 5,
            "title" => "Reasonable Price",
            "description" => "The price of the product is reasonable and competitive. No indication of counterfeit or fake products."
        )
    );

    $result = array();
    foreach ($items as $item) {
        if (in_array($item["id"], $ids)) {
            $result[] = $item;
        }
    }

    return json_encode($result);
}

function format_time_ago($timestamp) {
    date_default_timezone_set('Asia/Manila');
    //echo date_default_timezone_get();
    $diff = time() - $timestamp - 28800; //get the difference between current time and given timestamp

    if ($diff < 60) { //less than a minute
        return "just now";
    } elseif ($diff < 3600) { //less than an hour
        return floor($diff / 60) . " minutes ago";
    } elseif ($diff < 86400) { //less than a day
        return floor($diff / 3600) . " hours ago";
    } elseif ($diff < 604800) { //less than a week
        return floor($diff / 86400) . " days ago";
    } elseif ($diff < 2592000) { //less than a month
        return floor($diff / 604800) . " weeks ago";
    } elseif ($diff < 31536000) { //less than a year
        return floor($diff / 2592000) . " months ago";
    } else { //more than a year
        return floor($diff / 31536000) . " years ago"; 
    }
}


function get_response_time($timestamp) {
    $now = time();
    $diff = $now - $timestamp;
    $seconds_per_minute = 60;
    $seconds_per_hour = $seconds_per_minute * 60;
    $seconds_per_day = $seconds_per_hour * 24;

    if ($diff < $seconds_per_minute) {
        $response_time = '<span class="text-success"><i data-feather=\'alert-triangle\' class="me-50"></i><span> '.round($diff / $seconds_per_minute) . ' minutes ago</span></span>';
    } elseif ($diff < $seconds_per_hour) {
        $response_time = '<span class="';
        if ($diff < $seconds_per_hour / 2) {
            $response_time .= 'text-success';
        } else {
            $response_time .= 'text-warning';
        }
        $response_time .= '"><i data-feather=\'alert-triangle\' class="me-50"></i><span> '.round($diff / $seconds_per_hour) . ' hours ago</span></span>';
    } elseif ($diff < $seconds_per_day) {
        $response_time = '<span class="';
        if ($diff < $seconds_per_day / 2) {
            $response_time .= 'text-warning';
        } else {
            $response_time .= 'text-danger';
        }
        $response_time .= '"><i data-feather=\'alert-triangle\' class="me-50"></i><span> '.round($diff / $seconds_per_day) . ' days ago</span></span>';
    } else {
        $response_time = date('M d, Y', $timestamp);
    }

    return $response_time;
}


function getResponseTime($response_time) {
    $hours = $response_time / 3600;
    if ($hours < 24) {
        //return round($hours) . " hours";
        return '<span class="text-success"><i data-feather=\'check-circle\' class="me-50"></i><span>Within hours</span></span> ';
    } elseif ($hours < 168) {
        $days = $hours / 24;
        //return round($days) . " days";
        return '<span class="text-warning"><i data-feather=\'alert-triangle\' class="me-50"></i><span>Within days</span></span> ';
    } else {
        $weeks = $hours / 168;
        //return round($weeks) . " weeks";
        return '<span class="text-danger"><i data-feather=\'alert-circle\' class="me-50"></i><span>Within wek</span></span> ';
    }
}


function identify_ratings($good, $normal, $bad) {
    $total_ratings = $good + $normal + $bad;
    $good_percentage = ($good / $total_ratings) * 100;

    if ($good_percentage >= 60) {
        //return '<span class="badge badge-light-success">Mostly Good</span>';
        return '<span class="text-success"><i data-feather=\'check-circle\' class="me-50"></i><span>Mostly Good</span></span> ';
    } elseif ($good_percentage >= 40) {
        //return '<span class="badge badge-light-warning">Mostly Normal</span>';
        return '<span class="text-primary"><i data-feather=\'check-circle\' class="me-50"></i><span>Mostly Normal</span></span> ';
    } else {
        //return '<span class="badge badge-light-danger">Mostly Bad</span>';
        return '<span class="text-danger"><i data-feather=\'alert-circle\' class="me-50"></i><span>Mostly Bad</span></span> ';
    }
}

function identify_passing_status($score) {
    $required_percent = 70;

    if ($score >= $required_percent) {
        //return '<span class="badge badge-light-success">Passed</span>';
        return '<span class="text-success"><i data-feather=\'check-circle\' class="me-50"></i><span>Passed</span></span>';
    } elseif ($score >= ($required_percent * 0.6)) {
       // return '<span class="badge badge-light-warning">Not enough</span>';
       return '<span class="text-warning"><i data-feather=\'alert-triangle\' class="me-50"></i><span>Not enough</span></span>';
    } else {
        //return '<span class="badge badge-light-danger">Failed</span>';
        return '<span class="text-danger"><i data-feather=\'alert-circle\' class="me-50"></i><span>Failed</span></span>';
    }
}

function identify_score($score) {
    if ($score == '') {
        return '<span class="text-secondary">Not Scored</span>';
    } elseif ($score < 2) {
        return '<span class="text-danger"><i data-feather=\'alert-circle\' class="me-50"></i><span>Low</span></span>';
    } elseif ($score < 4) {
        return '<span class="text-primary"><i data-feather=\'check-circle\' class="me-50"></i><span>Average</span></span>';
    } else {
        return '<span class="text-success"><i data-feather=\'check-circle\' class="me-50"></i><span>High</span></span>';
    }
}

function makeResult($result){
    switch($result){
        case 0:
            $data = array(
                'color' => 'success',
                'text' => 'Potentially Legit',
                'desc' => 'We found nothing wrong with this product',
                'icon' => 'thumbs-up',
                'update' => '7d ago'
            );
        break;

        case 1:
        break;

        case 2:
        break;
    }

    return json_encode($data);
}

function checkAvatar($profile){
    if(empty($profile)){
        return '../app-assets/images/profile/avatar.png';
    } else {
        return 'https://cf.shopee.ph/file/'.$profile;
    }
}

function getSellerBadge($is_official_shop, $is_preferred_plus_seller) {
    $badges = '';

    if($is_official_shop == true){
        $badges .= '<span class="badge bg-light-danger">Shopee Mall</span>';
    }

    if($is_preferred_plus_seller == true){
        $badges .= '<span class="badge bg-light-danger">Preferred Seller</span>';
    }

    return $badges;
    
    
}

function getResponseTimeScore($response_time) {
    $hours = $response_time / 3600;
    if ($hours < 24) {
        return 3;
    } elseif ($hours < 168) {
        $days = $hours / 24;
        return 2;
    } else {
        $weeks = $hours / 168;
        return 1;
    }
}

function getBooleanScore($data){
    if($data == true){
        return 1;
    } else {
        return 0;
    }
}

function getRatingsScore($good, $normal, $bad) {
  // Calculate the total number of feedbacks
  $total = $good + $normal + $bad;

  // Check if the total is zero to avoid division by zero error
  if ($total == 0) {
    return 0;
  }

  // Calculate the percentage of good feedbacks
  $good_percent = ($good / $total) * 100;
  // Calculate the percentage of normal feedbacks
  $normal_percent = ($normal / $total) * 100;
  // Calculate the percentage of bad feedbacks
  $bad_percent = ($bad / $total) * 100;
  
  // Assign a score based on the percentages
  if ($good_percent >= 50) {
    // If good feedbacks are more than or equal to half of the total, assign a score of 3
    return 3;
    
  } elseif ($normal_percent >=50) {
    // If normal feedbacks are more than or equal to half of the total, assign a score of 2
    return 2;
    
  } else {
    // Otherwise, assign a score of 1
    return 1;
  }
}

function getSoldScore($sold) {
  if ($sold >= 1000) {
    return 3;
  } elseif ($sold >= 500) {
    return 2;
  } elseif ($sold == 0) {
    return 0;
  } else {
    return 1;
  }
}

function getFollowerScore($followers) {
  if ($followers >= 1000) {
    return 3;
  } elseif ($followers >= 500) {
    return 2;
  } elseif ($followers == 0) {
    return 0;
  } else {
    return 1;
  }
}

function getFavoriteScore($favorite) {
  if ($favorite >= 1000) {
    return 3;
  } elseif ($favorite >= 500) {
    return 2;
  } elseif ($favorite == 0) {
    return 0;
  } else {
    return 1;
  }
}

function getGoodScore($param) {
  if ($param >= 1000) {
    return 3;
  } elseif ($param >= 500) {
    return 2;
  } elseif ($param == 0) {
    return 0;
  } else {
    return 1;
  }
}

function getNormalScore($param) {
  if ($param >= 1000) {
    return 3;
  } elseif ($param >= 500) {
    return 2;
  } elseif ($param == 0) {
    return 0;
  } else {
    return 1;
  }
}

function getBadScore($param) {
  if ($param >= 50000) {
    return 1;
  } elseif ($param >= 25000) {
    return 2;
  } else {
    return 3;
  }
}

function getJoinedScore($created_date) {
  // Get the current timestamp
  $now = time();
  // Calculate the difference in seconds
  $diff = $now - $created_date;
  // Convert the difference to years
  $years = floor($diff / (365*24*60*60));
  // Convert the difference to months
  $months = floor(($diff - $years * 365*24*60*60) / (30*24*60*60));
  // Convert the difference to days
  $days = floor(($diff - $years * 365*24*60*60 - $months * 30*24*60*60) / (24*60*60));
  
  if ($years > 0) {
    return 3;
  } elseif ($months > 0) {
    return 2;
  } elseif ($days > 0) {
    return 1;
  } else {
    return 0;
  }
}


function computeResult($seller, $product, $ratings, $review){

    // Points
    $shopee_score = round($product->data->item_rating->rating_star, 1); // 5 Points
    $shopee_seller_score = round($seller->data->rating_star, 1); // 5 Points
    $shopee_verified = getBooleanScore($product->data->shopee_verified); // 1 Point
    $shopee_mall = getBooleanScore($product->data->is_official_shop); // 1 Point
    $shopee_price_guarantee = getBooleanScore($product->data->has_lowest_price_guarantee); // 1 Point
    $shopee_preferred = getBooleanScore($seller->data->is_preferred_plus_seller); // 1 Point
    $shopee_response_rate = ceil($seller->data->response_rate/10); // 10 Points
    $shopee_response_time = getResponseTimeScore($seller->data->response_time); // 3 Points
    $shopee_ratings_summary = getRatingsScore($seller->data->rating_good, $seller->data->rating_normal, $seller->data->rating_bad); // 3 Points
    $shopee_ratings_good = getGoodScore($seller->data->rating_good); // 3 Points
    $shopee_ratings_normal = getNormalScore($seller->data->rating_normal); // 3 Points
    $shopee_ratings_bad = getBadScore($seller->data->rating_bad); // 3 Points
    $shopee_sold = getSoldScore($product->data->sold + $product->data->historical_sold); //3 Points
    $shopee_followers = getFollowerScore($seller->data->follower_count); //3 Points
    $shopee_favorites = getFavoriteScore($product->data->liked_count); // 3 Points
    $shopee_joined = getJoinedScore($seller->data->ctime); // 3 Points

    $total = $shopee_score + 
             $shopee_seller_score +
             $shopee_verified + 
             $shopee_mall + 
             $shopee_price_guarantee + 
             $shopee_preferred + 
             $shopee_response_rate + 
             $shopee_response_time +
             $shopee_ratings_summary +
             $shopee_ratings_good +
             $shopee_ratings_normal +
             $shopee_ratings_bad +
             $shopee_sold +
             $shopee_followers +
             $shopee_favorites +
             $shopee_joined;

    $average = ($total/51)*100;

    $percent = abs(round($average, 0));
    $excess = abs(round($average-100, 0));

    // Change URL to affiliate when turned on.
    if(SHOPEE_AFFILIATED == true && $review->shopee_refer != 'UNSET'){
        $url = $review->shopee_refer;
    } else {
        $url = $review->shopee_link;
    }

    if ($percent >= 80 && $percent <= 100) {
      $data = array(
        'color' => 'success',
        'text' => 'Potentially Legit:',
        'desc' => 'We found nothing wrong with this product',
        'icon' => 'thumbs-up'
      );
    } elseif ($percent >= 50 && $percent < 80) {
      $data = array(
        'color' => 'warning',
        'text' => 'Buy with Caution',
        'desc' => 'This product may have some issues',
        'icon' => 'alert-triangle',
      );
    } else {
      $data = array(
        'color' => 'danger',
        'text' => 'High Risk, Potentially Scam',
        'desc' => "This product is likely to be fraudulent",
        "icon" => "thumbs-down"
      );
    }

    $result = array(
                'value' => $percent,
                'excess' => $excess,
                'data' => $data,
                'url' => urldecode($url),
                'debug' => $total,

    );

    return json_encode($result);
}

function isShopeeShortenedLink($link) {
        $shopeeShortenedDomain = "shp.ee";
        $linkDomain = parse_url($link, PHP_URL_HOST);

        return ($linkDomain === $shopeeShortenedDomain);
}

function getOriginalLink($shortenedLink) {
    $curl = curl_init($shortenedLink);
    curl_setopt($curl, CURLOPT_URL, "https://corsproxy.io/?".$shortenedLink);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    $response = curl_exec($curl);
    if ($response === false) {
        echo 'Curl error: ' . curl_error($curl);
    } else {
        $originalLink = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
        $redir = explode("redir=", $originalLink)[1];
        $redir = urldecode($redir);
        return $redir;
    }
    curl_close($curl);
}

function extractShopeeIds($link) {
  $regex1 = '/^https:\/\/shopee\.ph\/product\/(\d+)\/(\d+)\S*$/';
  $regex2 = '/^https:\/\/shopee\.ph\/(\S+)-i\.(\d+)\.(\d+)$/';

  if (preg_match($regex1, $link, $matches)) {
    // match format: https://shopee.ph/product/{shopid}/{itemid}
    $shopid = $matches[1];
    $itemid = $matches[2];
  } elseif (preg_match($regex2, $link, $matches)) {
    // match format: https://shopee.ph/{product-name}-i.{shopid}.{itemid}
    $shopid = $matches[2];
    $itemid = $matches[3];
  } else {
    // not a valid Shopee link
    $shopid = "";
    $itemid = "";
  }

  return array("shopid" => $shopid, "itemid" => $itemid);
}
