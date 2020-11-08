<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DVD House</title>
<link rel="stylesheet" href="css/homepage.css">

</head>

<body>
<section>
<header>
<a href="#" class="logo">DVD Series</a>
<div class="toggleMenu" onmouseover="toggleMenu();"></div>
 <ul class="navigation">
    <li><a href="loginform.php">Login</a></li>
    <li><a href="registerform.php">Sign-up</a></li>
    <li><a href="#">Gallery</a></li>
    <li><a href="contact.php">Contact Us</a></li>
    </ul>
    </header>
    <div class="content">
   <div class="contentBx">
    <h2 class="titleText"> Feel the Entertainment</br> At Your Doorstep</h2>
    <p class="text">A twisted tale told by Harley Quinn herself, when Gotham's most nefariously narcissistic villain, Roman Sionis, and his zealous right-hand, Zsasz, put a target on a young girl named Cass, the city is turned upside down looking for her. Harley, Huntress, Black Canary and Renee Montoya's paths collide, and the unlikely foursome have no choice but to team up to take Roman down.<br></p>
    <a href="#" class="btn">Popular Movies and Tv Series</a>
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
