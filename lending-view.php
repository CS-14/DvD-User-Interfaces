<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
//checking if a user is logged in
/*  if(!isset($_SESSION['user_id'])){
      header("Location: loginform.php");
  }
  */
$lendinglist = ' ';
$search = ' ';

//getting the list of users
if(isset($_GET['search'])){

    $search = mysqli_real_escape_string($connection,$_GET['search']);
    $query ="SELECT * FROM lend WHERE Customer_email LIKE '%{$search}%'  AND Returned=0 ORDER BY RefNo";
}else{
    $query ="SELECT * FROM lend WHERE Returned=0  ORDER BY LendNo";
}


$lendings =mysqli_query($connection,$query);

if($lendings){
    while($lending = mysqli_fetch_assoc($lendings)){
        $lendinglist .= "<tr>";
        $lendinglist .= "<td>{$lending['Customer_email']}</td>";
        $lendinglist .= "<td>{$lending['ODescription']}</td>";
        $lendinglist .= "<td>{$lending['IssueDate']}</td>";
        $lendinglist .= "<td>{$lending['ReturnDate']}</td>";
        $lendinglist .= "<td>{$lending['Total_Cost']}</td>";


    }

}else{
    echo "Database query failed";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset ="UTF-8">
    <title>Confirmed Lendings</title>
    <link rel ="stylesheet" href ="css/users.css">
    <link rel ="stylesheet" href ="css/orders_nav.css">
    <link rel ="stylesheet" href ="css/orders_sec.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="css/cashier.css">
    <link rel="stylesheet" href="css/cashier_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>
<section class="banner2">

    <header>
        <a href="#" class="logo"> lendings</a>

        <br >
        <div class ="logedin""> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="cashier-view.php">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="cashier-view.php">Back</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="lending-view.php">Refresh</a></li>
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
                <a href="orders-view.php">
                    <span class="icon1"><i class="fa fa-first-order" aria-hidden="true"></i></span>
                    <span class="title1">Online orders</span></a></li>

            <li>
                <a href="purchases.php">
                    <span class="icon1"><i class="fa fa-first-order" aria-hidden="true"></i></span>
                    <span class="title1">Purchases</span></a></li>


            <li>
                <a href="lending-view.php">
                    <span class="icon1"><i class="fa fa-first-order" aria-hidden="true"></i></span>
                    <span class="title1">Lendings</span></a></li>

            <li>
                <a href="#">
                    <span class="icon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                    <span class="title1">Mails</span></a></li>



        </ul>
    </div>
    <form action="lending-view.php" method="get">
        <div class="container6">

            <div class="row100">
                <div class="col">
                    <div class="inputBox">

                        <input type="text" name="search" placeholder= "Type User Name or Date  or RefNo and Press Enter" id="" required value=" <?php echo $search;?>" >
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
                <th>Customer Email</th>
                <th>Description </th>
                <th> Ordered Date</th>
                <th> return Date</th>
                <th> Total Cost</th>
                <!Returned)>
              </tr>

                </thead>
        <?php echo $lendinglist; ?>
    </table>
        </div>
    </div>

</section>
<footer>
    <section class="footgal">


        <ul class="sci">
            <li><a href="#"><img src="image/facebook.png"></a></li>
            <li><a href="#"><img src="image/instagram.png"></a></li>
            <li><a href="#"><img src="image/twitter.png"></a></li>
        </ul>

        <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>
    </section>
</footer>


</body>

</html>