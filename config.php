<?php
	$conn= mysqli_connect('localhost','root','','airline');
	if(!$conn){
		die("Connection failed:" . mysqli_connect_error());
	}
	session_start();
?>