<?php 
        $title = 'AirX Airlines | Payment Details'; //Page for storing payment credentials
	include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php'; //Including necessary files 
	u_protect_page();
	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php'; //Adding Header
	if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
	echo "<h4>Card Successfully Added</h4>";
	echo "<h6>You are being redirected, dont press back or cancel</h6>";
	header('refresh: 4, url=payment.php');}
	else{
	?>
	
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>
	<h3>Payment Details</h3>



<div class="row">
<div class="col-lg-12">
          <div class="well bs-component">
		  <?php 
		  					if(u_logged_in()===true) {
		  $uid=$_SESSION['u_id'];               
		  $query="SELECT * FROM `payment_details` WHERE `fu_id` = '$uid'"; 
        $result=mysql_query($query);
		while($row=mysql_fetch_assoc($result))
        {$cardn=substr($row["card_number"],11,4);
			echo "Name on the Card : ".$row["payment_user_name"]."<BR>";
			echo "Card Number : XXXX-XXXX-XXXX-".$cardn."<BR>";
			echo  "Expiry : "   . $row["card_expiry"]. "<BR><HR>";
							}} //List existing payment credentials stored in the database
		  ?>
		  </div>
		  </div>
</div>
<div class="row">
        <div class="col-lg-12">
          <div class="well bs-component">
<legend>Credit/Debit Card Details</legend>
				<form class="form-horizontal" action="" method="POST">
					<div class="form-group">
	                    <div class="col-lg-12">
	                      <input type="text" required class="form-control" maxlength="32" name="carduser" id="carduser" placeholder="Card Holder Name">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <div class="col-lg-8">
	                      <input type="text" required maxlength="16" class="form-control" name="cardnum" id="cardnum" placeholder="Card Number">
	                      </div>
							<div class="col-lg-4">
							
	                      <input type="text" required  class="form-control" name="cardexp" id="cardexp" placeholder="Expiry Month & Year">
	                      </div>					  
	                </div>
					<div class="form-group">
                <center><button type="submit" id="submit" value="submit" name="submit" class="btn btn-primary">Add Card</button></center>
              </div>
					</form>
					</div></div></div>
<script>
$(function() {
    $('#cardexp').datepicker( {
        changeMonth: true,
        changeYear: true,
        //showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
}); //Month - Year selector for Card Expiry MM-YYYY
</script>
<?php
					if(u_logged_in()===true) {
	if( isset($_POST['carduser'])===true && isset($_POST['cardnum'])===true
					&& isset($_POST['cardexp'])===true){
						$uid=$_SESSION['u_id'];
						$name=$_POST['carduser'];
						$cardnum=$_POST['cardnum'];
						$cardexp=$_POST['cardexp'];
						if(!mysql_query("INSERT INTO `payment_details` (`fu_id`,`payment_user_name`, `card_number`, `card_expiry`) VALUES ('$uid','$name','$cardnum','$cardexp')")){
					 die('Invalid query: ' . mysql_error());
					}else{
					header('Location: payment.php?success');}	
					}} //Storing payment details in database
	}
 
	include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php'; //Adding footer

?>