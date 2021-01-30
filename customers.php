<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    //checking if a user is logged in
   /* if(!isset($_SESSION['user_id'])){
        header("Location: loginform.php");
    }
    */
    $userlist = ' ';

    //getting the list of users
    $query ="SELECT * FROM users WHERE utype ='customer' ORDER BY UserId";
    $users =mysqli_query($connection,$query);

    if( $users){
        while($user = mysqli_fetch_assoc($users)){
            $userlist .= "<tr>";
            $userlist .= "<td>{$user['UserName']}</td>";
            $userlist .= "<td>{$user['utype']}</td>"; 
            $userlist .= "<td><a href=\"modify-user.php?user-id={$user['UserId']}\">Edit</a></td>" ;    
            $userlist .= "<td><a href=\"delete-user.php?user-id={$user['UserId']}\">Delete</a></td>" ;    
        }

    }else{
        echo "Database query failed";
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset ="UTF-8">
<title>Customers</title>
<link rel ="stylesheet" href ="css/users.css">
<link rel ="stylesheet" href ="css/custom_nav.css">
<link rel ="stylesheet" href ="css/custom_sec.css">

 <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
 
</head>
<body>

<section class="banner2">

    <header>
        <a href="#" class="logo">Customers</a>

        <br >
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="Home.php">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="adminview.php">Back</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="#"></a></li>

        </ul>
    </header>

    <div class="content">
  <div class="contentBx">

    </div>
    </div>
    
     <div class="content">
  <div class="contentBx">
    <table class="content-table">
<thead>
<tr>
        <th>User Name </th>
        <th>User Type</th>
        <th>Edit</th>
        <th>Delete</th>
  </tr>
  </thead> 
   <h4 class="titleText1">
    <?php echo $userlist; ?></h4>
     </table> 
     
     </div>
     </div>
</section>

 <section class="footgal">


     <ul class="sci">
     <li><a href="#"><img src="image/facebook.png"></a></li>
     <li><a href="#"><img src="image/instagram.png"></a></li>
     <li><a href="#"><img src="image/twitter.png"></a></li>
     </ul>
   
   <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>
    </section>



</body>
</html>