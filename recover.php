<?php 
        $title = 'AirX Airlines | Recovery Process';
	include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
	u_logged_in_redirect();
	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';
?>
            
<h4>Recovery</h4>
            
<?php
	if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>

	<p>We have sent you the recovery details! Please check your email!</p>

<?php
	
	}
	else
	{
		$mode_allowed = array('u_uname','u_password');
		if(isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
			if(isset($_POST['u_mailid']) === true && empty($_POST['u_mailid']) === false) {
				if(u_email_exists($_POST['u_mailid']) === true) {
					u_recover($_GET['mode'],$_POST['u_mailid']);
					header('Location: http://localhost:8383/AirX/recover.php?success');
					exit();
				}
				else {
					echo 'Sorry, we could not find that email address!';
				}
			}
?>

	<form action="" method="POST">
		<br/>
		Please enter your email address:<br/>
		<input type="text" name="u_mailid" /><br/><br/>
		<input type="submit" class="btn btn" value="Recover" />	
	</form>

<?php
		}
		else {
			header('Location: http://localhost:8383/AirX/index.php');
			exit();
		}
	}

?>
            
<?php include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php'; ?>