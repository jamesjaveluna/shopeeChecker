<?php
session_start();
ini_set('display_errors', 1);

Class Action {
	private $db;
	private $kiwiwall = array(
				'key' => 'ByloXf99ak08LKru6rVElepxwgDAaadE', 
				'allowed_ip' =>	array('34.193.235.172', '::1', '49.145.111.169', '192.168.1.2', '')
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

	function kiwiwall(){
		extract($_GET);
		$status = $_REQUEST['status'];
		$trans_id = $_REQUEST['trans_id'];
		$sub_id = $_REQUEST['sub_id'];
		$sub_id_2 = $_REQUEST['sub_id_2'];
		$sub_id_3 = $_REQUEST['sub_id_3'];
		$sub_id_4 = $_REQUEST['sub_id_4'];
		$sub_id_5 = $_REQUEST['sub_id_5'];
		$gross = $_REQUEST['gross'];
		$amount = $_REQUEST['amount'];
		$offer_id = $_REQUEST['offer_id'];
		$offer_name = $_REQUEST['offer_name'];
		$category = $_REQUEST['category'];
		$os = $_REQUEST['os'];
		$app_id = $_REQUEST['app_id'];
		$ip_address = $_REQUEST['ip_address'];
		$signature = $_REQUEST['signature'];

		//Validate IP Address
		if (!in_array($_SERVER['REMOTE_ADDR'], $this->kiwiwall['allowed_ip'])) {
			return 0;
			 //die();
		}

		//Validate Key
		$validation_signature = md5($sub_id . ':' . $amount . ':' . $this->kiwiwall['key']);
			if ($signature != $validation_signature) {
				// Signatures not equal - send error code
				return 0;
				//die();
		}

		$transaction_id = $this->save_transaction($sub_id, 'Kiwiwall', $amount);
		$this->load_points($sub_id, $amount);
		$this->save_offer($sub_id, $transaction_id, $offer_name, 'Kiwiwall', $amount, $gross);
		$this->send_notification($sub_id, $amount, $offer_name);

		return 1;
		die();
	}

	function save_transaction($sub_id, $provider, $amount){
		$data = " user_id = $sub_id ";
		$data .= ", type = 1";
		$data .= ", provider = '".$provider."' ";
		$data .= ", amount = $amount ";

		//return $save = $this->db->query("INSERT INTO user_transaction SET ".$data);

		if ($this->db->query("INSERT INTO user_transaction SET ".$data) === TRUE) {
			return $this->db->insert_id;
		}

	}

	function save_offer($sub_id, $transaction_id, $offer_name, $provider, $amount, $value){
		$data = " user_id = $sub_id ";
		$data .= ", transaction_id = $transaction_id ";
		$data .= ", offer_name = '".mysqli_real_escape_string($this->db, $offer_name)."' ";
		$data .= ", provider = '".$provider."' ";
		$data .= ", amount = $amount ";
		$data .= ", value = $value ";

		$save = $this->db->query("INSERT INTO user_offer SET ".$data);
	}

	function send_notification($sub_id, $amount, $offername){
		include $_SERVER['DOCUMENT_ROOT'].'/api/class/notification.php';

		$create_notification = new Notification();
		$create_notification->send_user_notification($sub_id, 10003, $amount, $offername, 0, 0);

	}

	function load_points($amount, $sub_id){
		$this->db->query("UPDATE users SET points = points + ".$amount." where id = ".$sub_id);
	}


}

