<?php session_start(); ?>
<?php
require_once('inc/connection.php');
 ?>



<!DOCTYPE html>
<html>
<head>  

<meta charset ="UTF-8">
<title>Add New Movie </title>
    <title>Modify User </title>
    <link rel ="stylesheet" href ="css/users.css">
    <link rel ="stylesheet" href ="css/modify_nav.css">
    <link rel ="stylesheet" href ="css/modify_form.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">

 
</head>

<body>


<section class="banner2">

    <header>
        <a href="#" class="logo"> Add Movie</a>

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
    
     <form action ="movieform.php"  method ="post" >
          
<div class="container6">
        
        <div class="row100">


<div class="col">
      <div class="inputBox">
    <input type="text" name="name" required >
      <span class="text">Movie Name:</span>
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
</div>
    <div class="row100">
        <div class="col">
            <div class="inputBox">
                <span class="text">Upload Image***: </span><br>
                &nbsp; &nbsp; &nbsp;<p>Note: JPEG files less than 2.5Mb only.</p><br>
                <input type="file" name="image"  required ><br>
            </div>
<br>

            <div class="row100">
                <div class="col">
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="submit"  name="upload" value="Upload">
                </div>
            </div>

        <div class="row100">
            <div class="col">
                <input type="submit"  name="submit" value="Save">
            </div>
        </div>

</form>

  </div>
  
</section>
  

    
</body>
</html>