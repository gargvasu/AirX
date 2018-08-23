<?php


	function u_recover($mode, $u_mailid) {
		$mode = sanitize($mode);
		$u_mailid = sanitize($u_mailid);
		$u_data = u_data(u_id_from_email($u_mailid),'u_id','u_fname','u_uname');
		if ($mode == 'u_uname') {
			recovery_user_pass($u_mailid, 'Recovery: Your username', "Hello " . $u_data['u_fname'] . ",\n\nYour username is: " . $u_data['u_uname'] . "\n\n-AirX Airlines");
		}
		else if($mode == 'u_password') {
			$generated_password = substr(md5(rand(999, 999999)), 0, 8);
			u_change_password($u_data['u_id'], $generated_password);
			
			update_f($u_data['u_id'], array('u_passrec' => '1'));
			
			recovery_user_pass($u_mailid, 'Recovery: Your password', "Hello " . $u_data['u_fname'] . ",\n\nYour new password is: " . $generated_password . "\n\n-TOFSIS");
		}
	}

	function u_activate($u_mailid, $u_mailcode) {
		$u_mailid = mysql_real_escape_string($u_mailid);
		$u_mailcode = mysql_real_escape_string($u_mailcode);
		if(mysql_result(mysql_query("SELECT COUNT(`u_id`) FROM `users` WHERE `u_mailid` = '$u_mailid' AND `u_mailcode` = '$u_mailcode' AND `u_active` = 0"), 0) == 1) {
			mysql_query("UPDATE `users` SET `u_active` = 1 WHERE `u_mailid` = '$u_mailid' ");
			return true;
		}
		else {
			return false;
		}
	}
	
	function update_u($u_id, $update_data) {
		$update = array();
		array_walk($update_data, 'array_sanitize');
		foreach ($update_data as $field => $data) {
			$update[] = '`' . $field . '` = \'' . $data . '\'';
		}		
		mysql_query("UPDATE `users` SET " . implode(', ',$update) . "WHERE `u_id` = $u_id") or die(mysql_error());
	}

	function u_change_password($u_id, $u_password) {
		$u_id = (int)$u_id;
		$u_password = md5($u_password);
		mysql_query("UPDATE `users` SET `u_password` = '$u_password', `u_passrec` = 0 WHERE `u_id` = $u_id");
	}

	function register_u($register_data) {
		array_walk($register_data, 'array_sanitize');
		$register_data['u_fname'] = ucwords(strtolower($register_data['u_fname']));
		$register_data['u_lname'] = ucwords(strtolower($register_data['u_lname']));
		$register_data['u_password'] = md5($register_data['u_password']);
		$register_data['u_uname'] = strtolower($register_data['u_uname']);
		$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
		$data = '\'' . implode('\', \'', $register_data) . '\'';
		
		mysql_query("INSERT INTO `users` ($fields, `u_regdate`) VALUES ($data, NOW())");
		activation($register_data['u_mailid'], 'AirX Airlines: Activate your account', "Hello " . $register_data['u_fname'] . ", \n\nYou need to activate your account in order to use the features of AirX Airlines. Please click the link below: \n\nhttp://gargvasu.in/AirX/activate.php?u_mailid=" . $register_data['u_mailid'] . "&u_mailcode=" . $register_data['u_mailcode'] . " \n\n-AirX Airlines");
	}

	function u_data($u_id){
		$data = array();
		$u_id = (int)$u_id;
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();
		if($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = '`'. implode('`, `', $func_get_args) . '`';
			$result=mysql_query("SELECT $fields FROM `users` WHERE `u_id` = $u_id");
			if (!$result) {
    die('Invalid query: ' . mysql_error());
}
			$data = mysql_fetch_assoc($result);			
			return $data;
		}
 	}
 	
	function u_logged_in() {
		return (isset($_SESSION['u_id'])) ? true : false;
	}

	function u_exists($u_uname) {
		$u_uname = sanitize($u_uname);
		$query = mysql_query("SELECT COUNT(`u_id`) FROM `users` WHERE `u_uname`= '$u_uname'");
		return (mysql_result($query, 0) == 1) ? true : false; 
	}

	function u_email_exists($u_mailid) {
		$u_mailid = sanitize($u_mailid);
		$query = mysql_query("SELECT COUNT(`u_id`) FROM `users` WHERE `u_mailid`= '$u_mailid'");
		return (mysql_result($query, 0) == 1) ? true : false; 
	}
	

	function u_active($u_uname) {
		$u_uname = sanitize($u_uname);
		$query = mysql_query("SELECT COUNT(`u_id`) FROM `users` WHERE `u_uname`= '$u_uname' AND `u_active` = 1");
		
		return (mysql_result($query, 0) == 1) ? true : false; 
	}

	function u_id_from_username($u_uname) {
		$u_uname = sanitize($u_uname);
		$query = mysql_query("SELECT `u_id` FROM `users` WHERE `u_uname` = '$u_uname'");
		return mysql_result($query, 0, 'u_id');
	} 
	
	function u_id_from_email($u_mailid) {
		$u_mailid = sanitize($u_mailid);
		$query = mysql_query("SELECT `u_id` FROM `users` WHERE `u_mailid` = '$u_mailid'");
		return mysql_result($query, 0, 'u_id');
	} 
	
	function u_login($u_uname, $u_password) {
		$u_id = u_id_from_username($u_uname);
		$u_uname = sanitize($u_uname);
		$u_password = md5($u_password);
		$query = mysql_query("SELECT COUNT(`u_id`) FROM `users` WHERE `u_uname`= '$u_uname' AND `u_password` = '$u_password'");
		return (mysql_result($query, 0) == 1) ? $u_id : false;
	}

?>