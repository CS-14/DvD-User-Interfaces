<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php
$user_id = $_SESSION['user_id'];
$User_Type = $_SESSION['user_type'] ;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DVD House </title>

    <link rel="stylesheet" href="css/UiCashier_Service.css">
    <link rel="stylesheet" href="css/UiCashier_Container.css">
    <link rel="stylesheet" href="css/UiCashier_Gallery.css">
    <link rel="stylesheet" href="css/UiCashier_ServiveCard.css">
    <link rel="stylesheet" href="css/UiCashier_HoverGal.css">

</head>

<body>
<section>
<header>
    <a href="#" class="logo">DVD<span>House</span></a>
    <br >
       <div class ="logedin" style="color: lightseagreen;"> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

    <div class="toggle"></div>
    <div class="toggleMenu" onmouseover="toggleMenu();"></div>
    <ul class="navigation">

        <li><a href="customer-view.php" >Home</a></li>
        <li><a href="MovieView1.html" >Movies</a></li>
        <li><a href="TvSeriesView.html">TVSeries</a> </li>
        <li><a href="ShopMain.html">Cart</a> </li>
        <li><a href="edit_profile.php?user_id=<?php echo $user_id;?>">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

</header>


<section class= "about" id="about">
    <div class="contentBx1">
        <h2 class="titleText1"> Feel the Entertainment At Your Doorstep</h2>
        <p class="text1">Diana, princess of the Amazons, trained to be an unconquerable warrior. Raised on a sheltered island paradise, when a pilot crashes on their shores and tells of a massive conflict raging in the outside world, Diana leaves her home, convinced she can stop the threat. Fighting alongside man in a war to end all wars, Diana will discover her full powers and her true destiny.<br> Written by ahmetkozan</p>
        <a href="MovieView1.html" class="btn"> Movies and Tv Series</a>
    </div>
    <div class="videoBx">
        <video src="image/WonderWoman1984.mp4" muted autoplay="autoplay" loop="loop" type="mp4"></video>
    </div>
</section>



<section class="banner2">


    <img src="User1/banner2.jpg" class="fitBg">
    <div class="box">
        <span style="--i:1;"><img src="image/JLA.jpg"></span>
        <span style="--i:2;"><img src="image/JLA2.jpg"></span>
        <span style="--i:3;"><img src="image/JLA3.jpg"></span>
        <span style="--i:4;"><img src="image/JLA4.jpg"></span>
        <span style="--i:5;"><img src="image/JLA5.jpg"></span>
        <span style="--i:6;"><img src="image/JLA6.jpg"></span>
        <span style="--i:7;"><img src="image/JLA7.jpg"></span>
        <span style="--i:8;"><img src="image/JLA8.jpg"></span>
    </div>

    <div class="contentBx">
        <h2 class="titleText"> Feel the Entertainment At Your Doorstep</h2>
        <p class="text">Diana, princess of the Amazons, trained to be an unconquerable warrior. Raised on a sheltered island paradise, when a pilot crashes on their shores and tells of a massive conflict raging in the outside world, Diana leaves her home, convinced she can stop the threat. Fighting alongside man in a war to end all wars, Diana will discover her full powers and her true destiny.<br> Written by ahmetkozan</p>
        <a href="MovieView1.html" class="btn"> Movies and Tv Series</a>
    </div>
</section>


<section class= "about" id="about">
    <div class="contentBx1">
        <h2 class="titleText1"> Feel the Entertainment At Your Doorstep</h2>
        <p class="text1">Diana, princess of the Amazons, trained to be an unconquerable warrior. Raised on a sheltered island paradise, when a pilot crashes on their shores and tells of a massive conflict raging in the outside world, Diana leaves her home, convinced she can stop the threat. Fighting alongside man in a war to end all wars, Diana will discover her full powers and her true destiny.<br> Written by ahmetkozan</p>
        <a href="MovieView1.html" class="btn"> Movies and Tv Series</a>
    </div>

    <div class="videoBx">
        <video src="image/RAYA.mp4" muted autoplay="autoplay" loop="loop" type="mp4"></video>
    </div>

