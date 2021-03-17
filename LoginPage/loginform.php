<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>

<?php
// check for the submission
if (isset ($_POST['loginbtn']) )
{

    $errors = array();
    $error = 0;

    // check if the user name and password has been entered
    if(!(isset($_POST['email'] )))
    {
        $errors[] = 'Email is Missing/Invalid';

    }

    if(!(isset($_POST['password'] )))
    {
        $errors[]= 'Password is Missing/ Invalid';
    }

    //check if there are any errors in the form
    if(empty($errors))
    {
        // save the useremail and password into variable
        $useremail = mysqli_real_escape_string($connection,$_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $hashed_password =sha1( $password);

        // prepare database query
        $query = "SELECT *FROM users 
          WHERE Email ='{$useremail}'
          AND cpassword ='{$password}' 
          LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if($result_set)
        {
            // query successfull
            if(mysqli_num_rows($result_set)==1)
            {
                //valid user found
                $user =mysqli_fetch_assoc($result_set);

                $_SESSION['user_id'] =$user['UserId'];
                $_SESSION['First_name'] = $user['FirstName'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['user_type'] = $user['utype'];
                $custype = $user['utype'];

                // updating last login
                $query = "UPDATE users SET last_login = NOW()";
                $query .= "WHERE UserId ={$_SESSION['user_id'] } LIMIT 1";

                $result_set = mysqli_query($connection, $query);

                if(! $result_set) {
                    die("Database query failed!");
                }
                //redirect to valid user
                // if user is a customer
                if($custype =='customer'){
                    header('Location:customer-view.php');
                }
                // if user is an admin
                if($custype =='admin'){
                    header('Location:adminview.php');}

                // if user is the owner
                if($custype =='owner'){
                    header('Location:owner-view.php');}

                // if user is the cashier
                if($custype =='cashier'){
                    header('Location:cashier-view.php');}

            }else{
                // username and password invalid
                $errors[] = 'Invalid Username/Password';


            }
        }
        else{
            $errors[] = 'Database query failed';

        }

    }

}

else if(isset($_POST['backbtn']))
{
    header("Location: homepage.php");
}


?>

<!DOCTYPE html>
<html lang="">
<head>
<title>Login Page</title>
<link rel ="stylesheet" href ="css/style2.css">
	<link rel="stylesheet" href="css/VideoCube2.css">
    <link rel="stylesheet" href="css/VideoCube1.css">
	 <link rel="stylesheet" href="css/GalleryMainPage.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>
<body style = "background-image: url('image/Sherlock2.jpg' );">
<header>
    <a href="#" class="logo"><h3>Log-In</h3></a>
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
		 <form class="myform" action ="loginform.php" method ="POST">
			 

		<div class="main-container">
			<h1 class="personal-info">Personal Info</h1>
			<div class="container6">

<div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" required class = "inputvalues" placeholder="Type your email" name ="email" />
      <span class="text"><i class="fa fa-envelope"></i> Email or UserName</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
      <input type ="password" name ="password" class ="inputvalues" placeholder="Type your password"required>
      <span class="text"><i class="fa fa-lock"></i> Password</span>
      <span class="line"></span>
    </div>
</div>
</div>
				

			<br>
			<button class="btn" name ="loginbtn" id = "login_btn">Sign In</button>	
				
				   <?php
        if(!(empty ($errors))){
            display_errors($errors);
        }   ?>
				
				 <center> <p><a href="reset2/index.php" style="color:#2C1919 ;" class="btn">Forgot Password!</a></p></center>
				
				</div>
			
	
		</div>
			 

			
	</div>
		 <video src="image/Suicide Squad.mp4" autoplay="autoplay" muted="" loop="loop"></video>
			</form>
		
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
		
		 <script type="text/javascript"> 
    function toggleMenu()
    {
    const toggleMenu = document.querySelector('.toggleMenu');
	const navigation = document.querySelector('.navigation');
    toggleMenu.classList.toggle('active');
	navigation.classList.toggle('active');
    }
    </script>
</body>
</html>

