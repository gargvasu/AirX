<?php 
  include $_SERVER["DOCUMENT_ROOT"].'AirX/core/init.php';
  
  include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/header.php';
?>

      <div class="row">
        <div class="col-lg-12">
          <div class="well bs-component">
            <form class="form-horizontal" action="" method="GET">
              <center><legend>Search Flights</legend></center>
              <div class="form-group">
                <div class="col-lg-6">
                  <label class="control-label" for="focusedInput">From</label>
                  <input class="form-control" name="from_city" id="from_city" value="<?php if(isset($_GET['from_city'])) { echo htmlentities ($_GET['from_city']); } else echo '';?>" required type="text">
                </div>

                <div class="col-lg-6">
                  <label class="control-label" for="focusedInput">To</label>
                  <input class="form-control" name="to_city" id="to_city" value="<?php if(isset($_GET['to_city']) ) { echo htmlentities ($_GET['to_city']); } else echo '';?>" required type="text" onchange="samecheck()">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-4">
                  <label class="control-label" for="focusedInput">Departure Date</label>
                  <input class="form-control" name="departure_date" id="departure_date" value="<?php if(isset($_GET['departure_date'])) { echo htmlentities ($_GET['departure_date']); } else echo '';?>" required type="text">
                </div>
           
                <div class="col-lg-4">
                <label for="select" class="control-label">Number of Passengers</label>
                  <input type="number" class="form-control" name="count_a"  value="1" min="1">
                </div>
                <div class="col-lg-4">
                  <label for="select" class="control-label">Class</label>
                  <select class="form-control" name="class" id="select">
                    <option name="economy" value="Economy">Economy</option>
                    <option name="business" value="Business">Business</option>
                  </select>
                  <br>
                </div>
              </div>
              <div class="form-group">
                <center><button type="submit" id="submit" value="submit" name="submit" class="btn btn-primary">Submit</button></center>
              </div>
            </form>
          </div>
        </div>
		</div>
		<div class="row">
        <div class="col-lg-12">
          <div class="well bs-component">
            <form class="form-horizontal" action="book.php" method="GET">
            <?php 
            
            if( isset($_GET['from_city'])===true && isset($_GET['to_city'])===true
              && isset($_GET['departure_date'])===true
              && isset($_GET['count_a'])===true  && isset($_GET['class'])===true) {
              
              $from = $_GET['from_city'];
              $cityfrom = explode(" ", $_GET['from_city']);
			  $to = $_GET['to_city'];
			  $cityto = explode(" ", $_GET['to_city']);
              $departdate = $_GET['departure_date'];
              $class = $_GET['class'];

              $counta = $_GET['count_a'];


              echo '<center><legend> '.$class.' flights from '.$cityfrom[0].' ( '.$cityfrom[1].' ) to '.$cityto[0].' ( '.$cityto[1].' ) on '.$departdate.' </legend></center>';
              $query = "SELECT * FROM `flight_search` WHERE `from_city`= '$cityfrom[0]' AND `to_city` = '$cityto[0]' AND `departure_date` = '$departdate'";
              $result = mysql_query($query);
			  $counter=0;
			  if (!$result) {
    die('Invalid query: ' . mysql_error());
}                
 
              if($result) {
              if(mysql_num_rows($result) > 0) {
				  ?>
                <table class="table">
                  <thead>
                  <tr>
                    <th>Flight No</th>
					<th> Flight Name</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
					<th>Stops</th>
                    <th>Seats Left</th>
                    <th>Price</th>
                  </tr>
                  </thead>
                  <tbody><?php
 
              while($row = mysql_fetch_assoc($result)) {
                
					if((($class==='Economy') && $row['e_seats_left']<$counta) ||$row['booked_status']==1 ){

					}else if((($class==='Business') && $row['b_seats_left']<$counta)||$row['booked_status']==1 ){

					}else{
						$counter=$counter+1;
				 if($class==='Economy') {  ?>
                   <tr><td><input type="radio" name="chose_to" value="<?php echo $row['fno']; ?>"/><?php echo " ".$row['fno']; ?></td>
                   <td><img src='vendor\img\<?php echo $row['fname']; ?>.jpg' height='75px' >
				   <?php echo $row['fname']; ?></td>
				   <td><?php echo $row['departure_time']; ?></td>
                   <td><?php echo $row['arrival_time']; ?></td>
				   <td><?php  if($row['f_stops']==0) {echo "Non Stop";}else{ echo "One Stop";} ?></td>
                   <td><?php echo $row['e_seats_left']; ?></td>
                   <td><?php echo $row['e_price']; ?></td></tr>
                   <?php } 
				   else if($class==='Business') { ?> <tr>
                   <td><input type="radio" name="chose_to" value="<?php echo $row['fno']; ?>"/><?php echo $row['fno']; ?></td>
                   <td><?php echo $row['departure_time']; ?></td>
                   <td><?php echo $row['arrival_time']; ?></td>
                   <td><?php echo $row['b_seats_left']; ?></td>
                   <td><?php echo $row['b_price']; ?></td></tr>
                <?php
			  }}}
if($counter===0){
			  echo 'No flights available right now';
			  }else{			  
              ?>
              </tr>
              </tbody>
              </table>
              
			  <input type="hidden" name="count_a" value="<?php echo $counta; ?>"/>
              <center><button type="submit" id="class" name="class" value="<?php echo $class; ?>" class="btn btn-primary">Choose Flights</button></center>
              <?php
			  }
			  }
			    else { echo 'No flights found';}
          }
		  
		  
              else {  die(mysql_error()); }

         }
          else { ?>
              
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
<script>
function samecheck() {
    to = document.forms[0].from_city.value;
	fro =document.forms[0].to_city.value;
	if(to==fro){
		document.forms[0].to_city.value="";
		alert("Destination cannot be same as Origin");
}}
</script>
<?php include $_SERVER["DOCUMENT_ROOT"].'AirX/includes/overall/footer.php'; ?>