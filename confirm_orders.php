<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php

$errors = array();
$RefNo = '';
$Order_date ='';


$cost ='';
$pay_method ='';
$Email ='';
$CusId='';
$IssueDate ='';

if (isset($_GET['RefNo'])) {
    // getting the user information
    $RefNo = mysqli_real_escape_string($connection, $_GET['RefNo']);
    $query = "SELECT * FROM Orderstable WHERE RefNo = {$RefNo} LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            // order found
            $result = mysqli_fetch_assoc($result_set);
            $Order_date = $result['ODate'];
            $cost = $result['TotalCost'];
            $CusId = $result['CustomerId'];

            $pay_method = $result['Payment_method'];
            $Email = $result['Customer_email'];


        }

        else {
            // user not found
            header('Location: orders-view.php?err=user_not_found');
        }
    } else {
        // query unsuccessful
        header('Location: orders-view .php?err=query_failed');
    }

}
if(isset($_POST['submit']))
{

    $RefNo =$_POST['RefNo'];
    $pay_method =$_POST['Payment_method'];
    $Order_date =$_POST['Order_date'];

    $cost =$_POST['cost'];
    $Email =$_POST['Email'];
    $CusId=$_POST['CusId'];


    //modify orders table

    $query2 = "Update orderstable SET Confirmation = 1 WHERE RefNo='{$RefNo}'";
    $result = mysqli_query($connection , $query2);


    if ($result){
        if($pay_method == 'lending'){

            $od =strtotime($Order_date);
            $ReturnDate = date('Y.m.d', strtotime('+1 week'));

            $query3 = "INSERT INTO lend(LendNo,IssueDate,ReturnDate,Total_Cost,Customer_email,CustomerId,Confirmation)
              VALUES('{$RefNo}','{$Order_date}','{$ReturnDate}',{$cost},'{$Email}','{$CusId}',1)";
            $result1 = mysqli_query($connection , $query3);

            if( $result1){

                header('Location:orders-view.php ? order_confirmed=true');
            }

        }else {

            header('Location:cashier-view.php ? order_confirmed=failed');
        }
    }
    else{

        $errors[]='Failed to modify data!';
    }

}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset ="UTF-8">
    <title>Confirm Order </title>
    <link rel ="stylesheet" href ="css/users.css">
    <link rel ="stylesheet" href ="css/conOrders_nav.css">
    <link rel ="stylesheet" href ="css/conOrders_sec.css">
    <link rel ="stylesheet" href ="css/conOrders_form.css">
    <link rel ="stylesheet" href ="css/conOrders_sec2.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="css/cashier.css">
    <link rel="stylesheet" href="css/cashier_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>
<section class="banner3">

    <header>
        <a href="#" class="logo">Confirm Orders</a>
        <br >
        <div class ="logedin" style="color: lightseagreen;"> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="cashier-view.php">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="orders-view.php">Back</a></li>
            <li><a href="logout.php">Logout</a></li>
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
    <?php

    if(!(empty ($errors))){
        display_errors($errors);
    }
    ?>

    <form action ="confirm_orders.php" method ="post">


        <div class="container6">
            <input type ="hidden" name="RefNo"  value="<?php echo $RefNo ;?>">
            <input type ="hidden" name="Payment_method"  value="<?php echo $pay_method ;?>">
            <input type ="hidden" name="RefNo"  value="<?php echo $RefNo ;?>">
            <input type ="hidden" name="Payment_method"  value="<?php echo $pay_method ;?>">
            <input type ="hidden" name="Order_date"  value="<?php echo $Order_date;?>">

            <input type ="hidden" name="CusId"  value="<?php echo $CusId ;?>">
            <input type ="hidden" name="Payment_method"  value="<?php echo $pay_method ;?>">

            <input type ="hidden" name="cost"  value="<?php echo $cost;?>">
            <input type ="hidden" name="Email"  value="<?php echo $Email ;?>">
        </div>


        <div class="content">
            <div class="contentBx">

                <div class="container6">

                    <div class="row100">
                        <div class="col">
                            <div class="inputBox">
                                <input type="text" name="RefNo" required <?php echo 'value ="'.$RefNo.'"';?>>
                                <span class="text">Referance No:</span>
                                <span class="line"></span>
                            </div>
                        </div>

                        <div class="col">
                            <div class="inputBox">
                                <input type = "date" name = "Order_date"<?php echo 'value ="'.$Order_date.'"';?>>
                                <span class="text">Payment Method:</span>
                                <span class="line"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row100">


                        <div class="col">
                            <div class="inputBox">
                                <input type = "text" name ="CusId" required <?php echo 'value ="'.$CusId.'"';?>>
                                <span class="text">Customer ID :</span>
                                <span class="line"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row100">



                        <div class="col">
                            <div class="inputBox">
                                <input type = "text" name = "cost" required <?php echo 'value ="'.$cost.'"';?>>
                                <span class="text">Cost :</span>
                                <span class="line"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row100">
                        <div class="col">
                            <div class="inputBox">
                                <input type = "text" name = "Payment_method" required <?php echo 'value ="'.$pay_method.'"';?>>
                                <span class="text">Payment Method: </span>
                                <span class="line"></span>
                            </div>
                        </div>


                        <div class="col">
                            <div class="inputBox">
                                <input type = "email" name = "Email" required <?php echo 'value ="'.$Email.'"';?>>
                                <span class="text">Customer Email :</span>
                                <span class="line"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row100">
                        <div class="col">
                            <input type="submit" name="submit" value="Confirm Me">
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </form>
    <section class="footgal">
        <ul class="sci">
            <li><a href="#"><img src="image/facebook.png"></a></li>
            <li><a href="#"><img src="image/instagram.png"></a></li>
            <li><a href="#"><img src="image/twitter.png"></a></li>
        </ul>
        <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>

    </section>

</section>


</body>
</html>