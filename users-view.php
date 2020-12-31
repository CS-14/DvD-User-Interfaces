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
    $query ="SELECT * FROM users WHERE (utype LIKE '%{$search}%' OR UserName LIKE '%{$search}%') AND is_deleted=0 ORDER BY UserId";
}
else{
    $query ="SELECT * FROM users WHERE is_deleted=0 ORDER BY UserId";
}


$users =mysqli_query($connection,$query);
    if( $users){
        while($user = mysqli_fetch_assoc($users)){
            $userlist .= "<tr>";
            $userlist .= "<td>{$user['UserName']}</td>";
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
    <link rel ="stylesheet" href = "css/usersV_nav.css">
     <link rel ="stylesheet" href = "css/usersV_sec.css">
      <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    
</head>
<body>



<section class="banner2">

    <header>
        <a href="#" class="logo">Users</a>

        <br >
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="Home.php">Home</a></li>
            <li><a href="adduser.php">AddUser</a></li>
            <li><a href="addcustomer.php">AddCustomer</a></li>
            <li><a href="profile.php?">Profile</a></li>
            <li><a href="adminview.php">Back</a></li>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="#"></a></li><li>

        </ul>
    </header>

    <form action="users-view.php" method="get">
        <div class="container6">
            &ensp; <h1><a href="users-view.php">  Refresh </a> </h1>
            <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <input type="text" name="search" placeholder="Type User Name or Date  or RefNo and Press Enter" id="" required value=" <?php echo $search;?>" >
                        <span class="text">Search</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>

    </form>
    <form action="usv.php" method="get">
        <div class="container6">
            &ensp;  <h3 class="titleText"><a href="users-view.php" class="btn"> Refresh </a> </h3>
            <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <input type="text" name="search" id="" required value="  <?php echo $search;?>" >
                        <span class="text">Search</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>
    </form>


     <div class="content">
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