<?php 
  include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
  include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';

        if(u_logged_in()===true) {
          if(isset($_POST['p_pnr'])===true && isset($_POST['p_fno'])===true) {
            $uid=$u_data['u_id'];
            $pnr = $_POST['p_pnr'];
            $fno = $_POST['p_fno'];
			$p_name=$_POST['p_name'];
			$p_age=$_POST['p_age'];
			$p_sex=$_POST['p_sex'];
			$p_aadhar=$_POST['p_aadhar'];
            $query2="DELETE FROM `booking_details` WHERE `b_pnr`='$pnr' AND `fu_id`='$uid'";
            $result2=mysql_query($query2);
			
            $query1="DELETE FROM `passenger_details` WHERE `p_pnr`='$pnr' AND `u_id`='$uid' AND `p_aadhar`='$p_aadhar' AND `p_name`='$p_name' AND `p_age`='$p_age' AND `p_sex`='$p_sex'";
            $result1=mysql_query($query1);
            
        }
      }
      echo 'Tickets Cancelled. You will  be redirected to your bookings page in 5 seconds!';
            header('refresh: 5, url=bookings.php');
 include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php'; 
 ?>