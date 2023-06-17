<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);

Class Panel {
	private $db;
	
	public $partners = array(
					 null,
					 'kiwiwall',
					 'partner2'
	);


	public function __construct() {
		ob_start();
   		include $_SERVER['DOCUMENT_ROOT'].'/api/db_connect.php';
    
		$this->db = $conn;
	}

	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function getUserOffers(){
		$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
		$qry = $this->db->query("SELECT `id`, `transaction_id`, DATE_FORMAT(`createdDate`, '%Y-%m-%d %h:%i') as date, `transaction_id`, `offer_name`, `provider`, `amount` FROM `user_offer` WHERE user_id = ".$userID." ORDER BY `id` DESC");
		
		$data = array();

		while ($row = $qry->fetch_assoc()) {
			$row['amount'] = number_format($row['amount'], 2, '.', ',');
			$data[] = $row;
		}
			$json = array(
				'data' => $data
			);

         return json_encode($json);
	}

	function getUserTransaction(){
		$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
		$qry = $this->db->query("SELECT `id`, DATE_FORMAT(`date`, '%Y-%m-%d %h:%i') as date, `type`, `provider`, `amount` FROM `user_transaction` WHERE user_id = ".$userID." ORDER BY `id` DESC");
		
		$data = array();
		
		while ($row = $qry->fetch_assoc()) {
			$row['amount'] = number_format($row['amount'], 2, '.', ',');
			$data[] = $row;
		}

		$json = array(
			'data' => $data
		);

         return json_encode($json);
	}

	function getUserWithdrawals(){
		$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;
		$qry = $this->db->query("SELECT orders.id, DATE_FORMAT( orders.created_date, '%Y-%m-%d %h:%i' ) AS date, orders.status, orders.products_item_id AS itemID, prod.name, prod.img, prod.fee, prodItem.amount AS figure, orders.quantity, orders.amount_paid AS amount FROM user_order orders LEFT JOIN products_items prodItem ON orders.products_item_id = prodItem.id LEFT JOIN products prod ON prodItem.product_id = prod.id WHERE orders.user_id = ".$userID." ORDER BY orders.id ASC ;");
		
		$data = array();

		while ($row = $qry->fetch_assoc()) {
			$row['amount'] = number_format($row['amount'], 2, '.', ',');
			$data[] = $row;
		}
			$json = array(
				'data' => $data
			);

         return json_encode($json);
	}

}

