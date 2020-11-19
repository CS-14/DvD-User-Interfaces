<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    //checking if a user is logged in
  /*  if(!isset($_SESSION['user_id'])){
        header("Location: loginform.php");
    }
    */
    $userlist = ' ';

    //getting the list of users
    $query ="SELECT * FROM users ORDER BY UserId";
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

  <div class="content">
  <div class="contentBx">

    <h3 class="titleText"> Users <a href="adduser.php" class="btn"> + Add New User </a> &ensp;<a href="addcustomer.php" class="btn"> + Add New  Customer </a></h3>
    </div>
    </div>
    
     <div class="content">
  <div class="contentBx">
    <table class="content-table">
<thead>
<tr>
       <th>User Name </th>
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


	<div class="testimonials">
    <div class="swiper-container">
    <div class="swiper-wrapper">
    
<div class="swiper-slide">
  <div class="card5">
    <div class="layer"></div>
      <div class="content5">
      <p>Assemble a team of the world's most dangerous, incarcerated Super Villains, provide them with the most powerful arsenal at the government's disposal, and send them off on a mission to defeat an enigmatic, insuperable entity. </p>
      <div class="imgBx5">
      <img src="image/Aquaman.jpg">
      </div>
      
      <div class="details">
      <h2>Suicide Squad <br><span>Action</span></h2>
      		</div>
      	</div>
      </div>
   </div>
      
<div class="swiper-slide">
  <div class="card5">
    <div class="layer"></div>
      <div class="content5">
      <p>Assemble a team of the world's most dangerous, incarcerated Super Villains, provide them with the most powerful arsenal at the government's disposal, and send them off on a mission to defeat an enigmatic, insuperable entity. </p>
      <div class="imgBx5">
      <img src="image/bat.jpg">
      </div>
      <div class="details">
      <h2>Suicide Squad <br><span>Action</span></h2>
      </div>
      </div>
      </div>
      </div>
      
      
      <div class="swiper-slide">
      <div class="card5">
       <div class="layer"></div>
      <div class="content5">
      <p>Assemble a team of the world's most dangerous, incarcerated Super Villains, provide them with the most powerful arsenal at the government's disposal, and send them off on a mission to defeat an enigmatic, insuperable entity. </p>
      <div class="imgBx5">
      <img src="image/JLA5.jpg">
      </div>
      <div class="details">
      <h2>Suicide Squad <br><span>Action</span></h2>
      </div>
      </div>
      </div>
      </div>
      
      <div class="swiper-slide">
      <div class="card5">
       <div class="layer"></div>
      <div class="content5">
      <p>Assemble a team of the world's most dangerous, incarcerated Super Villains, provide them with the most powerful arsenal at the government's disposal, and send them off on a mission to defeat an enigmatic, insuperable entity. </p>
      <div class="imgBx5">
      <img src="Joker/bat.jpg">
      </div>
      <div class="details">
      <h2>Suicide Squad <br><span>Action</span></h2>
      </div>
      </div>
      </div>
      </div>
      
      </div>
      </div>
    
    </div>
    
     <ul class="sci">
     <li><a href="#"><img src="image/facebook.png"></a></li>
     <li><a href="#"><img src="image/instagram.png"></a></li>
     <li><a href="#"><img src="image/twitter.png"></a></li>
     </ul>
   
   <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>
    </section>

<script type="text/javascript"> 
    function toggleMenu()
    {
    const toggleMenu = document.querySelector('.toggleMenu');
	const navigation = document.querySelector('.navigation');
    toggleMenu.classList.toggle('active');
	navigation.classList.toggle('active');
    }
    </script>
    
    
     <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script>
	  var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 0,
        modifier: 1,
        slideShadows: true,
      },
	  
      loop:true, 
    });
	</script>

</body>

</html>