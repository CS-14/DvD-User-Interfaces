<?php

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'dvdofficial'; 
$connection = mysqli_connect('localhost','root','','dvdofficial');

if(mysqli_connect_errno()){
  die('Database connection failed'.mysqli_connect_error());
}
?>