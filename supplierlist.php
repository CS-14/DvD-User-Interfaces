<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    //checking if a user is logged in
  /*  if(!isset($_SESSION['user_id'])){
        header("Location: loginform.php");
    }
    */
    $supplierlist = ' ';
    $search = ' ';
    
    //getting the list of users
    if(isset($_GET['search'])){

        $search = mysqli_real_escape_string($connection,$_GET['search']);
     
        $query ="SELECT S.*, C.* FROM supplier S LEFT OUTER JOIN supplr_category C ON S.SupplierId = C.sup_ID WHERE (FirstName LIKE '%{$search}%' OR LastName LIKE '%{$search}%' OR category LIKE '%{$search}%'   ) AND Is_deleted=0 ORDER BY FirstName";
    }
    else{
        $query ="SELECT * FROM supplier WHERE is_deleted=0 ORDER BY FirstName";
    }
   
    
    $suppliers =mysqli_query($connection,$query);

    if( $suppliers){
        while($supplier = mysqli_fetch_assoc($suppliers)){
            $supplierlist .= "<tr>";
            $supplierlist .= "<td>{$supplier['FirstName']}</td>"; 
            $supplierlist .= "<td>{$supplier['LastName']}</td>";
            $supplierlist .= "<td>{$supplier['Email']}</td>";
            $supplierlist .= "<td>{$supplier['PhoneNo']}</td>"; 
            $supplierlist .= "<td>{$supplier['Address']}</td>";

            $supplierlist .= "<td><a href=\"modifysuplr.php?suplr_id={$supplier['SupplierId']}\">Edit</a></td>" ;
            $supplierlist .= "<td><a href=\"deletesuplr.php?suplr_id={$supplier['SupplierId']}\"onclick =\"return confirm('Are you sure?');\" >Delete</a></td>" ;
        }

    }
    else{
        echo ($query);
    }
?>

<!DOCTYPE html>
<html>  
<head>
    <meta charset ="UTF-8">
    <title>Suppliers </title>
    <link rel ="stylesheet" href ="css/userst.css">
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
        <a href="#" class="logo">Suppliers</a>

        <br >
        <div class ="logedin" style="color: lightseagreen;"> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="owner-view.php">Home</a></li>
            <li><a href="service.php">Services</a></li>

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

 <div class="content">
  <div class="contentBx">

    
    </div>
    </div>
    <div class="content3">
  <div class="contentBx3">  
  
      <form action="supplierlist.php" method="get">
        <div class="container6">
          &ensp;  <h3 class="titleText"><a href="suplrRegForm.php" id="link" class="btn"> +Add New </a> <a href="supplierlist.php" class="btn"> +Refresh </a>
            <div class="row100">
                <div class="col">
                    <div class="inputBox">
                    <input type ="text" name ="search" id="" placeholder="Type Supplier Name  or DVD category you want and Press Enter"   value="<?php echo $search;?>"  style="width :99%;" required  autofocus>
                        <span class="text">Search</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>
    </form>
    
    </div>
    </div>
    
 <div class="content1">
  <div class="contentBx">
    <table class="content-table">
<thead>
<tr>
        <!-- <th>Category</th> -->
        <th>First Name </th>
        <th>Last Name </th>
        <th>Email</th>
        <th>Contact No </th>
        <th>Address</th>
        <th>Edit</th>
        <th>Delete</th>
        

        
    </tr> 
    </thead> 
    <?php echo $supplierlist; ?>
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