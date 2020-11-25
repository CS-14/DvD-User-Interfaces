<!DOCTYPE html>
<html>
<head>  

<meta charset ="UTF-8">
<title>Add New Movie </title>
<link rel ="stylesheet" href ="css/style.css">
<link rel ="stylesheet" href ="css/category_Nav.css">
<link rel ="stylesheet" href ="css/category_Foot.css">
<link rel ="stylesheet" href ="css/category_Form.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 
</head>

<body>


<section class="banner2">

    <header>       
   <a href="#" class="logo">DVD Series</a>
<div class="toggleMenu" onmouseover="toggleMenu();"></div>
 <ul class="navigation">
    <li><a href="#">Home</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Gallery</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li>
    </ul>
    <br>
    <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> !  <a href="logout.php" class="btn1">LogOut</a></div> 
       
    </header>  
      
       
 <?php
           if(!empty($errors)){
            echo '<div class="errmsg">';
            echo '<b>There were Errors in your form.</b>' ;
            foreach ($errors as $error){

                echo $error . '<br>';
            }
            
            echo '</div>';
           }


 ?>
 
 <div class="content">
  <div class="contentBx">

    <h3 class="titleText"> Movie Form <a href="categoryform.php" class="btn"> +ADD Movie </a><a href="movielist.php" class="btn" > + Back to Movie List</a></h3>
    
    </div>
    </div>
    
        <form action ="addmovie.php"  method ="post" >  
          
<div class="container6">
        
        <div class="row100">
	<div class="col">
      <div class="inputBox">
       <input type="text" name="DVDid" class = "inputvalues" required >
                 
         <span class="text">DVD Id:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
    <input type="text" name="name" required >
      <span class="text">DVD Name:</span>
      <span class="line"></span>
    </div>
</div>
</div>

     <div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" name="price" required>
                 
         <span class="text">Price:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
     <input type="text" name="description"  required >
      <span class="text">Description:</span>
      <span class="line"></span>
    </div>
</div>
</div>

   <div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" name="categoryId"  required    >
                 
         <span class="text">Category Id:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
    <input type="text" name="adminId"   required >
      <span class="text">Admin Id:</span>
      <span class="line"></span>
    </div>
</div>
</div>

 <div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" name="inventoryId" required  >
                 
         <span class="text">Inventory Id:</span>
      <span class="line"></span>
    </div>
</div>


  </div>      
  <p>     
          <label for="">&nbsp;</label>
          <button type="submit" name="submit" class="save_button" >Save</button >
       
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