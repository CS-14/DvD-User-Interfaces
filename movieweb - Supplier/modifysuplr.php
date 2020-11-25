 <?php 
require_once('inc/connection.php');
 ?>


<?php


// $errors=array();
$fname = '';
$lname= '';
$sid = '';
$email = '';
$tele = '';
$Address = '';


//View    

    if(isset($_GET['suplr_id'])){

    //Getting that movie information
      $sid=mysqli_real_escape_string($connection,$_GET['suplr_id']);
      $query="SELECT * FROM suppliers WHERE Supplier_Id='{$sid}'";
      $result_set=mysqli_query($connection,$query);
          if($result_set){
            $result=mysqli_fetch_assoc($result_set);
            $fname = $result['FirstName'];
            $lname= $result['LastName'];
            $email = $result['Email'];
            $tele = $result['PhoneNo'];
            $addr = $result['Address'];
            $uid = $result['Supplier_Id'];
            
          }
          else{
            //query unsuccessful
            header('Location:supplierlist.php?err=query failed');
          }

    }

//Check whether if submitted
if(isset($_POST['submit']))
{

   
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$tele = $_POST['tele'];
$Address = $_POST['addr'];
$sid = $_POST['uid'];




   //checking required feilds
   $req_fields = array( 'fname','lname', 'uid', 'email','tele','addr');

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

      $query = "UPDATE suppliers SET Supplier_Id = '{$sid}', FirstName = '{$fname}', LastName = '{$lname}',  Email  = '{$email}', PhoneNo  = '{$tele}' ,Address = '{$Address}'WHERE  Supplier_Id = '{$sid}' LIMIT 1";


    

    $result = mysqli_query($connection,$query);
    if($result)
    {
      // query successful... redirecting to users page
        header('Location: supplierlist.php?user_modified=true');
    }
    else
    {
      echo "error";
    }  

  }

?>


<!DOCTYPE html>
<html>
<head>
<meta charset ="UTF-8">
<title> Modify Supplier </title>
<link rel ="stylesheet" href ="css/movies2.css">
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

    <h3 class="titleText"> Supplier Modification <a href="categoryform.php" class="btn"> +ADD New </a>
      <a href="supplierlist.php" class="btn"> +Back to Supplier List</a></h3>
      
    </div>
    </div>

        <form action = "modifysuplr.php"  method ="post" >    
     
        <input class = "inputvalues" type="hidden" name ="sid"  value="<?php echo $sid ;?>">
        
         <div class="container6">
        
        <div class="row100">
	<div class="col">
      <div class="inputBox">
        <input class = "inputvalues" type="text" name="fname"  required <?php echo 'value="' . $fname . '"'; ?> >
                 
         <span class="text">First Name:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
    <input class = "inputvalues" type="text" name="lname"  required <?php echo 'value="' . $lname . '"'; ?> >
      <span class="text">Last Name:</span>
      <span class="line"></span>
    </div>
</div>
</div>

        
        <div class="row100">
	<div class="col">
      <div class="inputBox">
       <input class = "inputvalues" type="text" name="email" required <?php echo 'value="' . $email . '"'; ?>  >
                 
         <span class="text">Email:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
    <input class = "inputvalues" type="text" name="tele" required <?php echo 'value="' . $tele . '"'; ?>  >
      <span class="text">Telephone:</span>
      <span class="line"></span>
    </div>
</div>
</div>

       <div class="row100">
	<div class="col">
      <div class="inputBox">
       <input class = "inputvalues" type="text" name="addr" required <?php echo 'value="' . $addr . '"'; ?> >
         <span class="text">Address:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
    <input class = "inputvalues"  type="text" name="uid" required <?php echo 'value="' . $uid . '"'; ?>  >
      <span class="text">NIC:</span>
      <span class="line"></span>
    </div>
</div>
</div> 
</div>

<p>     
          <label for="">&nbsp;</label>
          <button type="submit" name="submit" class="save_button" id = "signup_btn" >Submit</button >
        </p>      

        </form>
 
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