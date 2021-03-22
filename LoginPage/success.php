<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Success Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="paymentSuc/enter_email.css">
	<link rel="stylesheet" href="paymentSuc/passnav.css">
</head>
	
	
<body>
	<section class="contactUs">
	
<div class="container6">
	
	<div class="row100">
	<div class="col">
      <div class="inputBox">
		  
		</div>
		</div>
	</div>
	
	<div class="row100">
	<div class="col">
      <div class="inputBox">
		<header>
    <a href="#" class="logo"><h2>Welcome to DVDHOUSE!</h2></a>
    <div class="toggleMenu" onmouseover="toggleMenu();"></div>
    <ul class="navigation">
        <li><a href="customer-view.php">Home</a></li>
        <li><a href="service.php" >Services</a></li>
        <li><a href="contact.php" >Contact</a></li>
        <li><a href="loginform.php" >Log-In</a></li>
        <li><a href="registerform.php" >Sign-Up</a></li>
    </ul>

</header>
		  </div>
</div>
	</div>
		</div>
<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'paymentSuc/vendor/autoload.php';
require_once __DIR__ . "/lib/DataSource.php";
$db_handle = new DataSource();
if(isset($_SESSION["cart_item"]))
{
	$memberId = $_SESSION['user_id'];
	$selectOrderId="select RefNo from orderstable order by RefNo desc limit 1";
	$orderId=$db_handle->select($selectOrderId)[0]["RefNo"]+1;

	
	$total_quantity=$_SESSION["totQty"];
	$total_price=$_SESSION["totPrice"];
	$sqlAdd="insert into orderstable (RefNo,TotalCost,Qty,Confirmation,CustomerId) values(?,?,?,'0',?)";
	$paramType = 'iiis';
        $paramValue = array(
            $orderId,
            $total_price,
			$total_quantity,
			$memberId
        );
	$db_handle->insert($sqlAdd,$paramType, $paramValue);	
	
 	foreach ($_SESSION["cart_item"] as $k => $v) {
		$qty=$_SESSION["cart_item"][$k]["quantity"];
		$code=$_SESSION["cart_item"][$k]["code"];
		$sql1="Update tblproduct set Quantity=Quantity-$qty where code='$code'";
		$db_handle->execute($sql1);
		
		$sql2="insert into order_qunty values(?,?,?)";
		$paramType2 = 'isi';
        $paramValue2 = array(
            $orderId,
            $code,
			$qty
        );
		$db_handle->insert($sql2,$paramType2, $paramValue2);
	}
	$_SESSION["cart_item"]="";
	
	// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


$connection = mysqli_connect("localhost", "root", "", "dvdofficial2");

$sql = "SELECT * FROM users WHERE UserId = '$memberId'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0)
{
	$data=mysqli_fetch_assoc($result);
	$email=$data["Email"];
	$message = "<p>Thank You For Purchasing Dvd's and Blurey's From Our Store</p>";
	$message .= "<p>Order Total:- $total_price</p>";
	$message .= "<p>Order Quantity:- $total_quantity</p>";
	$message .= "Come Again and Experiance High Definition";
	send_mail($email, "Order Confirmation Recipiet", $message);
}
else
{
	echo "<h3 style='color:blue;'>"."Email does not exists"."</h3>";
}
}
function send_mail($to, $subject, $message)
{
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'enterprisedvdhouse@gmail.com';                     // SMTP username
	    $mail->Password   = 'JohnConst_1234';                               // SMTP password
	    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
	    $mail->Port       = 587;                                    // TCP port to connect to

	    $mail->setFrom('enterprisedvdhouse@gmail.com', 'DVD House Nugegoda');
	    //Recipients
	    $mail->addAddress($to);

	    // Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = $subject;
	    $mail->Body    = $message;

	    $mail->send();
		
	  echo "<p style='color:white;'>".'Message has been sent'."</p>";
	} catch (Exception $e) {
	    echo "<h3 style='color:blue;'>"."Message could not be sent. Mailer Error: {$mail->ErrorInfo}"."</h3>";
	}
}
?>

<?php

?>

		
		<script type="text/javascript"> 
    function toggleMenu()
    {
    const toggleMenu = document.querySelector('.toggleMenu');
	const navigation = document.querySelector('.navigation');
    toggleMenu.classList.toggle('active');
	navigation.classList.toggle('active');
    }
    </script>
		
		<h3 style="color: #DBA6A7">Payment Done Successfully</h3>
<footer>
<div class="container7">
        <div class="sec aboutus">
        <h3>About Us</h3>
        <p>When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.</p>
        
        <ul class="sci">
         <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
     
     </ul>
     
</div>

<div class="sec quickLinks">
<h3>Quick Links</h3>
<ul>
          <li><a href="#">About</a></li><br >
          <li><a href="#">FAQ</a></li><br >
          <li><a href="#">Privacy Policy</a></li><br >
          <li><a href="#">Help</a></li><br >
          <li><a href="#">Terms & Conditions</a></li><br>
          <li><a href="#">Contacts</a></li><br>
     
     </ul>
</div>

<div class="sec contact">
<h3>Contact Info</h3>
<ul class="info">
          <li>
          <span><i class="fa fa-map" aria-hidden="true"></i>
          <span>No 89/A Walawwatta Road<br>Papiliyana<br />Sri Lanka
          </span>
          </li><br >
          
           <li>
          <span><i class="fa fa-phone-square" aria-hidden="true"></i>
      <p><a href="#">+94 74693647</a> <br>
      <a href="#">+94 8985647</a></p>
          </li><br>
          
          <li>
          <span><i class="fa fa-envelope-square" aria-hidden="true"></i>  </span>
          <p><a href="#">enterprisedvdhouse@gmail.com</a></p>
        
          </li><br >
              
     </ul>
	</div>
      <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>


</div>

</footer>
	</section>
</body>
</html>