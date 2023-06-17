<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);

Class Offers {
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

		$qry = $this->db->query("SELECT `id`, DATE_FORMAT(`date`, '%Y-%m-%d %h:%i') as date, `type`, `provider`, `amount` FROM `user_offers` WHERE 1 ORDER BY `date` DESC");
		
		$data = array();

		while ($row = $qry->fetch_assoc()) {
			$data[] = $row;
		}
			$json = array(
				'data' => $data
			);

         return json_encode($json);
	}

}

