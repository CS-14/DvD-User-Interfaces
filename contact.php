<?php

?>
<!DOCTYPE html>
<html>
<head>
<meta name = "viewport" content ="width=device-width,initial-scale=1.0">
<title>Contact Us </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type ="text/css" href = "css/style1.css"><link rel="stylesheet" href="css/dvd.css" ><link rel="stylesheet" href="css/GalleryMainPage.css" >
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<body style ="background-image: url('image/im2.jpg.');">
<header>

    <a href="#" class="logo"><h2>Contact Us</h2></a>
    <div class="toggleMenu" onmouseover="toggleMenu();"></div>
    <ul class="navigation">
        <li><a href="Home.php">Home</a></li>
        <li><a href="service.php" >Services</a></li>
        <li><a href="contact.php" >Contact</a></li>
        <li><a href="loginform.php" >Log-In</a></li>
        <li><a href="registerform.php" >Sign-Up</a></li>
    </ul>

</header>

    <section class ="contact">

        <div class = "container">
            <div class ="ContactInfo">
                <div class ="box">
                    <div class = "icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                    <div class = "text">
                        <h3>Address</h3>
                        <p> DVD House ,No 58 papiliyana road,nugegoda ,Srilanka</p>
                    </div> 
                </div>               
                <div class ="box">
                    <div class ="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div class ="text">
                        <h3>Phone</h3>
                        <p>071 5979070</p>
                        <p>081 3801085</p>
                    </div>
                </div>
                <div class ="box">
                    <div class ="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                    <div class ="text">
                        <h3>Email</h3>
                        <p>Databros@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class ="ContactForm">
                <form>
                <h2>Send Message</h2>
                    <div class ="inputBox">
                        <input type ="text" name =" " required ="required">
                        <span>Full Name</span>
                    </div>
                    <div class ="inputBox">
                        <input type ="text" name =" " required ="required">
                        <span>Email</span>
                    </div>
                    <div class ="inputBox">
                        <textarea required ="required"></textarea>
                        <span>Type Your Message ....</span>
                    </div>
                    <div class ="inputBox">
                    <input type ="submit" name =" " value ="send">  
                    </div>
                <form>   
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