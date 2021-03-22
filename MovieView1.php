<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<title>MovieView</title>
	<link rel="stylesheet" href="css/MovieView1.css">
	<link rel="stylesheet" href="css/MovieVideoGal.css">
	<link rel="stylesheet" href="css/MovieFooter.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<header>
    <a href="#" class="logo">DVD<span>Movies</span></a>

    <div class="toggle"></div>
    <div class="toggleMenu" onmouseover="toggleMenu();"></div>

    <ul class="navigation">
        <li><a href="customer-view.php" >Home</a></li>
        <li><a href="MovieView1.php">Movies</a></li>
        <li><a href="TvSeriesView.html">TV-Series</a> </li>
        <li><a href="ShopMain.html">Cart</a> </li>
        <li><a href="logout.php">Logout</a></li>


    </ul>

</header>




<section class="cate">


    <div class="contentBx3">
        <h2 class="titleText3"> There Are Rich Flavours Of Categories at Your Grasp</h2>
    </div>

    <div class="toggle2"></div>
    <div class="toggleMenu2" onmouseover="toggleMenu2();"></div>
    <ul class="navigation2">

        <li class="list active" data-filter="Categories">Categories</li>
        <li class="list" data-filter="9" >Thriller</li>
        <li class="list" data-filter="8" >Romance</li>
        <li class="list" data-filter="1"">Adeventure</li>
        <li class="list" data-filter="3" >Comedy</li>


    </ul>
    <div class="product">
    <?php


    $DName = '';
    $trailer = '';
    $Price = '';
    $description = '';
    $CategoryId = '';
    $Quantity = '';
    $Category='';
    $DVDId ='';

    $query ="SELECT DVD_Id,DName,trailer,Price,description,CategoryId FROM dvd WHERE is_Movie=1 AND Quantity>5 ORDER BY DVD_Id";
    $Movies =mysqli_query($connection,$query);

if($Movies) {
    while ($Movie = mysqli_fetch_assoc($Movies)) {
        $DVDId =$Movie['DVD_Id'];
        $DName =  $Movie['DName'];
        $trailer =  $Movie['trailer'];
        $Price =  $Movie['Price'];
        $description = $Movie['description'];
        $CategoryId = $Movie['CategoryId'];




?>


        <div class="itembox <?php echo($CategoryId);?>"><img src="image/Movies/<?php echo($DName);?>.jpg">

            <div class="contentBx5">
                <div>
                    <form method="post" action="MovieView1.php?action=add&id=<?php echo $DName; ?>">
                    <h2><?php echo($DName);?></h2>
                    <p><?php echo ($description);?></p>
                    <a href="<?php echo($trailer);?>" class="btn">Expolre More <span class="icon"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></span></a>
                    <a href="BeautyCard.html" class="btn"> Add Cart </a>

                </div>

            </div>

        </div>

        <?php
        }
        }
        ?>
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
          <span>No 89/A Walawwatta Road<br>Papiliyana<br/>Sri Lanka
          </span>
                </li> <br >

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
        </div>

    </div>

    <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>

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

<script type="application/javascript">
    function videoUrl(hmm){
        document.getElementById("slider").src = hmm;
    }

</script>

<script
        src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous">
</script>

<script type="text/javascript">

    $(document).ready(function() {
        $('.list').click(function () {

            const value = $(this).attr('data-filter');
            if (value == 'Categories')
            {
                $('.itembox').show('1000');

            }

            else{

                $('.itembox').not('.'+value).hide('1000');
                $('.itembox').filter('.'+value).show('1000');
            }

        });


        $('.list').click(function(){
            $(this).addClass('active').siblings().removeClass('active');}
        )

    });
</script>



<script type="text/javascript">
    function toggleMenu2()
    {
        var toggleMenu2 = document.querySelector('.toggleMenu2');
        var navigation2 = document.querySelector('.navigation2');
        toggleMenu2.classList.toggle('active');
        navigation2.classList.toggle('active');
    }
</script>

</body>

</html>