<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
<link rel ="stylesheet" href ="css/style.css">
<link rel="stylesheet" href="css/dvd.css" >
<link rel="stylesheet" href="css/GalleryMainPage.css" >
 <link rel ="stylesheet" href ="css/category_Nav.css">
<link rel ="stylesheet" href ="css/category_Foot.css">
<link rel ="stylesheet" href ="css/category_Form.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>
<body>
<section class="banner2">
<header>
    <a href="#" class="logo"><h2>Sign-up</h2></a>
    <div class="toggleMenu" onmouseover="toggleMenu();"></div>
    <ul class="navigation">
        <li><a href="Index.php">Home</a></li>
        <li><a href="#" >About</a></li>
        <li><a href="contact.php" >Contact</a></li>
        <li><a href="loginform.php" >Log-In</a></li>
        <li><a href="registerform.php" >Sign-Up</a></li>
    </ul>

</header>

 <div class="content">
  <div class="contentBx">

    <h3 class="titleText">Supplier <br> Registration Form </h3>
    </div>
    </div>
  

    <form class ="myform" action ="suplr_registeraction.php"  method ="post">
    
    <div class="container6">
        
        <div class="row100">
	<div class="col">
      <div class="inputBox">
       <input type ="text" name ="fname" class = "inputvalues" required >          
         <span class="text">First Name:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
   <input type ="text" name ="lname" class = "inputvalues" required >
      <span class="text">Last Name:</span>
      <span class="line"></span>
    </div>
</div>
</div>

    <div class="row100">
	<div class="col">
      <div class="inputBox">
       <input type ="text" name ="email" class = "inputvalues" required >          
         <span class="text">Email:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
  <input type ="text" name ="tele" class = "inputvalues" required >
      <span class="text">Telephone:</span>
      <span class="line"></span>
    </div>
</div>
</div>

    <div class="row100">
	<div class="col">
      <div class="inputBox">
        <input type ="text" name ="addr" class = "inputvalues" required >          
         <span class="text">Address:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
   <input type ="text" name ="uid" class = "inputvalues" required >
      <span class="text">NIC:</span>
      <span class="line"></span>
    </div>
</div>
</div>
 </div>
 
 <p>     
          <label for="">&nbsp;</label>
          <button type="submit" name="submit" class="save_button" id = "signup_btn" >Sign Up</button >
        </p>         
        
    </form>
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
      <p><a href="Tel:12930405">+94 74693647</a> <br>
      <a href="Tel:12930405">+94 8985647</a></p>
          </li><br>
          
          <li>
          <span><i class="fa fa-envelope-square" aria-hidden="true"></i>  </span>
          <p><a href="enterprisedvdhouse@gmail.com">enterprisedvdhouse@gmail.com</a></p>
        
          </li><br >
              
     </ul>
      <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>
</div>

</div>

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
