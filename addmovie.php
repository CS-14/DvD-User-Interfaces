<?php session_start(); ?>
<?php
require_once('inc/connection.php');
 ?>


<?php
$errors = array();
$mid = '';
$mname= '';
$mprice = '';
$mdesc = '';
$catid = '';

$file_name ='';
$file_type ='';
$file_size ='';
$temp_name ='';

// $admid = '';
// $invid = '';



if(isset($_POST['upload']))
{
	$file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$file_size = $_FILES['image']['size'];
	$temp_name = $_FILES['image']['tmp_name'];

	$upload_to = 'image/';
	// checking the file type
	if ($file_type != 'image/jpeg') {
		$errors[] = 'Only JPEG files are allowed.';
	}

	// checking file size
	if ($file_size > 2500000) {
		$errors[] = 'File size should be less than 2.5Mb.';
	}

	if (empty($errors)) {
		$file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
	}}



?>











