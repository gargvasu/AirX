<?php 
        $title = 'AirX Airlines | User Registration'; 
	include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
	u_logged_in_redirect();
	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';
	
	if(empty($_POST)===false) {
		$required_fields = array('u_uname','u_password','u_password_again','u_fname','u_lname','u_mailid','u_sex','u_address','u_phone');
		foreach($_POST as $key=>$value) {
			if(empty($value) && in_array($key, $required_fields) === true ) {
				$errors[] = 'All the fields are required!';
				break 1;
			}
		}

		if(empty($errors) === true ){
			if(u_exists($_POST['u_uname']) === true) {
				$errors[] = 'Sorry, such a username has already been taken by another user!';
			}
			if(preg_match("/\\s/", $_POST['u_uname']) == true) {
				$errors[] = 'Your username cannot contain any spaces!';
			}
			if(!preg_match('/^[a-z][0-9a-z]{1,31}$/i', $_POST['u_uname'])) {
				$errors[] = 'Your username can contain only alphabets and numbers!';
			}
			if(!preg_match('/^[a-z]{2,30}$/i', $_POST['u_fname'])) {
				$errors[] = 'Your first name can contain only alphabets';
			}
			if(!preg_match('/^[a-z]{2,30}$/i', $_POST['u_lname'])) {
				$errors[] = 'Your last name can contain only alphabets';
			}
			if(strlen($_POST['u_password']) < 6) {
				$errors[] = 'Your password must be atleast 6 characters!';
			}
			if(strlen($_POST['u_uname']) < 6) {
				$errors[] = 'Your username must be atleast 6 characters!';
			}
			if($_POST['u_password'] !== $_POST['u_password_again']) {
				$errors[] = 'Your passwords do no match!';
			}
			/* if(!preg_match('/@gmail\.com$/i', $_POST['faculty_mailid'])) {
				$errors[] = 'You can sign up only with a gmail id';
			} */
			if(filter_var($_POST['u_mailid'], FILTER_VALIDATE_EMAIL) === false ) {
				$errors[] = 'Not a valid email address!';
			}
			if(u_email_exists($_POST['u_mailid']) === true) {
				$errors[] = 'Sorry, such an email id has already been taken by another user!';
			}

		}
	}
	
?>
            
			
			<div class="row">
        <div class="col-lg-4">
          <div class="well bs-component">
			<?php  

				if(isset($_GET['success']) && empty($_GET['success'])) {
					echo 'You have been registered to AirX Airlines successfully! Please check your Email ID for activation link!';
				} 
				else {

				if(empty($_POST)=== false && empty($errors)===true) {
					$register_data = array(
						'u_fname' 	=> $_POST['u_fname'],
						'u_lname' 	=> $_POST['u_lname'],
						'u_sex'		=> $_POST['u_sex'],
						'u_uname' 	=> $_POST['u_uname'],
						'u_password'  	=> $_POST['u_password'],
						'u_mailid' 	=> $_POST['u_mailid'],
						'u_address' 	=> $_POST['u_address'],
						'u_phone' 	=> $_POST['u_phone'],
						'u_mailcode'	=> md5($_POST['u_uname'] + microtime())
						);
					register_u($register_data);
					header('Location: fregister.php?success');
					exit();
				} 
				else if(empty($errors)===false) {
					echo output_errors($errors);
				}
			?>

			<form class="form-horizontal" action="" method="POST">
              <legend>User Registration</legend>

			  <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="focusedInput">First Name</label>
                  <input class="form-control" name="u_fname" id="u_fname" required type="text">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="focusedInput">Last Name</label>
                  <input class="form-control" name="u_lname" id="u_lname" required type="text">
                </div>
              </div>

               <div class="form-group">
                <div class="col-lg-10">
                  <div class="radio">
                    <label>
                      <input type="radio" name="u_sex" value="male" required />
                      Male
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label>
                      <input type="radio" name="u_sex" value="female" required />
                      Female
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="focusedInput">Username</label>
                  <input class="form-control" name="u_uname" id="u_uname" required type="text">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="focusedInput">Password</label>
                  <input class="form-control" name="u_password" id="u_password" required type="password">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="focusedInput">Confirm Password</label>
                  <input class="form-control" name="u_password_again" id="u_password_again" required type="password">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="focusedInput">Email ID</label>
                  <input class="form-control" name="u_mailid" id="u_mailid" required type="text">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="focusedInput">Address</label>
                  <input class="form-control" name="u_address" id="u_address" required type="text">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-12">
                  <label class="control-label" for="focusedInput">Phone Number</label>
                  <input class="form-control" name="u_phone" id="u_phone" required type="text">
                </div>
              </div>

              <div class="form-group">
                <center><button type="submit" id="submit" value="submit" name="submit" class="btn btn-primary">Register</button></center>
              </div>

					
			</form>
			</div>
			</div>
			</div>



<?php 
}
include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php'; ?>  



