<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    //checking if a user is logged in
  /*  if(!isset($_SESSION['user_id'])){
        header("Location: loginform.php");
    }
    */
    $userlist = ' ';
    $search = ' ';



//getting the list of users
if(isset($_GET['search'])){

    $search = mysqli_real_escape_string($connection,$_GET['search']);
    $query ="SELECT * FROM users WHERE (utype LIKE '%{$search}%' OR Email LIKE '%{$search}%') AND is_deleted=0 ORDER BY UserId";
}else{
    $query ="SELECT * FROM users WHERE is_deleted=0 ORDER BY UserId";
}

$users =mysqli_query($connection,$query);
    if( $users){
        while($user = mysqli_fetch_assoc($users)){
            $userlist .= "<tr>";
            $userlist .= "<td>{$user['Email']}</td>";
            $userlist .= "<td>{$user['utype']}</td>"; 
            $userlist .= "<td>{$user['last_login']}</td>"; 
            $userlist .= "<td><a href=\"modifyuser.php?user_id={$user['UserId']}\">Edit</a></td>" ;    
            $userlist .= "<td><a href=\"delete-user.php?user_id={$user['UserId']}\">Delete</a></td>" ;    
        }

    }else{
        echo "Database query failed";
    }
?>

<!DOCTYPE html>
<html>  
<head>
    <meta charset ="UTF-8">
    <title>Users </title>
    <link rel ="stylesheet" href = "css/users.css">
    <link rel ="stylesheet" href = "css/uV_nav.css">
     <link rel ="stylesheet" href = "css/uV_sec.css">
     <link rel ="stylesheet" href = "css/uV_sec2.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin1.css">
    <link rel="stylesheet" href="css/admin1_chart.css">
    <link rel="stylesheet" href="css/admin1_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>



<section class="banner2">


    <header>
        <a href="#" class="logo">Users</a>

        <br >
        <div class ="logedin""> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="adminview.php">Home</a></li>
            <li><a href="profile.php?">Profile</a></li>
            <li><a href="adminview.php">Back</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="#"></a></li><li>

        </ul>
    </header>


    <div class="navigation2">
        <ul>
            <li>
                <a href="#">
                    <span class="icon1"><i class="#"" aria-hidden="true"></i></span>
                    <span class="title1"></span></a></li>

            <li>
                <a href="usv.php">
                    <span class="icon1"><i class="fa fa-users"" aria-hidden="true"></i></span>
                    <span class="title1">Users</span></a></li>



            <li>
            <li>
                <a href="adminorders-view.php">
                    <span class="icon1"><i class="fa fa-first-order" aria-hidden="true"></i></span>
                    <span class="title1">orders</span></a></li>
            <li>
                <a href="adminlending-view.php">
                    <span class="icon1"><i class="fa fa-first-order" aria-hidden="true"></i></span>
                    <span class="title1">Lendings</span></a></li>

            <li>
                <a href="#">
                    <span class="icon1"><i class="fa fa-film" aria-hidden="true"></i></span>
                    <span class="title1">Movies</span></a></li>


            <li>
                <a href="#">
                    <span class="icon1"><i class="fa fa-anchor" aria-hidden="true"></i></span>
                    <span class="title1">Categories</span></a></li>


            <li>
                <a href="#">
                    <span class="icon1"><i class="fa fa-comments" aria-hidden="true"></i></span>
                    <span class="title1">Messages</span></a></li>

        </ul>
    </div>
    
  <div class="content3">
  <div class="contentBx3">  
  
       <form action="usv.php" method="get">
        <div class="container6">
            &ensp;  <h3 class="titleText"><a href="usv.php" class="btn"> Refresh </a> | <a href="usv.php?search=customer" class="btn" style="background-color:lightseagreen;"> Customers </a> | <a href="usv.php?search=admin" class="btn" style="background-color:lightseagreen;"> Admin </a> | <a href="usv.php?search=owner" class="btn" style="background-color:lightseagreen;"> owner</a>|| <a href="usv.php?search=cashier" class="btn" style="background-color:lightseagreen;"> cashier</a>|<a href="adduser.php" class="btn">Add User </a> </h3>
                        <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <input type="text" name="search" placeholder="Type RefNo User Type   and Press Enter" id="" required value=" <?php echo $search;?>" >
                        <span class="text">Search</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>
    
    </div>
    </div>

    
     <div class="content1">
  <div class="contentBx">
    <table class="content-table">
<thead>
<tr>
       <th>User Email </th>
        <th>User Type</th>
        <th>Last Login </th>
        <th>Edit</th>
        <th>Delete</th>
  </tr>
  </thead>
   <?php echo $userlist; ?>
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