<?php 
  include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
  error_reporting(0);
  u_protect_page();
  include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';

?>

	<div class="row">
		<div class="col-lg-4">
			<div class="well bs-component">
				<?php 
					if(u_logged_in()===true) {
						if(isset($_GET['class'])===true && isset($_GET['count_a'])===true ) {
							$to = $_GET['chose_to'];
									$counta = $_GET['count_a'];
					
									$class = $_GET['class'];
									$q1 = "SELECT * FROM `flight_search` WHERE `fno`='$to'";
									$r1 = mysql_query($q1);
									while($row1 = mysql_fetch_assoc($r1)) {
										echo '<legend>Your flight from '.$row1['from_city'].' to '.$row1['to_city'].'</legend>';
										echo 'Flight Number: '.$row1['fno'].'<br>';
										if($class==='Economy') {
											if(($counta)<=$row1['e_seats_left']) {
												echo 'Departure Time: '.$row1['departure_time'].'<br>';
												echo 'Arrival Time: '.$row1['arrival_time'].'<br>';
												echo 'Number of Adults: '.$counta.'<br>';
												$eat1 = $counta * $row1['e_price'];
												echo 'Cost of '.$counta.' adult(s): '.$counta.' * Rs. '.$row1['e_price'].' =  Rs. '.$eat1.'<br>';
												$etax1 = 500;
												echo 'Airport Tax: Rs. 100 <br>';
												echo 'Fuel Tax: Rs. 100 <br>';
												echo 'Service Tax: Rs. 300 <br>';
												echo 'Total Tax: Rs. '.$etax1.'<br><br>';
												$etot1 = $eat1 + $etax1;
												echo '<legend>Total cost of trip is Rs. '.$etot1.'</legend>';
											}
											else {
												echo 'Not enough available seats. Sorry, please check some other flight!';
												header("refresh:10; url=index.php");
											}
										}
										else if($class==='Business') {
											if(($counta)<=$row1['b_seats_left']) {
												echo 'Departure Time: '.$row1['departure_time'].'<br>';
												echo 'Arrival Time: '.$row1['arrival_time'].'<br>';
												echo 'Number of Adults: '.$counta.'<br>';
												$bat1 = $counta * $row1['b_price'];
												echo 'Cost of '.$counta.' adult(s): '.$counta.' * Rs. '.$row1['b_price'].' =  Rs. '.$bat1.'<br>';
												$btax1 = 1500;
												echo 'Airport Tax: Rs. 200 <br>';
												echo 'Fuel Tax: Rs. 200 <br>';
												echo 'Service Tax: Rs. 1100 <br>';
												echo 'Total Tax: Rs. '.$btax1.'<br><br>';
												$btot1 = $bat1 + $btax1;
												echo '<legend>Cost of one trip is Rs. '.$btot1.'</legend>';
											}
											else {
												echo 'Not enough available seats. Sorry, please check some other flight!';
												header("refresh:10; url=index.php");
											}
										}
									}
							}}
				?>
			</div>
		</div>

		<div class="col-lg-8">
			<div class="well bs-component">
				<form class="form-horizontal" action="" method="GET">
				<?php
				
					if(u_logged_in()===true) {
						if(isset($_GET['count_a'])===true ) {
				$cta = $_GET['count_a'];
				$ctr=0;
				while($cta>$ctr){
					$ctr=$ctr+1;
				
					echo '<h4>Passenger '.$ctr.' Details</h4>
					<div class="form-group">
	                    <div class="col-lg-4">
	                      <input type="text" class="form-control" name="aname'.$ctr.'" id="inputEmail" placeholder="Name" required>
	                    </div>
	                    <div class="col-lg-4">
	                      <input type="text" class="form-control" pattern="[0-9]{12}" name="aadhar'.$ctr.'" id="inputEmail" placeholder="Aadhar" required>
	                    </div>
						<div class="col-lg-2">
	                      <input type="number" min="1"  class="form-control" name="aage'.$ctr.'" id="inputEmail" placeholder="Age" required>
	                    </div>
	                    <div class="col-lg-2">
	                      <select class="form-control" name="asex'.$ctr.'"  id="select" required>
		                    <option value="M">Male</option>
		                    <option value="F">Female</option>
		                  </select>
	                    </div>
	                </div>
					<hr>';}}else{
						echo 'error';
					}}else{
					echo 'error';
					}
					?>
	                <h4>User Contact Details</h4>
	                <div class="form-group">
		                <div class="col-lg-12">
		                  <label class="control-label" for="focusedInput">Name</label>
		                  <input class="form-control" name="puname" id="puname" value="<?php echo $u_data['u_fname'].' '.$u_data['u_lname']; ?>" required type="text" readonly>
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-lg-12">
		                  <label class="control-label" for="focusedInput">Phone Number</label>
		                  <input class="form-control" name="puphno" id="puphno" value="<?php echo $u_data['u_phone']; ?>" required type="text" readonly>
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-lg-12">
		                  <label class="control-label" for="focusedInput">Address</label>
		                  <input class="form-control" name="puadd" id="puadd" value="<?php echo $u_data['u_address']; ?>" required type="text" readonly>
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-lg-12">
		                  <label class="control-label" for="focusedInput">Email ID</label>
		                  <input class="form-control" name="pumail" id="pumail" value="<?php echo $u_data['u_mailid']; ?>" required type="text" readonly>
		                </div>
		            </div>
		            <?php if(isset($_GET['chose_to'])===true) {
		            	 
              			if($class==='Economy') { ?>
              			<input type="hidden" name="count_a" value="<?php echo $counta; ?>"/>
	             		<input type="hidden" name="chose_to" value="<?php echo $to; ?>"/>
	              		<input type="hidden" name="class" value="<?php echo $class; ?>"/>
	              		<input type="hidden" name="eat1" value="<?php echo $eat1; ?>"/>
	              		<input type="hidden" name="etot1" value="<?php echo $etot1; ?>"/>
              		<?php	}
              			else if($class==='Business') { ?>
              				<input type="hidden" name="count_a" value="<?php echo $counta; ?>"/>
	             		<input type="hidden" name="chose_to" value="<?php echo $to; ?>"/>
	              		<input type="hidden" name="class" value="<?php echo $class; ?>"/>

	              		<input type="hidden" name="bat1" value="<?php echo $bat1; ?>"/>
	              		<input type="hidden" name="btot1" value="<?php echo $btot1; ?>"/>
              		<?php	}
              		} 
              		
              		?>
		            <center><button type="submit" id="book_f" name="book_f" class="btn btn-primary">Book Flight</button></center>
				</form>
			</div>
		</div>

	</div>

<?php
		if(u_logged_in()===true) {
	if(isset($_GET["book_f"])){
	if(isset($_GET["count_a"])===true ) {
	$cta=$_GET['count_a'];
	}
	$ctr=0;
	$u_mailid=$_GET["pumail"];
	$u_id=u_id_from_email($u_mailid);
	$f_no=$_GET["chose_to"];
	$st="booked";
	$class=$_GET["class"];
	$ptype="X";
	if($class==='Economy') {
		$pamount=$_GET["eat1"];
	$ptotalamount=$_GET["etot1"];
	}else if($class==='Business'){
		$pamount=$_GET["bat1"];
	$ptotalamount=$_GET["btot1"];
	}
	date_default_timezone_set('Asia/Kolkata');
	$atime = date('H:i:s');
	$edittime = str_replace(':', '', $atime);
	$adate = date('d-m-Y');
	$editdate = str_replace('-', '', $adate);
	$pnr = $edittime.$editdate+100;
	mysql_query("INSERT INTO `booking_details` (`fu_id`, `b_totalprice`, `b_adults`, `b_class`, `b_status`, `b_pnr`) VALUES ('$u_id', '$ptotalamount', '$cta', '$class', '$st', '$pnr')");
		$bidresult = mysql_result(mysql_query("SELECT b_id FROM `booking_details` WHERE `fu_id`='$u_id' AND `b_pnr`= '$pnr'"),0);
	
	while($cta>$ctr){
	$ctr=$ctr+1;
	$namep="aname".$ctr;
	$aadharp="aadhar".$ctr;
	$agep="aage".$ctr;
	$genp="asex".$ctr;
	$pname=$_GET[$namep];
	$paadhar=$_GET[$aadharp];
	$page=$_GET[$agep];
	$psex=$_GET[$genp];
		mysql_query("INSERT INTO `passenger_details` (`p_name`, `p_age`, `p_sex`, `p_pnr`, `p_fno`, `p_class`, `p_status`, `p_passtype`, `u_id`,`p_aadhar`,`p_amount`,`b_id`) VALUES ('$pname', '$page', '$psex', '$pnr', '$f_no', '$class', '$st', '$ptype`', '$u_id','$paadhar','$pamount','$bidresult')");
		}
		if($class==='Economy'){
			$ecrt = mysql_result(mysql_query("SELECT e_seats_left FROM `flight_search` WHERE `fno`='$f_no'"),0);
			$left=$ecrt-$cta;
		mysql_query("UPDATE `flight_search` SET `e_seats_left`='$left' WHERE `fno`='$f_no'");}
		else if($class==='Business'){
		$bcrt = mysql_result(mysql_query("SELECT b_seats_left FROM `flight_search` WHERE `fno`='$f_no'"),0);
			$left=$bcrt-$cta;
		mysql_query("UPDATE `flight_search` SET `b_seats_left`='$left' WHERE `fno`='$f_no'");	
		}
		
		header('Location: bookings.php');
		
		
		
		
		
		}}

  include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php';

?>