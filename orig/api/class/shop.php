<?php
ini_set('display_errors', 1);

Class Shop {
	private $db;

	public function __construct() {
		ob_start();
   		include $_SERVER['DOCUMENT_ROOT'].'/api/db_connect.php';
		$this->db = $conn;
	}

	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

    
	//Request to get user points
	function get_user_points(){
		extract($_POST);

		$qry = $this->db->query("SELECT points FROM users where id = '".$_SESSION['user_id']."' ");
		$row= $qry->fetch_assoc();
		
		//Todo: No manual reload needed
		$_SESSION['user_points'] = $row['points'];

		
		if($user_id == $_SESSION['user_id']){
			 $json = array(
				'code' => 10000,
				'value' => array(number_format($row['points'], 2), "")
			); 
		} else { //Editing the values detected
			$json = array(
				'code' => 100011,
				'value' => array("", "")
			);
		}

		
		return json_encode($json);

	}

    //Removed
    function get_products_count(){
        $total_pages = $this->db->query('SELECT COUNT(*) FROM products')->fetch_row()[0];

        return $total_pages;
    }

    //Removed
	function get_products($num_results_on_page, $page){
        $total_pages = $this->get_products_count();

		$calc_page = ($page - 1) * $num_results_on_page;
		$qry = $this->db->query("SELECT * FROM products ORDER BY name LIMIT ".$calc_page.",".$num_results_on_page."");
		
		
		while($row = $qry->fetch_assoc()) {
			echo ' <div class="card ecommerce-card">
                            <div class="item-img text-center">
                                <a href="app-ecommerce-details.html">
                                    <img class="img-fluid card-img-top" src="../../../app-assets/images/pages/eCommerce/2.png" alt="img-placeholder" />
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                        <ul class="unstyled-list list-inline">
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h6 class="item-price">₱ '.number_format($row['price'],2).'</h6>
                                    </div>
                                </div>
                                <h6 class="item-name">
                                    <a class="text-body" href="app-ecommerce-details.html">'.$row['name'].'</a>
                                    <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                                </h6>
                                <p class="card-text item-description">
                                    '.$row['description'].'
                                </p>
                            </div>
                            <div class="item-options text-center">
                                <div class="item-wrapper">
                                    <div class="item-cost">
                                        <h4 class="item-price">₱ '.number_format($row['price'],2).'</h4>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                    <i data-feather="heart" class="text-danger"></i>
                                    <span>Wishlist</span>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                    <i data-feather="shopping-cart"></i>
                                    <span class="add-to-cart">Add to cart</span>
                                </a>
                            </div>
                        </div>';
		 }

         return $total_pages;
	}


    function get_products_v2(){
        extract($_POST);
        
        include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';

        $total_pages = $this->get_products_count();

		$calc_page = ($page - 1) * $_config['shop']['limit_products'];
		$qry = $this->db->query("SELECT pro.id, pro.name, pro.img, pro.description, IFNULL(FORMAT(MIN(proi.price+pro.fee), 2), '0.00') AS price, pro.slug FROM products pro LEFT JOIN products_items proi ON pro.id = proi.product_id GROUP BY pro.id, pro.name, pro.img, pro.description, pro.slug ORDER BY NAME LIMIT ".$calc_page.",".$_config['shop']['limit_products']."");
		

        $result = array();
        $count = 0;
		
		while($row = $qry->fetch_assoc()) {
			$result[] = $row;
            $count++;
		 }

         $json = array(
				'count' => $total_pages,
                'limit' => $_config['shop']['limit_products'],
                'results' => $count,
				'products' => $result
			);

         return json_encode($json);


	}


    function get_search_products_count(){
        
        $aKeyword = explode(" ", strip_tags($query));
		$qry = $this->db->query("SELECT * FROM products WHERE name LIKE '%" . $aKeyword[0] . "%'");
        
        for($i = 1; $i < count($aKeyword); $i++) {
		    if(!empty($aKeyword[$i])) {
			    $query .= " OR name like '%" . $aKeyword[$i] . "%'";
		    }
        }

        $total_pages = $this->qry->fetch_row()[0];

        return $total_pages;
    }


    function search_product_v2(){
        extract($_POST);
        
        require_once $_SERVER['DOCUMENT_ROOT'].'/api/config.php';

        $total_pages = $this->get_products_count();

        $aKeyword = explode(" ", strip_tags($keyword));
        //$qry = $this->db->query("SELECT id, name, img, description, FORMAT(price, 2) as price FROM products WHERE stock > 0 AND STATUS = 1 AND name LIKE '%" . $aKeyword[0] . "%' ORDER BY name LIMIT ".$calc_page.",".$_config['shop']['limit_products']."");
        $qry = $this->db->query("SELECT id, name, img, description, FORMAT(price, 2) as price, slug FROM products WHERE stock > 0 AND STATUS = 1 AND name LIKE '%" . $aKeyword[0] . "%' ORDER BY name");
        
        $result = array();
        $count = 0;
		
		while($row = $qry->fetch_assoc()) {
			$result[] = $row;
            $count++;
		 }

         $json = array(
				'count' => $total_pages,
                'limit' => $count,
                'results' => $count,
				'products' => $result
			);

         return json_encode($json);


	}

    //Removed
    function search_product(){
        extract($_POST);
        
        $count = 0;

        //$total_pages = $this->get_search_products_count();

		$calc_page = ($page - 1) * $num_results_on_page;

        $aKeyword = explode(" ", strip_tags($keyword));
		$qry = $this->db->query("SELECT * FROM products WHERE name LIKE '%" . $aKeyword[0] . "%'");
        

        while ($row = $qry->fetch_assoc()) {


            echo ' <div class="card ecommerce-card">
                            <div class="item-img text-center">
                                <a href="app-ecommerce-details.html">
                                    <img class="img-fluid card-img-top" src="../../../app-assets/images/pages/eCommerce/2.png" alt="img-placeholder" />
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="item-wrapper">
                                    <div class="item-rating">
                                        <ul class="unstyled-list list-inline">
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                            <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h6 class="item-price">₱ '.number_format($row['price'],2).'</h6>
                                    </div>
                                </div>
                                <h6 class="item-name">
                                    <a class="text-body" href="app-ecommerce-details.html">'.$row['name'].'</a>
                                    <span class="card-text item-company">By <a href="javascript:void(0)" class="company-name">Apple</a></span>
                                </h6>
                                <p class="card-text item-description">
                                    '.$row['description'].'
                                </p>
                            </div>
                            <div class="item-options text-center">
                                <div class="item-wrapper">
                                    <div class="item-cost">
                                        <h4 class="item-price">₱ '.number_format($row['price'],2).'</h4>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-light btn-wishlist">
                                    <i data-feather="heart" class="text-danger"></i>
                                    <span>Wishlist</span>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-primary btn-cart">
                                    <i data-feather="shopping-cart"></i>
                                    <span class="add-to-cart">Add to cart</span>
                                </a>
                            </div>
                        </div>';

            $count++;
        } 
		
	}

    //This check if the item id already exist.
    function check_item_exist($id){

        $qry = $this->db->query("SELECT * FROM `products` WHERE id = ".$id)->fetch_row()[0];

        if($qry > 0){
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    function get_item_details($id){

        $qry = $this->db->query("SELECT * FROM `products` WHERE id = ".$id);
        
        $result = array();
		
		while($row = $qry->fetch_assoc()) {
			$result[] = $row;
		 }

         return json_encode($result);
    }

    function check_slug_exist($slug){
        $qry = $this->db->query("SELECT * FROM `products` WHERE slug = ".$slug)->fetch_row()[0];

        if($qry > 0){
            $result = true;
        } else {
            $result = false;
        }

        return $result;
    }

    function get_product_items_v2($id){
        //$qry = $this->db->query("SELECT id, amount, price, stock FROM `products_items` WHERE product_id = ".$id." AND stock > 0");
        $qry = $this->db->query("SELECT id, amount, price, stock FROM `products_items` WHERE product_id = ".$id."");
        
        $result = array();
		
		while($row = $qry->fetch_assoc()) {
			$result[] = $row;
		 }

         return $result;
    }


    function get_product_details_v2($slug){
        $qry = $this->db->query("SELECT * FROM `products` WHERE slug = '".$slug."'");
        
		while($row = $qry->fetch_assoc()) {
			$json = array(
                'id' => $row['id'],
				'name' => $row['name'],
                'img' => $row['img'],
                'description' => $row['description'],
                'fee' => $row['fee'],
                'status' => $row['status'],
				'items' => $this->get_product_items_v2($row['id'])
			);
		 }

         

         return json_encode($json);
    }

    //Check if ID exist
    function checkParameters($prd_id, $prd_item_id){

        $qry = $this->db->query("SELECT * FROM `products_items` WHERE `product_id` = ".intval($prd_id)." AND `id` = ".intval($prd_item_id))->num_rows;
        
        return $qry;
    }


    function checkStock($prd_id, $prd_item_id, $quantity){
         $qry = $this->db->query("SELECT * FROM `products_items` WHERE `product_id` = ".intval($prd_id)." AND `id` = ".intval($prd_item_id)." AND stock >= ".$quantity)->num_rows;
        
        return $qry;
    }

    function getPrice($prd_id, $prd_item_id){
    $price = 999999;

         $qry = $this->db->query("SELECT * FROM `products_items` WHERE `product_id` = ".intval($prd_id)." AND `id` = ".intval($prd_item_id)." AND stock > 0");
        
         while($row = $qry->fetch_assoc()) {
			$price = $row['price'];
		 }
        return $price;
    }

    function getName($prd_id, $prd_item_id){
    $prodName = "Unknown";
    $prodAmount = "$0.00";

         $qry = $this->db->query("SELECT * FROM `products` WHERE `id` = ".intval($prd_id)."");
        
         while($row = $qry->fetch_assoc()) {
			$prodName = $row['name'];
		 }

         $qry1 = $this->db->query("SELECT * FROM `products_items` WHERE `id` = ".intval($prd_item_id)."");
        
         while($row1 = $qry1->fetch_assoc()) {
			$prodAmount = $row1['amount'];
		 }

         $name = $prodAmount.' - '.$prodName;

        return $name;
    }


    function buy_item(){

        extract($_POST);


        $product_id = $_REQUEST['product_id'] ?: 0;
        $item_id = $_REQUEST['item_id'] ?: 0;
        $quantity = $_REQUEST['quantity'] ?: 0;

        $userLogged = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
        $userPoints = isset($_SESSION['user_points']) ? $_SESSION['user_points'] : false;


        //Privacy Feature
        //Checks if user is logged.
        if(!$userLogged){
            $json = array(
				'code' => 100013,
				'value' => array("User not logged", null)
			);
            die($this->toNotification($json['code'], $json['value'][0], $json['value'][1]));
        }

        //Sanitize Parameters
        if($quantity <= 0 || $this->checkParameters($product_id, $item_id) == 0){
            $json = array(
		              	'code' => 100012,
		              	'value' => array("System discovered wrong in parameters.", null)
		    );
            die($this->toNotification($json['code'], $json['value'][0], $json['value'][1]));
        }

        //Stock Checking
        if($this->checkStock($product_id, $item_id, $quantity) == 0){
            $json = array(
			         	'code' => 100014,
			         	'value' => array("Out of Stock", null)
			);
            die($this->toNotification($json['code'], $json['value'][0], $json['value'][1]));
        }

        //Payment Process
        $name = $this->getName($product_id, $item_id);
        $total_cost = ($this->getPrice($product_id, $item_id)*$quantity) + $this->get_fee($product_id);
        if($this->get_points() < $total_cost){
            $json = array(
			                  	'code' => 100015,
			                  	'value' => array("Points is not enough", null)
		    );
        } else {
            // Get user points transaction
            $query = "SELECT type, SUM(amount) as sum_amount FROM `user_transaction` WHERE user_id = ".$_SESSION['user_id']." GROUP BY type";
            $result = mysqli_query($this->db, $query);
            
            $sums = array(1 => 0, 2 => 0, 3 => 0);

            while ($row = mysqli_fetch_assoc($result)) {
              $sums[$row['type']] = $row['sum_amount'];
            }
            
            $points_offers = $sums[1];
            $points_promotion = $sums[2];
            $points_admin = $sums[3];

            // Check if 70% of user's points are coming from Promotions.
            $promotion_percentage = ($points_promotion / $this->get_points()) * 100;

            //echo $this->get_points()." | Percentage: ";
            //echo $promotion_percentage."% | ";

            if ($promotion_percentage >= 70) {
                $json = array(
			                  	'code' => 100024,
			                  	'value' => array("Cannot Buy, 70% of his points are coming from Promotion", null)
			    );
                die($this->toNotification($json['code'], $json['value'][0], $json['value'][1]));
            }

            
            include $_SERVER['DOCUMENT_ROOT'].'/api/class/mailer.php';
            include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';

            // Create Order and Get the unique ID of the recently inserted record
            $insert_id = $this->insert_orders($_SESSION['user_id'], $product_id, $item_id, $name, $quantity, $total_cost);

            // Modify name with quantity
            $name = $name. ' (' .$quantity.'x)';

            // Load the HTML email template
            $template = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/api/email_template/invoice.php');

            // Replace the placeholders with dynamic data
            $template = str_replace('{full_name}', $_SESSION['user_fullname'], $template);
            $template = str_replace('{transaction_id}', $insert_id, $template);
            $template = str_replace('{transaction_date}', date("M d, Y"), $template);
            $template = str_replace('{item_name}', $name, $template);
            $template = str_replace('{item_price}', number_format($this->getPrice($product_id, $item_id)*$quantity, 2, '.', ','), $template);
            $template = str_replace('{service_fee}', number_format($this->get_fee($product_id), 2, '.', ','), $template);
            $template = str_replace('{transaction_total}', number_format($total_cost, 2, '.', ','), $template);
            $template = str_replace('{support_url}', $_config['email']['reply'], $template);


            $mailer = new Mailer();
            $to = $_SESSION['user_email'];
            $subject = 'GainPoints Store';
            $body = $template;
            $altBody = '';

            
            if ($mailer->sendEmail($to, $subject, $body, $altBody)) {
                 $json = array(
			                  	'code' => 100016,
			                  	'value' => array("User has enough points and mail has been sent.", null)
			    );
            } else {
                echo 'Message could not be sent.';
            }

            
           
        }
        
        return $this->toNotification($json['code'], $json['value'][0], $json['value'][1]);

    }

    function get_points(){
        $qry = $this->db->query("SELECT points FROM users where id = '".$_SESSION['user_id']."' ");
        $row= $qry->fetch_assoc();
        $current_points = $row['points'];

        return $current_points;
    }

    function get_fee($product_id){
        $qry = $this->db->query("SELECT fee FROM products where id = '".$product_id."' ");
        $row= $qry->fetch_assoc();
        $fee = $row['fee'];

        return $fee;
    }


    function update_userPoints($amount_paid){
        $new_points = $this->get_points() - $amount_paid;
		
        $update = $this->db->query("UPDATE users SET points = '".$new_points."' WHERE id = ".$_SESSION['user_id']);
        
        //echo "UPDATE users SET points = '".$new_points."' WHERE id = ".$_SESSION['user_id'];
        
        $_SESSION['user_points'] = $new_points;
    }

    function update_productStock($product_id, $item_id, $quantity){

        $update = $this->db->query("UPDATE products_items SET stock = stock - ".$quantity." WHERE id = ".$item_id." AND product_id = ".$product_id);

       // echo "UPDATE products_items SET stock = stock - ".$quantity." WHERE id = ".$item_id." AND product_id = ".$product_id;
    }


    function insert_orders($user_id, $product_id, $item_id, $product_name, $quantity, $amount_paid){
        $data = " user_id = '".$user_id."' ";
		$data .= ", products_item_id = '".$item_id."' ";
        $data .= ", quantity = '".$quantity."' ";
		$data .= ", amount_paid = '".$amount_paid."' ";
		
		$update = $this->db->query("INSERT INTO user_order SET ".$data);

        $insert_id = mysqli_insert_id($this->db);

        
        if($update){
            $this->update_userPoints($amount_paid);
            $this->send_notification($user_id, $product_name, $amount_paid);
            $this->update_productStock($product_id, $item_id, $quantity);
        }

        return $insert_id;
    }

    //User Notification
    function send_notification($user_id, $product_name, $amount_paid){
		include $_SERVER['DOCUMENT_ROOT'].'/api/class/notification.php';

		$create_notification = new Notification();
		$create_notification->send_user_notification($user_id, 100017, $product_name, $amount_paid, 0, 0);

	}

    //Local Notification
    function toNotification($code, $value1, $value2){
        //path of the JSON file
		$file = $_SERVER['DOCUMENT_ROOT'].'/app-assets/system/en/toast.json';

        //put the file in the variable
		$data = file_get_contents($file); 

        $notification = json_decode($data);

        foreach($notification as $notif){
            if($notif->id == $code){
                $title = $notif->title;
				$desc = $notif->desc;
                $type = $notif->type;
                
                //Insert data in title
				if(strpos($title, "{product_name}") == true){
					$title = str_replace("{product_name}", $value1, $notif->title);
				}

                /*
				//Insert data in description
				if(strpos($desc, "{amount}") == true){
					$desc = str_replace("{amount}", number_format($row['value_1'], 2), $notif->desc);
				}

				if(strpos($desc, "{offer_name}")){
					$desc = str_replace("{offer_name}", $row['value_2'], $notif->desc);
				}
                */

                $json = array(
				    'id' => $code,
                    'title' => $title,
                    'desc' => $desc,
                    'type' => $type
			);

            }
            
        }

        return json_encode($json);
    }

}

