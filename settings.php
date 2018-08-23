<?php 
        $title = 'AirX Airlines | Settings';
	include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
	u_protect_page();
	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';

	if(empty($_POST)===false) {
		$required_fields = array('u_fname','u_lname','u_mailid');
		foreach($_POST as $key=>$value) {
			if(empty($value) && in_array($key, $required_fields) === true ) {
				$errors[] = 'All the fields are required';
				break 1;
			}
		}

		if(empty($errors) === true ) {
			if(filter_var($_POST['u_mailid'], FILTER_VALIDATE_EMAIL) === false) {
				$errors[] = 'Please enter a valid email address';
			}
			if(u_email_exists($_POST['u_mailid']) === true && $u_data['u_mailid'] !== $_POST['u_mailid']){
				$errors[] ='Sorry, the email is already in use';
			}
			if(!preg_match('/^[a-z]{2,30}$/i', $_POST['u_fname'])) {
				$errors[] = 'Your first name can contain only alphabets';
			}
			if(!preg_match('/^[a-z]{2,30}$/i', $_POST['u_lname'])) {
				$errors[] = 'Your last name can contain only alphabets';
			}
		}
	}
?>

	<h3>Settings</h3>

<?php

	if(isset($_GET['success']) ===true && empty($_GET['success'])===true) {
		echo 'Updated!';
	}
	else 
	{
	if(empty($_POST) ===false && empty($errors)===true) {
		$update_data = array(
			'u_fname' 	=> $_POST['u_fname'],
			'u_lname' 	=> $_POST['u_lname'],
			'u_mailid'	=> $_POST['u_mailid'],
			);
		update_u($session_u_id, $update_data);
		header('Location: settings.php?success');
		exit();
	}
	else if(empty($errors) === false ) {
		echo output_errors($errors);
	}

?>

<form action="" method="POST">
	<br/>
	First Name: <br/>
	<input type="text" name="u_fname" value="<?php echo $u_data['u_fname']; ?>"/><br/><br/>
	Last Name: <br/>
	<input type="text" name="u_lname" value="<?php echo $u_data['u_lname']; ?>"/><br/><br/>
	Email ID: <br/>
	<input type="text" name="u_mailid" value="<?php echo $u_data['u_mailid']; ?>"/><br/><br/>
	<input type="submit" class="btn btn" value="Update" /><br/><br/>

</form>

<?php
}

	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php';

?>