</section>


<section class="banner3">
    <video src="Harley Quinn.mp4" autoplay="autoplay" muted loop="loop"></video>
    <div class="contentBx3">
        <h2 class="titleText3"> Feel the Entertainment At Your Doorstep</h2>
        <p class="text3">Diana, princess of the Amazons, trained to be an unconquerable warrior. Raised on a sheltered island paradise, when a pilot crashes on their shores and tells of a massive conflict raging in the outside world, Diana leaves her home, convinced she can stop the threat. Fighting alongside man in a war to end all wars, Diana will discover her full powers and her true destiny.<br> Written by ahmetkozan</p>
        <a href="MovieView1.html" class="btn"> Movies and Tv Series</a>
    </div>


    <div class="box4">
        <div class="imgBx4">
            <img src="image/batman.jpg">
        </div>

        <div class="content4">
            <h2>Batman Asylum<br><span>Creative Animation</span></h2>
        </div>

    </div>

    <div class="box4">
        <div class="imgBx4">
            <img src="image/batman.jpg">
        </div>

        <div class="content4">
            <h2>Batman Asylum<br><span>Creative Animation</span></h2>
        </div>

    </div>

    <div class="box4">
        <div class="imgBx4">
            <img src="image/batman.jpg">
        </div>

        <div class="content4">
            <h2>Batman Asylum<br><span>Creative Animation</span></h2>
        </div>

    </div>
</section>

<section class="gal">

    <div class="container">
        <div class="clip clip1">
            <div class="content1">
                <h2>Justice League Dark Apoklipse War</h2>
                <p>A poorly executed attack on Apokolips results in the deaths of many of DC's heroes and Darkseid successfully conquering the earth. Now the remaining heroes must regroup </p>

            </div>
        </div>

        <div class="clip clip2">
            <div class="content1">
                <h2>Guardiance of Galaxies</h2>
                <p>After stealing a mysterious orb in the far reaches of outer space, Peter Quill from Earth is now the main target of a manhunt led by the villain known as Ronan the Accuser. To help fight Ronan and his team and save the galaxy from his power, Quill creates a team of space heroes known as the "Guardians of the Galaxy" to save the galaxy.</p>
            </div>
        </div>

        <div class="clip clip3">
            <div class="content1">
                <h2>Justice League Doom</h2>
                <p>The Justice League are a team of great power, but also of personal secrets they thought safe. That changes when the immortal supervillain, Vandal Savage, has Batman's Batcave secretly raided to learn them all and more. Soon, the Leaguers are individually beset by their enemies who attack them with inescapable death traps specifically designed with that information.  </p>
            </div>
        </div>

        <div class="clip clip4">
            <div class="content1">
                <h2>Jumanji</h2>
                <p>In Jumanji: The Next Level, the gang is back but the game has changed. As they return to rescue one of their own, the players will have to brave parts unknown from arid deserts to snowy mountains, to escape the world's most dangerous game.</p>
            </div>
        </div>
    </div>

    <div class="contentBx4">
        <h2 class="titleText4"> Feel the Entertainment At Your Doorstep</h2>
        <p class="text4">Diana, princess of the Amazons, trained to be an unconquerable warrior. Raised on a sheltered island paradise, when a pilot crashes on their shores and tells of a massive conflict raging in the outside world, Diana leaves her home, convinced she can stop the threat. Fighting alongside man in a war to end all wars, Diana will discover her full powers and her true destiny.<br> Written by ahmetkozan</p>
        <a href="MovieView1.html" class="btn"> Movies and Tv Series</a>
    </div>

</section>


<section class="footer">
    <ul class="sci">
        <li><a href="#"><img src="image/facebook.png"></a></li>
        <li><a href="#"><img src="image/instagram.png"></a></li>
        <li><a href="#"><img src="image/twitter.png"></a></li>
    </ul>

    <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>
</section>

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
