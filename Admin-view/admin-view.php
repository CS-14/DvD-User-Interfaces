<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/admin_nav.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">



</head>

<body>
<section>
    <header>
        <a href="#" class="logo">DVD Series</a>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">
            <li><a href="Index.php">Home</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
        <br >
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> !  <a href="logout.php" class="btn1">LogOut</a></div>
    </header>
    
     <div class="navigation2">
 <ul>
 <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-home" aria-hidden="true"></i></span>
    <span class="title1">Home</span></a></li>
    
    <li>
    <a href="#">
    <span class="icon1"></span>
    <span class="title1"><h3>Category</h3></span></a></li>
    
   <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-automobile" aria-hidden="true"></i></span>
    <span class="title1">Action</span></a></li>
    
    <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-anchor" aria-hidden="true"></i></span>
    <span class="title1">Adventure</span></a></li>
    
    
   <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
    <span class="title1">Mystery</span></a></li>
    
    
   <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
    <span class="title1">Romance</span></a></li>
    
    </ul>
   </div>
   
    <div class="content">
        <div class="contentBx">
            <h2 class="titleText"> Feel the Entertainment</br> At Your Doorstep</h2>
            <p class="text">A twisted tale told by Harley Quinn herself, when Gotham's most nefariously narcissistic villain, Roman Sionis, and his zealous right-hand, Zsasz, put a target on a young girl named Cass, the city is turned upside down looking for her. Harley, Huntress, Black Canary and Renee Montoya's paths collide, and the unlikely foursome have no choice but to team up to take Roman down.<br></p>
            <a href="#" class="btn">Popular Movies and Tv Series</a>
        </div>
    </div>
    
    <div class="player">
	<div class="imgBx2">
    <img src="image/im2.png">
    </div>
    <audio controls>
    <source src="audio/Saweetie - Tap In.mp3" type="audio/mp3">
    </audio>
</div>
</div>
    

    <ul class="sci">
        <li><a href="#"><img src="image/facebook.png"></a></li>
        <li><a href="#"><img src="image/instagram.png"></a></li>
        <li><a href="#"><img src="image/twitter.png"></a></li>
    </ul>
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


</body>
</html>
