<?php
ini_set('display_errors', 1);

Class Support {
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

	/*
		TICKETS STATUS
		0 = In-progress (blue)
		1 = Waiting for reply (orange)
		2 = Solved (green)
		3 = Lock (red)

	*/

	function createTicket(){
		extract($_POST);

		$userLogged = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
		$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

		//Escape
		$title = mysqli_real_escape_string($this->db, htmlspecialchars($title));
		$message = mysqli_real_escape_string($this->db, htmlspecialchars($message));

		//Create the Ticket
		$data_ticket = " user_id = '$userID' ";
		$data_ticket .= ", title = '".$title."' ";

		$ticket = $this->db->query("INSERT INTO support_ticket SET ".$data_ticket);

		//Start the conversation
		$qry = $this->db->query("SELECT * FROM support_ticket WHERE user_id = ".$userID." AND title = '".$title."'");
		
		while($row = $qry->fetch_assoc()) {
			$ticket_id = $row['id'];
		}

		$data_chat = " sender = '$userID' ";
		$data_chat .= ", ticket_id = '$ticket_id' ";
		$data_chat .= ", chat = '".$message."' ";

		$ticket_chat = $this->db->query("INSERT INTO support_chat SET ".$data_chat."");

		if($ticket && $ticket_chat){
			echo $this->toNotification(100022, null, null);
		} else {
			echo $this->toNotification(100023, null, null);
		}
	}


    function getTickets(){
        include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';


		$qry = $this->db->query("SELECT * FROM support_ticket WHERE user_id =".$_SESSION['user_id']);
		
        $result = array();
		
		while($row = $qry->fetch_assoc()) {
			$result[] = $row;
		 }

         $json = array(
				'ticket' => $result
			);

         return json_encode($json);


	}

	function getAdminTickets(){
        include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';


		$qry = $this->db->query("SELECT * FROM support_ticket");
		
        $result = array();
		
		while($row = $qry->fetch_assoc()) {
			$result[] = $row;
		 }

         $json = array(
				'ticket' => $result
			);

         return json_encode($json);


	}

	function getChat(){
        extract($_POST);
        
		//Security
		if($this->privacyCheck() == 1){
			$ticket_id = $_REQUEST['ticket_id'];

			include $_SERVER['DOCUMENT_ROOT'].'/api/config.php';

			//Request for ticket data
			$ticket = $this->db->query("SELECT ticket.id, USER.id as author_id, USER.fullname as author_name, USER.avatar as author_avatar, ticket.title, ticket.status FROM support_ticket ticket LEFT JOIN users USER ON ticket.user_id = USER.id WHERE ticket.id = ".$ticket_id." ORDER BY ticket.created_date;");
			//Request for chats
			$qry = $this->db->query("SELECT chat.id, chat.sender, user.avatar, chat.ticket_id, chat.chat, chat.created_date FROM support_chat chat LEFT JOIN users user ON chat.sender = user.id WHERE chat.ticket_id = ".$ticket_id." ORDER BY chat.created_date");
			
			$result = array();
			$count = 0;
			
			$supportStatusRaw = 0;
			$supportStatus = null;
			$supportTitle = null;
			$authorID = 0;
			$authorAvatar = null;

			while($row1 = $ticket->fetch_assoc()) {
				$authorID = $row1['author_id'];
				$authorAvatar = $row1['author_avatar'];
				if($_SESSION['user_type'] == 5 || $_SESSION['user_type'] == 6){
					$supportTitle = $row1['author_name'].' | [#'.$row1['id'].'] '.$row1['title'].'';
				} else {
					$supportTitle = '[#'.$row1['id'].'] '.$row1['title'];
				}
				
				$supportStatusRaw = $row1['status'];
			}

			while($row2 = $qry->fetch_assoc()) {
				$result[] = $row2;
				$count++;
			}

			//Convert status
			 switch($supportStatusRaw){
                 case 0: //In Progress
                     $supportStatus = '<small class="float-right mb-25"><span class="badge badge-info">In-progress</span></small>';
                     break;

                 case 1: //Waiting for reply
                      $supportStatus = '<small class="float-right mb-25"><span class="badge badge-warning">Waiting for reply</span></small>';
                     break;

                 case 2: //Solved
                     $supportStatus = '<small class="float-right mb-25"><span class="badge badge-success">Solved</span></small>';
                     break;

                 case 3: //Lock
                     $supportStatus = '<small class="float-right mb-25"><span class="badge badge-danger">Solved</span></small>';
                     break;
             }

			 if($count != 0){
				
				$json = array(
					'code' => 10000,
					'authorID' => $authorID,
					'authorAvatar' => $authorAvatar,
					'supportTitle' => $supportTitle,
					'SSCode' => $supportStatusRaw,
					'supportStatus' => $supportStatus,
					'messages' => $result
				);
				
			 } else {
				$json = json_decode($this->toNotification(100019, null, null));
			 }
			 

			 return json_encode($json);
		} 
	}

	function sendChat(){
		extract($_POST);

		$user_id = $_SESSION['user_id'];
		$text = mysqli_real_escape_string($this->db, $message);
		$data = " sender = '$user_id' ";
		$data .= ", ticket_id = '$ticket_id' ";
		$data .= ", chat = '$text' ";
		
		$save = $this->db->query("INSERT INTO support_chat SET ".$data);

		if($save){
			echo 'Chatted Successfully';
		} else {
			echo $this->toNotification(100021, null, null);
		}
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

	//Checks if user is logged.
	function privacyCheck(){
		$loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;
		if($loggedIn == true){
			return 1;
		} else {
			echo $this->toNotification(100018, null, null);
		}
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

                $json = array(
				    'code' => $code,
                    'title' => $title,
                    'desc' => $desc,
                    'type' => $type
			);

            }
            
        }

        return json_encode($json);
    }



}

