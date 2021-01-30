<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php

$errors = array();


$Description ='';
$cost ='';
$pay_method ='';
$Email ='';
$CusId='xxxxxxxv';
$Item ='';
$Qty='';
//$User_Password ='';

if(isset($_POST['submit']))
{

    //$Order_date =Now();

    $cost =$_POST['cost'];
    $pay_method =$_POST['paymethod'];
    $Email =$_POST['Email'];
    $Item =$_POST['Item'];
    $Qty =$_POST['Qty'];


    //checking required fileds

    $req_fields =array('cost','paymethod','Item','Qty');
    $errors = array_merge($errors,check_req_fields($req_fields));

    if(empty($Email) ){
        $Email='shop@gmail.com';
    }

    //checking max length

    $max_length_fields = array('cost'=>100,'paymethod'=>20,'Email'=>50);
    $errors = array_merge($errors,check_max_length($max_length_fields));


    // checking email address
    if(!is_email($_POST['Email'])){
        $errors[]='Email address is invalid.';
    }



        // checking email address is registered one

    $email = mysqli_real_escape_string($connection, $_POST['Email']);
        $query0 = "SELECT * FROM customer WHERE Email ='{$Email}' LIMIT 1";

        $result_set0 = mysqli_query($connection, $query0);

        if ($result_set0) {
            if (mysqli_num_rows($result_set0) == 0) {
                $errors[] = 'Email Address is not Registered!';
            }
        }


//add data to the table
    if(empty($errors)){
        // no errors found
        // to secure data use real scape function

        // email and username is already sanitized

        $cost = mysqli_real_escape_string($connection,$_POST['cost']);
        $pay_method = mysqli_real_escape_string($connection,$_POST['paymethod']);



        // insert data to order table
        $query2 = " INSERT INTO orderstable (CustomerId,TotalCost,Payment_method,Customer_email,DVD_Item,Qty,Confirmation)
        VALUES('{$CusId}','{$cost}','{$pay_method}','$Email','{$Item}',{$Qty},1) ";

        $result = mysqli_query($connection , $query2);
        echo($query2);


        if($result){
            $query3 =  "UPDATE orderstable SET ODate = NOW()";
            $query3 .= "WHERE Customer_email ='{$Email}' LIMIT 1";
            $result2 = mysqli_query($connection , $query3);
            if($result2){
                header('Location:purchases.php?echo("successfull")');
            }else{
                echo "Check!";
            }

        }else{
            echo "error!";
        }
    }




}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset ="UTF-8">
    <title>Purchases </title>
    <link rel ="stylesheet" href ="css/users.css">
    <link rel ="stylesheet" href ="css/modify_nav.css">
    <link rel ="stylesheet" href ="css/modify_form.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="css/cashier.css">
    <link rel="stylesheet" href="css/cashier_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>

<section class="banner2">
    <header>
        <a href="#" class="logo">Purchases</a>

        <br >

        <div class ="logedin" > Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="cashier-view.php">Home</a></li>
            <li><a href="cashier-view.php">Back</a></li>
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


    <form action ="purchases.php" method ="post" class="userform">
        <div class="container6">

            <div class="row100">
                <div class="col">
                     <input type="submit" name="View" value="View" style="background:lightgoldenrodyellow;"> | <input type="submit" name="New" value="New" style="background:yellowgreen;">
                </div>

                <div class="row100">
                    <div class="col">
                        <div class="inputBox">
                            <input type="email" name="Email" <?php echo 'value ="'.$Email.'"';?>>
                            <span class="text">Customer Email:</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="paymethod" required <?php echo 'value ="'.$pay_method.'"';?>>
                            <span class="text">Payment Method:</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="Item" required <?php echo 'value ="'.$Item.'"';?>>
                            <span class="text">Item:</span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="Qty" required <?php echo 'value ="'.$Qty.'"';?>>
                            <span class="text">Quantity:</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="cost" required <?php echo 'value ="'.$cost.'"';?>>
                            <span class="text">Cost:</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="row100">
                        <div class="col">
                            <input type="submit" name="submit" value="Save">
                        </div>


                    </div>

    </form>
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