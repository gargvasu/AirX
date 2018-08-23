<?php

        $title = 'AirX Airlines | Login Error';
	include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
	

	if(empty($_POST) === false) {
		$u_uname = $_POST['u_uname'];
		$u_password = $_POST['u_password'];

		if(empty($u_uname) === true || empty($u_password) === true){
			$errors[] = 'You need to enter both, the username and the password!';
		} 
		else  if (u_exists($u_uname)===false) {
			$errors[] = 'No such user exists! Please register!';
		}
		else if(u_active($u_uname)===false) {
			$errors[] = 'Please activate your account!';
		}
		else {

			if(strlen($u_password)>32) {
				$errors[] = 'Password too long!';
			}

			$u_login = u_login($u_uname, $u_password);
			if($u_login===false) {
				$errors[] = 'Username and Password do not match!';
			}
			else {
				$_SESSION['u_id'] = $u_login;
				header('Location: http://localhost:8383/AirX/index.php');
				exit();
			}
		} 		
	}
	else {
			$errors[] = 'No Log In credentials received!';
		}

	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';

	if(empty($errors) === false) {
?>
	<br/><h4>We tried to log you in, but : </h4><br/>

<?php
	echo output_errors($errors);
	}

	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php';

?>