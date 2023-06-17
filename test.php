<?php

require_once __DIR__ . './includes/config.php';

$url = $_GET['url'];

//Extract shop_id and item_id of the URL
$regex = '/\.(\d+)\.(\d+)/';
if (preg_match($regex, $url, $matches)) {
    $shopid = $matches[1]; 
    $itemid = $matches[2]; 
    echo 'shopid: '.$shopid.'<br>';
    echo 'itemid: '.$itemid.'<br>';
} else {
    echo 'Not a valid shopee product link';
    exit(0);
}

$product = getProductDetails($itemid, $shopid);
$seller = json_decode(getShopDetails($shopid), true)['data'];
$ratings = json_decode(getRatings($itemid, $shopid), true)['data'];


// Get Product Details
function getProductDetails($itemid, $shopid){
    $url = 'https://corsproxy.io/?https://shopee.ph/api/v4/item/get?itemid='.$itemid.'&shopid='.$shopid.'';
    $headers = array(
        'af-ac-enc-dat: '.SHOPEE_ENCRYPTION.'',
        'user-agent: '.SHOPEE_AGENT.''
    );
    return(make_get_request($url, $headers));
    
    //var_dump($response);
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

$json = '{
    "error": null,
    "error_msg": null,
    "data": {
        "itemid": 2014410765,
        "shopid": 121778969,
        "overall_purchase_limit": {
            "order_max_purchase_limit": 0,
            "overall_purchase_limit": null,
            "item_overall_quota": null,
            "start_date": null,
            "end_date": null
        }
    }
}';

$data = json_decode($product, true)['data'];




// start buffering output
ob_start();

// dump variable
echo '<h1>Product\'s Data</h1>';
var_dump($data);
echo '<hr><h1>Seller\'s Data</h1>';
var_dump($seller);
echo '<hr><h1>Rating\'s Data</h1>';
var_dump($ratings);

// get buffer contents and clean buffer
$output = ob_get_clean();

// style output with CSS
echo '<pre style="font-size: 14px; line-height: 1.5; background-color: #f7f7f7; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">';
echo $output;
echo '</pre>';


echo '<br><strong>Name: </strong> '.$data['name'];
echo '<br><strong>Description: </strong> '.$data['description'];
echo '<br><strong>Category: </strong> '.$data['fe_categories'][0]['display_name'].' > '.$data['fe_categories'][1]['display_name'].' > '.$data['fe_categories'][2]['display_name'];
echo '<br><strong>Image: </strong> https://cf.shopee.ph/file/'.$data['images'][0];
echo '<br><strong>Price (before): </strong> P'.number_format($data['price_before_discount']/100000, 2);
echo '<br><strong>Price (after): </strong> P'.number_format($data['price']/100000, 2);
echo '<br><strong>Price (Min): </strong> P'.number_format($data['price_min']/100000, 2);
echo '<br><strong>Price (Max): </strong> P'.number_format($data['price_max']/100000, 2);
echo '<br><strong>Stock: </strong> '.$data['stock'];
echo '<br><strong>Discount: </strong> '.$data['discount'];
echo '<br><strong>Favorites (Liked): </strong> '.$data['liked_count'];
echo '<br><strong>Sold (global): </strong> '.$data['global_sold'];
echo '<br><strong>Sold (local): </strong> '.$data['historical_sold'];
echo '<br>';
echo '<br><strong>1 Star: </strong> '.$data['item_rating']['rating_count'][1];
echo '<br><strong>2 Star: </strong> '.$data['item_rating']['rating_count'][2];
echo '<br><strong>3 Star: </strong> '.$data['item_rating']['rating_count'][3];
echo '<br><strong>4 Star: </strong> '.$data['item_rating']['rating_count'][4];
echo '<br><strong>5 Star: </strong> '.$data['item_rating']['rating_count'][5];
echo '<br><strong>Total Stars: </strong> '.$data['item_rating']['rating_count'][0];
echo '<br>';

