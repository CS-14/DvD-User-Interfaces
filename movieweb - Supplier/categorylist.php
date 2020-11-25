<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php

    
       
    
    //checking if a user is logged in
    //if(!isset($_SESSION['user_id'])){
      //  header("Location: loginform.php");
    //}
    $categorylist = ' ';
    $search = ' ';
    //getting the list of users
    if(isset($_GET['search'])){

        $search = mysqli_real_escape_string($connection,$_GET['search']);
        $query ="SELECT * FROM category WHERE (CategoryName LIKE '%{$search}%' ) AND IsDeleted=0 ORDER BY CategoryName";
    }
    else{
        $query ="SELECT * FROM category WHERE IsDeleted='0' ORDER BY CategoryName";
    }


    $result =mysqli_query($connection,$query);
    
    if($result){
      while($category = mysqli_fetch_assoc($result)){
         $categorylist .= "<tr>";
         $categorylist .= "<td>{$category['CategoryName']}</td>";
         $categorylist .= "<td>{$category['Description']}</td>";
         $categorylist .= "<td><a href=\"modifycategory.php?Id={$category['CategoryId']}\">         

                        <!DOCTYPE html>
                            <html>
                            <head>
                            
                            </head>

                            <body>
                            <div>
                                <button>Edit</button>
                            </div>
                            </body>
                        </html></a></td>" ;    
        $categorylist .= "<td><a href=\"deletecategory.php?Id={$category['CategoryId']}\"onclick =\"return confirm('Are you sure to remove category?');\">
                         <!DOCTYPE html>
                                            <html>
                                            <head>
                                            </head>

                                            <body>
                                            <div>
                                                <button>Delete</button>
                                            </div>
                                            </body>
                        </html></a></td>" ;      
                                       
      }

    } 
    else{
    echo "Database query failed";
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset ="UTF-8">
    <title>Categories </title>
    <link rel ="stylesheet" href ="css/movies1.css">
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
    
    
    
      <div class="content3">
  <div class="contentBx3">  
  
       <form action="categorylist.php" method="get"> 
        <div class="container6">
            &ensp;  <h3 class="titleText"><a href="users-view.php" class="btn"> Refresh </a> </h3>
            <div class="row100">
                <div class="col">
                    <div class="inputBox">
                    <input type ="text" name ="search" id="" placeholder="Type category Name  and Press Enter"  value=" <?php echo $search;?>"  style="width :99%;"required  autofocus>       
                        <span class="text">Search</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>
    </form>
    
    </div>
    </div>
    
    
    <div class="content">
  <div class="contentBx">

    <h3 class="titleText"> Categories <a href="categoryform.php" class="btn"> +ADD New </a> &ensp;<a href="categorylist.php" class="btn"> + Refresh </a></h3>
    </div>
    </div>


        

        <div class="content1">
  <div class="contentBx">
    <table class="content-table">
<thead>
        <tr>
            
            <th>    Category</th>
            <th>    Description</th>
            <th>    Edit</th>
            <th>    Delete</th>
        </tr>  
        </thead>
        <?php echo $categorylist; ?>
         </table>
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