<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php 

$errors = array();
$RefNo = '';
$Order_date ='';
$User_Name ='';
$Description ='';
$cost ='';
$pay_method ='';
$Email ='';
$CusId='';

//$User_Password ='';

if(isset($_POST['submit']))
{
    $RefNo = $_POST['RefNo'];
    $Order_date =$_POST['Order_date'];
    $User_Name =$_POST['User_Name'];
    $Description =$_POST['Descrition'];
    $cost =$_POST['cost'];
    $pay_method =$_POST['paymethod'];
    $Email =$_POST['Email'];
    $CusId =$_POST['CusId'];
       
   

    //checking required fileds

    $req_fields =array('RefNo','Order_date','User_Name','Descrition','cost','paymethod','Email','CusId');
    $errors = array_merge($errors,check_req_fields($req_fields));

    //checking max length

    $max_length_fields = array('RefNo'=>100,'User_Name'=>50,'Descrition'=>200,'cost'=>100,'paymethod'=>20,'Email'=>50,'CusId'=>50);
    $errors = array_merge($errors,check_max_length($max_length_fields));
       
          
    // checking email address
    if(!is_email($_POST['Email'])){
        $errors[]='Email address is invalid.';
    }
    
    
    // checking email address is registered one
    $email = mysqli_real_escape_string($connection,$_POST['Email']);
    $query0 ="SELECT * FROM customer WHERE (Email ='{$Email}' AND UserName='{$User_Name}') LIMIT 1";

    $result_set0 =mysqli_query($connection,$query0);

    if($result_set0){
        if(mysqli_num_rows($result_set0)==0){
            $errors[]='Email Address is not Registered!';
        }
    }


    // checking CustomerId is registered one
    $email = mysqli_real_escape_string($connection,$_POST['CusId']);
    $query3 ="SELECT * FROM customer WHERE (CustomerId ='{$CusId}' AND UserName='{$User_Name}') LIMIT 1";

    $result_set3 =mysqli_query($connection,$query3);

    if($result_set3){
        if(mysqli_num_rows($result_set3)==0){
            $errors[]='Customer Id is not Valid!';
        }
    }

    //checking username already exixts(Registered customer)
    $uname = mysqli_real_escape_string($connection,$_POST['User_Name']);
    $query1 ="SELECT * FROM customer WHERE UserName ='{$uname}' LIMIT 1";

    $result_set1 =mysqli_query($connection,$query1);

    if($result_set1){
        if(mysqli_num_rows($result_set1)==0){
            $errors[]='Customer is not registered!';
        }
    }

//add data to the table
if(empty($errors)){
    // no errors found
    // to secure data use real scape function
    $RefNo  = mysqli_real_escape_string($connection,$_POST['RefNo']);
    $Order_date = mysqli_real_escape_string($connection,$_POST['Order_date']);
    // email and username is already sanitized
    $Description =mysqli_real_escape_string($connection,$_POST['Descrition']);
    $cost = mysqli_real_escape_string($connection,$_POST['cost']);
    $CusId =mysqli_real_escape_string($connection,$_POST['CusId']);
    $pay_method = mysqli_real_escape_string($connection,$_POST['paymethod']);
    
   

   // insert data to order table
    $query2 = " INSERT INTO orderstable (RefNo,ODate,TotalCost,CustomerId,UserName,Payment_method,Customer_email,ODescription)
    VALUES('{$RefNo}','{$Order_date}','{$cost}','{$CusId}','{$uname}','{$pay_method}','$Email','{$Description}') ";

    $result = mysqli_query($connection , $query2);
  echo($Order_date);

  
    if($result){
        header('Location:orders-view.php');
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
    <title>Add Order </title>
    <link rel ="stylesheet" href ="css/users.css">
    <link rel ="stylesheet" href ="css/modify_nav.css">
    <link rel ="stylesheet" href ="css/modify_form.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
</head>
<body>

<section class="banner2">
    <header>
        <a href="#" class="logo">Add Order</a>

        <br >
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="Home.php">Home</a></li>
            <li><a href="cashier-view.php">Back</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#"></a></li>

        </ul>
    </header>

    <div class="content">
        <div class="contentBx">

            <h3 class="textTitle"><a href="orders-view.php" class="btn"> < Back to order List</a></h3>
        </div>
    </div>
      
       <?php
       
            if(!(empty ($errors))){
                display_errors($errors);
            }
       ?>
        <form action ="addorder.php" method ="post" class="userform">
            <div class="container6">

                <div class="row100">
                    <div class="col">
                        <div class="inputBox">

                            <input type="text" name="RefNo" required <?php echo 'value ="'.$RefNo.'"';?>>
                            <span class="text">Reference No:</span>
                            <span class="line"></span>
                        </div>
                    </div>

                <div class="row100">
                        <div class="col">
                            <div class="inputBox">

                                <input type="date" name="Order_date" required <?php echo 'value ="'.$Order_date.'"';?>>
                                <span class="date">Ordered Date:</span>
                                <span class="line"></span>
                            </div>
                        </div>

                <div class="col">
                        <div class="inputBox">
                            <input type="text" name="User_Name" required <?php echo 'value ="'.$User_Name.'"';?>>
                            <span class="text">User Name :</span>
                            <span class="line"></span>
                        </div>
                    </div>


                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="CusId" required <?php echo 'value ="'.$CusId.'"';?>>
                            <span class="text">CustomerId :</span>
                            <span class="line"></span>
                        </div>
                    </div>

                <div class="col">
                        <div class="inputBox">
                            <input type="text" name="Descrition" required <?php echo 'value ="'.$Description.'"';?>>
                            <span class="text">Description:</span>
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

                   <div class="col">
                        <div class="inputBox">
                            <input type="text" name="paymethod" required <?php echo 'value ="'.$pay_method.'"';?>>
                            <span class="text">Payment Method:</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inputBox">
                            <input type="email" name="Email" required <?php echo 'value ="'.$Email.'"';?>>
                            <span class="text">Customer Email:</span>
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