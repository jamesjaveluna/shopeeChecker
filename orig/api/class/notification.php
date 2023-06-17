<?php
//session_start();
ini_set('display_errors', 1);

Class Notification {
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
		0 = Wala pa ge toast
		1 = Ge toast na
		2 = Ge basa na siya

		*/
	
	function get_user_notification(){
		//path of the JSON file
		$file = $_SERVER['DOCUMENT_ROOT'].'/app-assets/system/en/toast.json';

		//put the file in the variable
		$data = file_get_contents($file); 

		$notification = json_decode($data);
		
		$qry = $this->db->query("SELECT * FROM `user_notification` WHERE user_id = '".$_SESSION['user_id']."' AND status = 0 ORDER BY created_date DESC");
		
		 $results = array();

		if ($qry->num_rows > 0) {
		  while($row = $qry->fetch_assoc()) {
			foreach($notification as $notif){
				if($notif->id == $row['notification_id']){
					$title = $notif->title;
					$desc = $notif->desc;

					//Insert data in title
					if(strpos($title, "{product_name}") == true){
						$title = str_replace("{product_name}", $row['value_1'], $notif->title);
					}

					if(strpos($title, "{amount}") == true){
						$title = str_replace("{amount}", number_format($row['value_1'], 2), $notif->title);
					}

					if(strpos($title, "{offer_name}")){
						$title = str_replace("{offer_name}", $row['value_2'], $notif->title);
					}

					//Insert data in description
					if(strpos($desc, "{amount}") == true){
						$desc = str_replace("{amount}", number_format($row['value_1'], 2), $notif->desc);
					}

					if(strpos($desc, "{offer_name}")){
						$desc = str_replace("{offer_name}", $row['value_2'], $notif->desc);
					}

					$results['notification'][] = array('id' => $row['notification_id'], 'title' => $title, 'desc' => $desc, 'type' => $notif->type);
				}
			}
			
		  }

		 // $json = json_encode($results);
		} else {
			$results['notification'][] = array('id' => 0, 'title' => '', 'desc' => '', 'type' => '');
		}
		return json_encode($results);
	}

	function get_user_notification_bell(){
		//path of the JSON file
		$file = $_SERVER['DOCUMENT_ROOT'].'/app-assets/system/en/toast.json';

		//put the file in the variable
		$data = file_get_contents($file); 

		$notification = json_decode($data);
		
		$qry = $this->db->query("SELECT * FROM `user_notification` WHERE user_id = '".$_SESSION['user_id']."' ORDER BY created_date DESC");
	
		echo ' <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                ';

                                if($_SESSION['user_notification'] > 0){
                                    echo '<div id="notification_new_count" class="badge badge-pill badge-light-primary">'.$this->get_user_notification_count().' New</div>';
                                }

         echo '				</div>
				</li> 
				
			<li id="notification_list" class="scrollable-container media-list">';

		if ($qry->num_rows > 0) {
		  while($row = $qry->fetch_assoc()) {
			foreach($notification as $notif){
				if($notif->id == $row['notification_id']){
					$title = $notif->title;
					$desc = $notif->desc;

					//Insert data in title
					if(strpos($title, "{product_name}") == true){
						$title = str_replace("{product_name}", $row['value_1'], $notif->title);
					}

					if(strpos($title, "{amount}") == true){
						$title = str_replace("{amount}", number_format($row['value_1'], 2), $notif->title);
					}

					if(strpos($title, "{offer_name}")){
						$title = str_replace("{offer_name}", $row['value_2'], $notif->title);
					}

					//Insert data in description
					if(strpos($desc, "{amount}") == true){
						$desc = str_replace("{amount}", number_format($row['value_1'], 2), $notif->desc);
					}

					if(strpos($desc, "{offer_name}")){
						$desc = str_replace("{offer_name}", $row['value_2'], $notif->desc);
					}
					echo '<a class="d-flex" href="'.$row['link'].'" id="'.$row['notification_id'].'">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar bg-light-primary">
                                            <div class="avatar-content">SY</div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading">'.$title.'</p>';
									
									

									echo '<small class="notification-text">'.$desc.'</small>';
									

										
                     echo '              </div>
                                </div>
						 </a>';
				}
			}
			
		  }
		  echo '<li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" id="read-all" onclick="read_all()">Mark all as read</a></li>';
		} else {
			echo '<div class="card-body">
					<div class="meetup-img-wrapper rounded-top text-center">
                                <lottie-player src="http://localhost:8090/app-assets/animation/no_notification.json"  background="transparent"  speed="1"  style="width: 150px; margin-left: 30%; height: 150px;"  loop  autoplay></lottie-player>
								<br>
								<h3>No notifications</h3>
					</div>
                  </div>';
				  // echo '   <li class="dropdown-menu-footer" style="visibility:hidden;"><a class="btn btn-primary btn-block" id="read-all">Mark all as read</a></li>';
		}
		//echo '</li>';

		
	}


	function send_user_notification($user_id, $notification_id, $val_1, $val_2, $val_3, $val_4){
		$data = " user_id = '$user_id' ";
		$data .= ", notification_id = '$notification_id' ";
		$data .= ", type = 'success' ";
		$data .= ", sender_id = '1' ";
		$data .= ", value_1 = '$val_1' ";
		$data .= ", value_2 = '$val_2' ";
		$data .= ", value_3 = '$val_3' ";
		$data .= ", value_4 = '$val_4' ";
		$data .= ", status = '0' ";
		
		if($notification_id == 100017){
			$data .= ", link = '../../../panel/withdrawal' "; 
		}

		if($notification_id == 10003){
			$data .= ", link = '../../../panel/offer' "; 
		}
		
		$save = $this->db->query("INSERT INTO user_notification SET ".$data);

	}

	function mark_notification_read(){
		$mark = $this->db->query("UPDATE user_notification SET status = 2 where user_id = ".$_SESSION['user_id']);
		$_SESSION['user_notification'] = 0;
		
		$json = array(
				'code' => 10000,
				'value' => array("Done", "")
			);

		return json_encode($json);
	}

	function mark_notification_toasted(){
		$mark = $this->db->query("UPDATE user_notification SET status = 1 where user_id = ".$_SESSION['user_id']." AND status = 0");
		//$_SESSION['user_notification'] = 0;
		
		$json = array(
				'code' => 10000,
				'value' => array("Done", "")
			);

		return json_encode($json);
	}

	function get_user_notification_count(){
		$qry = $this->db->query("SELECT * FROM user_notification WHERE user_id = '".$_SESSION['user_id']."' AND status in (0,1)");

		//echo $qry->num_rows;
		$_SESSION['user_notification'] =  $qry->num_rows;

		return $_SESSION['user_notification'];
	}

}