echo '<br><strong>is Lower Guarantee?: </strong> ';
if($data['has_lowest_price_guarantee']){
    echo 'True';
} else {
    echo 'False';
}
echo '<br><br><h2>Seller\'s Data</h2>';
echo "<strong>Name: </strong> ".$seller['name']."<br>";
echo "<strong>username: </strong> ".$seller['account']['username']."<br>";
echo "<strong>Ratings: </strong> ".$seller['rating_star']."<br>";
echo "<strong>Followers: </strong> ".$seller['follower_count']."<br>";
echo "<strong>Rating (good): </strong> ".$seller['rating_good']."<br>";
echo "<strong>Rating (normal): </strong> ".$seller['rating_normal']."<br>";
echo "<strong>Rating (bad): </strong> ".$seller['rating_bad']."<br>";
$timestamp = $seller['last_active_time']; 
$current_time = time(); // the current Unix timestamp
$elapsed_seconds = $current_time - $timestamp;

// Convert the elapsed time to a more readable format
if ($elapsed_seconds < 60) {
  $elapsed_time = "just now";
} elseif ($elapsed_seconds < 3600) {
  $elapsed_time = floor($elapsed_seconds / 60) . " minutes ago";
} elseif ($elapsed_seconds < 86400) {
  $elapsed_time = floor($elapsed_seconds / 3600) . " hours ago";
} else {
  $elapsed_time = floor($elapsed_seconds / 86400) . " days ago";
}

echo "<strong>Last Active Time: </strong> {$elapsed_time}";
echo '<br><strong>On Vacation: </strong> ';
if($seller['vacation']){
    echo 'True';
} else {
    echo 'False';
}
echo '<br><strong>is Shopee Verified: </strong> ';
if($seller['is_shopee_verified']){
    echo 'True';
} else {
    echo 'False';
}
echo '<br><strong>is Preferred Plus Seller: </strong> ';
if($seller['is_preferred_plus_seller']){
    echo 'True';
} else {
    echo 'False';
}
echo '<br><strong>is Official Shop: </strong> ';
if($seller['is_official_shop']){
    echo 'True';
} else {
    echo 'False';
}

echo '<br><br><h2>Rating\'s Data</h2>';
echo "<strong>Comments (contxt): </strong> ".$ratings['item_rating_summary']['rcount_with_context']."<br>";
echo "<strong>Comments (image): </strong> ".$ratings['item_rating_summary']['rcount_with_image']."<br>";
echo "<strong>Comments (media): </strong> ".$ratings['item_rating_summary']['rcount_with_media']."<br>";
require_once('./app-assets/vendors/autoload.php');
Use Sentiment\Analyzer;
$analyzer = new Analyzer(); 

//new words not in the dictionary
$newWords = [
    'ganda'=> '1.0',
    'maganda'=> '1.0',
    'magaganda'=> '1.0',
    'mabilis' => '1.0',
    'salamat'=> '1.0',
    'again' => '1.0',
    'ulit'=> '1.0',
    'affordable' => '0.5',
    'safe' => '0.5',
    'matibay' => '1',
    'medyo' => '-1.0',
    'okay'=> '0.1',
];

//Dynamically update the dictionary with the new words
$analyzer->updateLexicon($newWords);

foreach($ratings['ratings'] as $rating){
    $comment = $rating['comment'];
    $output_text = $analyzer->getSentiment($comment);
    echo "<strong>Comment: </strong> ".$comment."<br>";
    echo "<strong>Stars: </strong> ".$rating['rating_star']."<br>";
    echo "<strong>Negative: </strong> ".$output_text['neg']."<br>";
    echo "<strong>Neutral: </strong> ".$output_text['neu']."<br>";
    echo "<strong>Positive: </strong> ".$output_text['pos']."<br>";
    echo "<strong>Compound: </strong> ".$output_text['compound']."<br>";
    echo "<br><br><br>";

}
//$output_text = $analyzer->getSentiment("It took so long to arrive when I ordered it! It's also not the size I ordered!");
//
//echo "<strong>Comment: </strong> ".$ratings['ratings'][0]['comment']."<br>";
//echo "<strong>Negative: </strong> ".$output_text['neg']."<br>";
//echo "<strong>Neutral: </strong> ".$output_text['neu']."<br>";
//echo "<strong>Positive: </strong> ".$output_text['pos']."<br>";
//echo "<strong>Compound: </strong> ".$output_text['compound']."<br>";
?>
