<?php

	session_start(); 
	session_destroy(); //session destroyed
	header('Location: http://localhost:8383/AirX/index.php'); //redirected to index page

?>