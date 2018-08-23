<?php

	session_start();
	session_destroy();
	header('Location: http://localhost:8383/AirX/index.php');

?>