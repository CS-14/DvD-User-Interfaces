<?php session_start(); ?>
 <?php
require_once('inc/connection.php');
 ?>


<?php


// $errors=array();
$mid = '';
$mname= '';
$mprice = '';
$mdesc = '';
$catid = '';


//View    

    if(isset($_GET['Id'])){

    //Getting that movie information
      $mid=mysqli_real_escape_string($connection,$_GET['Id']);
      $query="SELECT * FROM dvd WHERE DVD_Id='{$mid}'";
      $result_set=mysqli_query($connection,$query);
          if($result_set){
            $result=mysqli_fetch_assoc($result_set);
            $DVDid = $result['DVD_Id'];
            $name= $result['Name'];
            $price = $result['Price'];
            $description = $result['description'];
            $categoryId = $result['CategoryId'];
            
          }
          else{
            //query unsuccessful
            header('Location:movielist.php?err=query failed');
          }

    }









//Check whether if submitted
if(isset($_POST['submit']))
{

   
$mid = $_POST['DVDid'];
$mname= $_POST['name'];
$mprice = $_POST['price'];
$mdesc = $_POST['description'];
$catid = $_POST['categoryId'];





   //checking required feilds
   $req_fields = array('DVDid', 'name', 'price', 'description','categoryId');

    foreach ($req_fields as $field) {
      if (empty(trim($_POST[$field]))) {
        echo $field . ' is required';
      }
    }

//check whether the lengths are correct


/*$max_len_fields=array('DVD_Id' => 50,'Name' => 50, 'Price' => 100, 'Description' => 300, 'CategoryId' => 50,'AdminId' => 50,'InventoryId' => 50, );
foreach($max_len_fields as $field => $max_len){
 if(strlen(trim($field)) > $max_len){ 
    $errors[] = $field . ' must be less than ' . $max_len . ' characters' ;
 }

}*/

//check whether the dvd already exists in the system

// $Name=mysqli_real_escape_string($connection,$mname);
// $query="SELECT * FROM dvd WHERE  Name='{$Name}' AND DVD_Id !={$mid} LIMIT 1";

// $result_set = mysqli_query($connection, $query);

//   if($result_set){
//      if(mysqli_num_rows($result_set)==1){
//         echo 'Movie already exists.';
//      }

    

    
      
    // $DVD_Id=mysqli_real_escape_string($connection$mid,);
    // //$Name=mysqli_real_escape_string($connection,$mname);
    // $Price=mysqli_real_escape_string($connection,$mprice);
    // $Description=mysqli_real_escape_string($connection,$mdesc);
    // $CategoryId=mysqli_real_escape_string($connection,$catid);
    // $AdminId=mysqli_real_escape_string($connection,$admid);
    // $InventoryId=mysqli_real_escape_string($connection,$invid);

      $query = "UPDATE dvd SET ";
      $query .= "DVD_Id = {$mid}, ";
      $query .= "Name = '{$mname}', ";
      $query .=  "Price = {$mprice}, ";
      $query .= "description = '{$mdesc}', ";
      $query .= "CategoryId  = {$catid} ";
      $query .= "WHERE  DVD_Id = {$mid} LIMIT 1";


    

    $result = mysqli_query($connection,$query);
    if($result)
    {
      // query successful... redirecting to users page
        header('Location: movielist.php?user_modified=true');
    }
    else
    {
      echo $query;
    }  

  }

?>


<!DOCTYPE html>
<html>
<head>
<meta charset ="UTF-8">
<title>View / Modify Movie </title>
<link rel ="stylesheet" href ="css/style.css">
<link rel ="stylesheet" href ="css/category_Nav.css">
<link rel ="stylesheet" href ="css/category_Foot.css">
<link rel ="stylesheet" href ="css/category_Form.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin1.css">
    <link rel="stylesheet" href="css/admin1_chart.css">
    <link rel="stylesheet" href="css/admin1_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>

<section class="banner2">

    <header>
        <a href="#" class="logo">Modify Movie</a>

        <br >
        <div class ="logedin" style="color: lightseagreen;"> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="owner-view.php">Home</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#"></a></li>

        </ul>

    </header>
    <div class="navigation2">
        <ul>
            <li>
                <a href="#">
                    <span class="icon1"><i class="#"" aria-hidden="true"></i></span>
                    <span class="title1"></span></a></li>

            <li>
                <a href="supplierlist.php">
                    <span class="icon1"><i class="fa fa-users"" aria-hidden="true"></i></span>
                    <span class="title1">Suppliers</span></a></li>
            <li>

            <li>
                <a href="categorylist.php">
                    <span class="icon1"><i class="fa fa-anchor" aria-hidden="true"></i></span>
                    <span class="title1">Categories</span></a></li>
            <li>

                <a href="movielist.php">
                    <span class="icon1"><i class="fa fa-film" aria-hidden="true"></i></span>
                    <span class="title1">Movies</span></a></li>


            <li>
                <a href="tvlist.php">
                    <span class="icon1"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                    <span class="title1">TV Series</span></a></li>
            <li>
                <a href="lowqnt.php">
                    <span class="icon1"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></span>
                    <span class="title1">Low Item</span></a></li>
            <li>
                <a href="additems.php">
                    <span class="icon1"><i class="fa fa-th" aria-hidden="true"></i></span>
                    <span class="title1">Fill Stock</span></a></li>
        </ul>
    </div>
        
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
            <h3 class="textTitle"><a href="movielist.php" class="btn"> < Back to Movie List</a></h3>
        </div>
    </div>


        <form action = "modifymovie.php"  method ="post" >  
        <input class = "inputvalues" type="hidden" name ="mid"  value="<?php echo $mid ;?>">

 <div class="container6">
        
  <div class="row100">
  <div class="col">
      <div class="inputBox">
        <input class = "inputvalues"  type="text" name="DVDid" required <?php echo 'value="' . $DVDid . '"'; ?>  >
                 
         <span class="text">DVD Id:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
     <input type="text" name="name" required <?php echo 'value="' . $name . '"'; ?> >
      <span class="text">DVD Name:</span>
      
      <span class="line"></span>
    </div>
</div>
</div>
  
        <div class="row100">
  <div class="col">
      <div class="inputBox">
        <input class = "inputvalues" type="text" name="price"  required <?php echo 'value="' . $price . '"'; ?> >
                 
         <span class="text">Price:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
     <input class = "inputvalues" type="text" name="description" required <?php echo 'value="' . $description . '"'; ?>  >
      <span class="text">Description:</span>
      
      <span class="line"></span>
    </div>
</div>
</div>

  <div class="row100">
  <div class="col">
      <div class="inputBox">
       <input class = "inputvalues" type="text" name="categoryId" required <?php echo 'value="' . $categoryId . '"'; ?>  >
                 
         <span class="text">Category Id:</span>
      <span class="line"></span>
    </div>
</div>
       <p>
          <label for="">&nbsp;</label>
          <button type="submit" name="submit" class="save_button" style="background: blue">Save</button >

        </p>
      </div>
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








