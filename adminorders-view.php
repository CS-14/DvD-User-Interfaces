<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
//checking if a user is logged in
/*  if(!isset($_SESSION['user_id'])){
      header("Location: loginform.php");
  }
  */
$orderlist = ' ';
$search = ' ';

//getting the list of orders
if(isset($_GET['search'])){

    $search = mysqli_real_escape_string($connection,$_GET['search']);
    $query ="SELECT * FROM orderstable WHERE UserName LIKE '%{$search}%'  OR RefNo LIKE '%{$search}%' AND is_deleted=0 ORDER BY RefNo";

}
else{

    $query ="SELECT * FROM orderstable WHERE (is_deleted=0 AND Confirmation=0) ORDER BY RefNo";

}
    $orders =mysqli_query($connection,$query);


if( $orders){
    while($order = mysqli_fetch_assoc($orders)){
        $orderlist .= "<tr>";
        $orderlist .= "<td>{$order['RefNo']}</td>";
        $orderlist .= "<td>{$order['Customer_email']}</td>";
        $orderlist .= "<td>{$order['Payment_method']}</td>";
        $orderlist .= "<td>{$order['TotalCost']}</td>";
        $orderlist .= "<td>{$order['ODate']}</td>";
        $orderlist .= "<td><a href=\"adminconfirm_orders.php?RefNo={$order['RefNo']}\">confirm</a></td>" ;
        $orderlist .= "<td><a href=\"delete-order.php?RefNo={$order['RefNo']}\" onclick =\"return confirm('Are you sure?');\">Delete</a></td>" ;
    }

}else{
    echo "Database query failed";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset ="UTF-8">
    <title>Orders </title>
    <link rel ="stylesheet" href ="css/users.css">
    <link rel ="stylesheet" href ="css/orders_nav.css">
    <link rel ="stylesheet" href ="css/orders_sec.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="css/admin1.css">
    <link rel="stylesheet" href="css/admin1_chart.css">
    <link rel="stylesheet" href="css/admin1_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>
<body>
<section class="banner2">

    <header>
        <a href="#" class="logo">Orders</a>

        <br >
        <div class ="logedin""> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="Home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="adminview.php">Back</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="adminorders-view.php">Refresh</a></li>
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

    <form action="adminorders-view.php" method="get">
        <div class="container6">
             <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <input type="text" name="search" placeholder="Type User Name or RefNo and Press Enter" id="" required value=" <?php echo $search;?>" >
                        <span class="text">Search </span>
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
                    <th>Reference No </th>
                    <th> Customer Email</th>
                    <th> Payment method</th>
                    <th> Total Cost</th>
                    <th> Ordered Date</th>
                    <th>Confirmation</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <?php echo $orderlist; ?>
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