<?php
session_start();
ini_set('display_errors', 1);

Class User {
	private $db;
	private $webConf = array(
					 'user_xp_on_doing_something' => 10,
					 'level_1_xp_cap' => 100,
					 'level_2_xp_cap' => 200,
					 'level_3_xp_cap' => 300,
					 'level_4_xp_cap' => 400,
					 'level_5_xp_cap' => 500,
	);
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

	function login(){
		extract($_POST);


		$qry = $this->db->query("SELECT u.id, u.fullname, u.email, u.username, u.avatar, u.referral_code, u.type, u.points, xp.amount as exp, xp.level FROM users u LEFT JOIN users_xp xp ON u.id = xp.user_id where u.email = '".$email."' and u.password = '".md5($password)."' ");
		
		if($qry->num_rows > 0){

			//store system configuration
			$sys = $this->db->query("SELECT * FROM system_configuration limit 1")->fetch_array();
			
			foreach ($sys as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['sys'][$key] = $value;
			}
			
			//store user data
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['user_'.$key] = $value;
			}
			
			include $_SERVER['DOCUMENT_ROOT'].'/api/class/notification.php';
			$notif = new Notification();
			switch($_SESSION["user_type"]){

					case 0: //unverified
						$json = array(
							'code' => 10007,
							'value' => array("", null)
						);
						break;

					case 1: //verified
						$json = array(
							'code' => 10001,
							'value' => array($_SESSION['user_username'], null)
						);
						$_SESSION['loggedIn'] = true;
						$_SESSION['user_notification'] = $notif->get_user_notification_count();
						//$this->verify_level($_SESSION['user_id'], $_SESSION['user_level'], $_SESSION['user_exp']);
						break;

					case 2: //permanent_banned
						$json = array(
							'code' => 10008,
							'value' => array("", null)
						);
						break;

					case 3: //temporary_banned
						$json = array(
							'code' => 10009,
							'value' => array($_SESSION['user_username'], null)
						);
						break;

					case 4: //lock
						$json = array(
							'code' => 100010,
							'value' => array("", null)
						);
						break;

					case 5: //admin
    
						$json = array(
							'code' => 10001,
							'value' => array($_SESSION['user_username'], null)
						);
						$_SESSION['loggedIn'] = true;
						$_SESSION['user_notification'] = $notif->get_user_notification_count();

					case 6: //support
    
						$json = array(
							'code' => 10001,
							'value' => array($_SESSION['user_username'], null)
						);
						$_SESSION['loggedIn'] = true;
						$_SESSION['user_notification'] = $notif->get_user_notification_count();
				
			}

		}else{
			$json = array(
				'code' => 10006,
				'value' => array("", null)
			);
		} 



		return json_encode($json);
	}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}

		$json = array(
			'code' => 10002,
			'value' => array("", "")
		);

		return json_encode($json);

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

	//Automation
	function fetch_points($id){

		$qry = $this->db->query("SELECT points FROM users where id = '".$id."' ");
		$row= $qry->fetch_assoc();
		
		//Todo: No manual reload needed
		$_SESSION['user_points'] = $row['points'];

		return $_SESSION['user_points'];
	}


	//Verifies if the user's level is correct and valid.
	function verify_level($user_id, $level, $exp){
		$response = "wrong";
		
		

		//while($level <= $_SESSION['sys']['max_level']){
			if($exp >= $webConf['level_'.$ref_data['level'].'_xp_cap']){
				$response = 'test1';
			} else {
				$response = 'test2';
			}
		//}

		return $response;


	}

	//For user profile page and also in user_settings
	function getProfile($user_id){
		$qry = $this->db->query("SELECT fullname, gender, DATE_FORMAT(birthdate, '%Y-%m-%d') AS birthdate, email, avatar, DATE(created_date) as created_date, check_offer, check_withdrawal, check_news, check_shop FROM users WHERE id = ".$user_id);

		while($row = $qry->fetch_assoc()) {
			$json = array(
                'fullname' => $row['fullname'],
				'avatar' => $row['avatar'],
				'email' => $row['email'],
				'gender' => $row['gender'],
				'birthdate' => $row['birthdate'],
                'created_date' => $row['created_date'],
				'level' => '1',
				'notification_offer' => $row['check_offer'],
				'notification_withdrawal' => $row['check_withdrawal'],
				'notification_news' => $row['check_news'],
				'notification_shop' => $row['check_shop'],
			);
		 }

		 return json_encode($json);

	}

	function updateSession(){
		$qry = $this->db->query("SELECT u.id, u.fullname, u.email, u.username, u.avatar, u.referral_code, u.type, u.points, xp.amount as exp, xp.level FROM users u LEFT JOIN users_xp xp ON u.id = xp.user_id where u.id = '".$_SESSION['user_id']."'");
		
		if($qry->num_rows > 0){
			//store user data
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['user_'.$key] = $value;
			}
		}
	}

	//User Settings
	function updateSettings(){
		extract($_POST);


		// Changing Password
		if($tab == 'changepass'){
			$sql = "SELECT password FROM users WHERE id = 1";
			$result = $this->db->query($sql);

				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					$current_password_hash = $row['password'];

					// Compare the new password and confirm password
					if($new_password != $confirm_new_password){
						$json = array(
		                  	'code' => 100029,
		                  	'value' => array("New password didn't match", null)
						);

						die($this->toNotification($json['code'], $json['value'][0], $json['value'][1]));
					}

					// Compare the current password with the input password
					if ($current_password_hash != md5($password)) {
						$json = array(
		                  	'code' => 100028,
		                  	'value' => array("Old password is incorrect", null)
						);

						die($this->toNotification($json['code'], $json['value'][0], $json['value'][1]));
					}

					// Compare the old password and new password
					if (md5($confirm_new_password) == md5($password) && md5($new_password) == md5($password)) {
						$json = array(
		                  	'code' => 100030,
		                  	'value' => array("New password should not be similar to your previous password.", null)
						);

						die($this->toNotification($json['code'], $json['value'][0], $json['value'][1]));
					}
				}
		}

		if($tab == 'avatar'){
			$avatar = $_FILES['avatar'];

			// validate image file
			// ...

			// move file to folder
			$filename = time() . '_' . $avatar['name'];
			$filepath = '../../app-assets/images/portrait/small/' . $filename;
			move_uploaded_file($avatar['tmp_name'], $filepath);
		}

		switch($tab){
			case 'avatar':
				$data = " `avatar` = '$filename' ";
			break;

			case 'general':
				$data = " `fullname` = '$fullname' ";
				$data .= ", `email` = '$email' ";
				$data .= ", `gender` = '$gender' ";
				$data .= ", `birthdate` = '$birthdate' ";
			break;

			case 'changepass':
				$data = " `password` = MD5('$new_password') ";
			break;

			case 'info':
			break;

			case 'social':
			break;

			case 'default':
			break;
		}

		
		$save = $this->db->query("UPDATE users SET ".$data." WHERE id = 1");
		

		if($save){
			$this->updateSession();
			$json = array(
		                  	'code' => 100025,
		                  	'value' => array("Updated successfully", null)
			);
		} else {
			$json = array(
		                  	'code' => 100026,
		                  	'value' => array("Failed to perform action.", null)
			);
		}

		
		return $this->toNotification($json['code'], $json['value'][0], $json['value'][1]);

	}

	//Admin Support getDetails
	function getUserDetails(){
		extract($_POST);

		//Check if user is logged
		if($this->privacyCheck() == 1){
			if($_SESSION['user_type'] == 5 || $_SESSION['user_type'] == 6){
				$qry = $this->db->query("SELECT fullname, email, type, avatar, points, DATE(created_date) as created_date FROM users WHERE id = ".$user_id);
				
				$type = 0;

				while($row = $qry->fetch_assoc()) {
					switch($row['type']){
						case 0:
						$type = "Account Unverified";
						break;

						case 1:
						$type = "Account Verified";
						break;

						case 2:
						$type = "Account Banned Permanently";
						break;

						case 3:
						$type = "Account Banned Temporarily";
						break;

						case 4:
						$type = "Account Locked";
						break;

						case 5:
						$type = "Admin User";
						break;

						case 6:
						$type = "Support User";
						break;
					}

					$json = array(
				        'fullname' => $row['fullname'],
						'avatar' => $row['avatar'],
						'email' => $row['email'],
						'type' => $type,
						'points' => number_format($row['points'], 2),
				        'created_date' => $row['created_date'],
						'level' => '1'
					);
				 }

				 return json_encode($json);
			} else {
				echo $this->toNotification(100020, null, null);
			}
		}
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

