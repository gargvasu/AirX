<?php 
	ob_start();
	session_start();
	//error_reporting(0);

	require $_SERVER["DOCUMENT_ROOT"].'AirX/core/database/connect.php';
	require $_SERVER["DOCUMENT_ROOT"].'AirX/core/functions/general.php';
	require $_SERVER["DOCUMENT_ROOT"].'AirX/core/functions/users.php';
	
	$current_file = $_SERVER['SCRIPT_NAME'];
	$current_file = explode('/',$current_file);
	$current_file = end($current_file);

	if(u_logged_in() === true) {
	      $session_u_id = $_SESSION['u_id'];
	      $u_data = u_data($session_u_id,'u_id','u_uname','u_password','u_fname','u_lname','u_address','u_phone','u_mailid','u_sex','u_regdate','u_passrec');
	      if(u_active($u_data['u_uname']) == false) {
			session_destroy();
			header('Location: http://localhost:8383/AirX/loginact.php');
			exit();
		}
		
	      if($current_file !== 'changepass.php' && $current_file !== 'logout.php' && $u_data['u_passrec'] == 1) {
	      		header('Location: http://localhost:8383/AirX/changepass.php?force');
	      		exit();
	      }
	}

	$errors = array();

?>