<?php

	$connect_error = 'Sorry, there was some connectivity issue!';
	@mysql_connect('localhost','root','') or die($connect_error);
	@mysql_select_db('airx') or die($connect_error);

?>