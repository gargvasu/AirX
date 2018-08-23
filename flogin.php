<?php 
        $title = 'AirX Airlines | Login';
	include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
	u_logged_in_redirect();
	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';
?>
            
            <form class="form-horizontal" action="loginact.php" method="POST">
                  <div class="row">
                  <div class="col-lg-4">
            	<div class="well bs-component">
                  <legend>Passenger Log In</legend>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                    <div class="col-lg-12">
                      <input type="text" name="u_uname" class="form-control" required placeholder="Username">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-12">
                      <input type="password" name="u_password" class="form-control" required placeholder="Password">
                    </div>
                  </div>
            	<div class="form-group">
                <center><button type="submit" id="submit" value="submit" name="submit" class="btn btn-success">Login</button></center>
              </div>
              </form>
            	<strong><a href="http://localhost:8383/AirX/fregister.php" style="color:white">Register Here</a></strong><br/><br/>
            	<strong><a href="http://localhost:8383/AirX/recover.php?mode=u_uname" style="color:white">Forgot Username?</a></strong><br/>
            	<strong><a href="http://localhost:8383/AirX/recover.php?mode=u_password" style="color:white">Forgot Password?</a></strong><br/>
            </form>
            </div>
            </div></div>

            
<?php include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php'; ?> 