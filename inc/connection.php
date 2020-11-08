<?php

$connection = mysqli_connect('localhost','root','','dvd_managementsystem');

if(mysqli_connect_errno()){
  die('Database connection failed'.mysqli_connect_error());
}
?>