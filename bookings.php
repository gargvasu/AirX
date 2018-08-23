<?php 
  include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
  include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';
?>
      
      <legend>My Bookings</legend>

      <?php
        $uid=$u_data['u_id']; //Assigns logged in id to a variable
        $query="SELECT * FROM `passenger_details` WHERE `u_id` = '$uid'"; //Sorts by date time
        $result=mysql_query($query);
        if($result) {
        while($row=mysql_fetch_assoc($result))
        {
          if($uid===$row['u_id']) //Checks if the logged in id matches with id in DB
          { 
            $pnr = $row['p_pnr'];
            $fno = $row['p_fno'];
            $r2=mysql_fetch_assoc(mysql_query("SELECT * FROM `flight_search` WHERE `fno`='$fno'"));
			echo '<form action="cancel.php" method="POST">';
            echo 'Flight No: '.$r2['fno'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo 'From: '.$r2['from_city'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo 'To: '.$r2['to_city'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo 'Class: '.$row['p_class'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo 'PNR Number: '.$row['p_pnr'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<br/>';
            echo 'Departure Date: '.$r2['departure_date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo 'Departure Time: '.$r2['departure_time'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo 'Arrival Date: '.$r2['arrival_date'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo 'Arrival Time: '.$r2['arrival_time'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<br/>';
            echo 'Passenger Name: '.$row['p_name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<br>';
            echo 'Passenger Age: '.$row['p_age'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<br>';
            echo 'Passenger Sex: '.$row['p_sex'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<br>';
			echo 'Passenger Aadhar: '.$row['p_aadhar'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<br>';
            echo 'Boarding Pass Type: '.$row['p_passtype'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<br><br>';
			// $p_name=$row['p_name'];
			// $p_age=$row['p_age'];
			// $p_sex=$row['p_sex'];
			// $p_aadhar=$row['p_aadhar'];
			echo "<input type='hidden' value='".$row['p_name']."' id='p_name' name='p_name' />";
			echo "<input type='hidden' value='".$row['p_age']."' id='p_age' name='p_age' />";
			echo "<input type='hidden' value='".$row['p_sex']."' id='p_sex' name='p_sex' />";
			echo "<input type='hidden' value='".$row['p_aadhar']."' id='p_aadhar' name='p_aadhar' />";
            echo "<input type='hidden' value='".$pnr."' id='p_pnr' name='p_pnr' />";
            echo "<input type='hidden' value='".$fno."' id='p_fno' name='p_fno' />";
            if($row['p_status']==='booked') {
            echo '<button type="submit" value="cancel" name="cancel" class="btn btn-primary">Cancel Bookings</button>';
            echo '<br/><hr>';
            echo '</form>';
          } else {
            echo '<br/><hr>';
            echo '</form>';
           }
          }
        }
      }
?>
    
<?php include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php'; ?>