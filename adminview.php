<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin1.css">
    <link rel="stylesheet" href="css/admin1_chart.css">
    <link rel="stylesheet" href="css/admin1_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>

<body>
<section>
    <header>
        <a href="#" class="logo">ADMIN</a>

        <br >
        <div class ="logedin""> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="Home.php">Home</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
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


    <div class="content">
        <div class="contentBx">

            <img src="image/Pie-Charts.jpg">
        </div>
    </div>
    <div class="content">
        <div class="contentBx">

            <img class="image2" src="image/Pie-Charts.jpg">
        </div>
    </div>




    <ul class="sci">
        <li><a href="#"><img src="image/facebook.png"></a></li>
        <li><a href="#"><img src="image/instagram.png"></a></li>
        <li><a href="#"><img src="image/twitter.png"></a></li>
    </ul>
</section>


</body>
</html>