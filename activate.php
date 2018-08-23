<?php
        $title = 'AirX Airlines | Account Activation';
	include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
	u_logged_in_redirect();
	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';

	if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<h4>You have successfully activated your account!</h4>	
<?php
	}
	else if(isset($_GET['u_mailid'], $_GET['u_mailcode']) === true) {
		$u_mailid = trim($_GET['u_mailid']);
		$u_mailcode = trim($_GET['u_mailcode']);
		if(u_email_exists($u_mailid) === false) {
			$errors[] = 'Sorry, we couldn\'t find that Email Address';
		}
		else if (u_activate($u_mailid, $u_mailcode) === false){
			$errors[] = 'Sorry, there was some problem activating that account';
		}
		if(empty($errors) === false) {
?>
		<h4>Ooops...</h4>
<?php

	echo output_errors($errors);
	}
	else {
		header('Location: activate.php?success');
		exit();
	}	
	}
	else {
		header('Location: index.php');
		exit();
	}
	
	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php';
?>