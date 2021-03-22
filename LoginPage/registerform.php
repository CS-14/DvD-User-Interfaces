<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>


<?php

$first_name ='';
$last_name ='';
$cid = '';
$email = '';
$tele = '';
$Address = '';
$city = '';


// check the submission
if (isset($_POST['submit']))
{

    $utype ='customer';
    $first_name = $_POST['fname'];
    $last_name =$_POST['lname'];
    $cid = $_POST['uid'];
    $email = $_POST['email'];
    $tele = $_POST['tele'];
    $Address = $_POST['straddr'];
    $city = $_POST['city'];
    $password = $_POST['pass'];
    $repassword = $_POST['repass'];
// not used here
    $hashed_password =sha1($password);

    $error = 0;
    $errors = array();

    if( empty($first_name)|| empty($last_name) ||  empty($cid)|| empty($email) ||empty($tele)|| empty($Address)||empty( $city)||empty($password)|| empty($repassword))
    {
        $errors[] = 'Inputs are Missing/Invalid';

    }

    else{

        if($password != $repassword ){
            $errors[] = 'Password is Invalid';
        }
        else {


            // insert data to user table
            $query1 = " INSERT INTO users (utype,FirstName,cpassword,Email)
        VALUES('{$utype}','{$first_name}','{$password}','{$email}') ";

            $result1 = mysqli_query($connection , $query1 );

            // select specific user id
            $query2 = " SELECT UserId FROM users WHERE  Email ='{$email}'";
            $result2 = mysqli_query($connection , $query2);



            if($result2->num_rows >0){
                while($row = $result2->fetch_assoc())
                {
                    $uid = $row["UserId"];
                }

            }

            if ($result1)
            {

                if($utype == 'customer')
                {
                    $query3 = " INSERT INTO customer (cpassword,FirstName,LastName,StreetAddress,ccity,Email,Telephone,CustomerId,UserId)
            VALUES('{$password}','{$first_name}','{$last_name}','{$Address}','{$city}','{$email}','{$tele}','{$cid}',{$uid})";
                    $result3 = mysqli_query($connection , $query3);
                }


            }

            if($result3){

                header('Location:loginform.php');
            }
            else{
                $errors[] = 'Customer is already registered /Invalid ';
            }


        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
    <link rel ="stylesheet" href ="css/style2.css">
<link rel="stylesheet" href="css/VideoCube2.css">
    <link rel="stylesheet" href="css/VideoCube1.css">
    <link rel="stylesheet" href="css/GalleryMainPage.css" >
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body style ="background-image: url('image/Sherlock2.jpg');">
<header>
    <a href="#" class="logo"><h3>Sign-up</h3></a>
    <div class="toggleMenu" onmouseover="toggleMenu();"></div>
    <ul class="navigation">
        <li><a href="Home.php">Home</a></li>
        <li><a href="service.php" >Services</a></li>
        <li><a href="contact.php" >Contact</a></li>
        <li><a href="loginform.php" >Log-In</a></li>
        <li><a href="registerform.php" >Sign-Up</a></li>
    </ul>

</header>
  <section class="banner">    
		
	<div class="profile-card">
		<div class="image-container">
			<img src="image/flash.png" class="avatar">
		           
		</div>

    <form class ="myform" action ="registerform.php"  method ="post">

        <?php

        if(!(empty ($errors))){
            display_errors($errors);
        }
        ?>
		
		<div class="main-container">
			<h1 class="personal-info">Personal Info</h1>
			<div class="container6">

				<div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type ="text" name ="fname" class = "inputvalues"  required <?php echo 'value ="'.$first_name.'"';?>>
      <span class="text"><i class="fa fa-user"></i> First Name</span>
      <span class="line"></span>
    </div>
</div>
 
<div class="col">
      <div class="inputBox">
     <input type ="text" name ="lname" class = "inputvalues" required <?php echo 'value ="'. $last_name.'"';?> >
      <span class="text"><i class="fa fa-user-o"></i> Last Name</span>
      <span class="line"></span>
    </div>
</div>
</div>
				
<div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type ="text" name ="uid" class = "inputvalues" required <?php echo 'value ="'.$cid.'"';?> >
      <span class="text"><i class="fa fa-user-circle-o"></i> NIC: </span>
      <span class="line"></span>
    </div>
</div>

	<div class="col">
      <div class="inputBox">
      <input type ="text" name ="email" class = "inputvalues" required <?php echo 'value ="'.$email.'"';?> >
     <span class="text"><i class="fa fa-envelope"></i> Email</span>
      <span class="line"></span>
    </div>
</div>
</div>
											
<div class="row100">
	<div class="col">
      <div class="inputBox">
     <input type ="text" name ="tele" class = "inputvalues" required <?php echo 'value ="'.$tele.'"';?> >
      <span class="text"><i class="fa fa-phone"></i>Telephone</span>
      <span class="line"></span>
    </div>
</div>
	
	<div class="col">
      <div class="inputBox">
     <input type ="text" name ="straddr" class = "inputvalues" required <?php echo 'value ="'.$Address.'"';?> >
      <span class="text"><i class="fa fa-home"></i> Street Address </span>
      <span class="line"></span>
    </div>
</div>
</div>
			

<div class="row100">
	<div class="col">
      <div class="inputBox">
<input type ="text" name ="city" class = "inputvalues" required <?php echo 'value ="'. $city.'"';?> >
      <span class="text"><i class="fa fa-user-circle-o"></i> City :</span>
      <span class="line"></span>
    </div>
</div>

		<div class="col">
      <div class="inputBox">
      <input type ="password" name ="pass" class ="inputvalues" required <?php echo 'value ="'.$first_name.'"';?> >
      <span class="text"><i class="fa fa-lock"></i> Password</span>
      <span class="line"></span>
    </div>
</div>
</div>							

  <div class="row100">
	<div class="col">
      <div class="inputBox">
       <input type ="password" name ="repass" class ="inputvalues" required <?php echo 'value ="'.$first_name.'"';?>
      <span class="text"><i class="fa fa-lock"></i>Confirm Password</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
      
    </div>
</div>
			</div>
        

      <input type ="submit"  name ="submit" id = "signup_btn" value="Sign Up"/><br>
        </form>
  </div>
</div>
	  <video src="image/Suicide Squad.mp4" autoplay="autoplay" muted="" loop="loop"></video>
			
		
    <div class="box">
   	<div>
        <span><video src="image/WonderWoman1984.mp4" autoplay="autoplay" muted="" loop=""></span>
        <span><video src="image/SUICIDE2.mp4" autoplay="autoplay" muted="" loop=""></span>
        <span><video src="image/HarleyQuinn.mp4" autoplay="autoplay" muted="" loop="loop"></span>
      </div>
   </div>
      
      <div class="box2">
   	<div>
        <span><video src="image/HarleyQuinn.mp4" autoplay="autoplay" muted="" loop=""></span>
        <span><video src="image/RAYA.mp4" autoplay="autoplay" muted="" loop=""></span>
        <span><video src="image/WonderWoman1984.mp4" autoplay="autoplay" muted="" loop="loop"></span>
      </div>
      </div>
	</section>
	
	<footer>
<div class="container7">
        <div class="sec aboutus">
        <h2>About Us</h2>
        <p>When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.</p>
        
        <ul class="sci">
         <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
     
     </ul>
     
</div>

<div class="sec quickLinks">
<h2>Quick Links</h2>
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
<h2>Contact Info</h2>
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

</div>

<h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>

</footer>
</body>
</html>
