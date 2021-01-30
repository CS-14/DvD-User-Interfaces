<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php

$user_id = $_SESSION['user_id'];
$User_Type = $_SESSION['user_type'] ;

$Email = '';
$First_Name ='';
$Last_Name ='';
$Telephone ='';
$NIC ='';
$Addrerss ='';
$Upassword= '';
$city='';

if($User_Type == 'admin'){
    $query1 = "SELECT * FROM admins WHERE UserId = {$user_id} LIMIT 1";
    $result_set1 = mysqli_query($connection, $query1);
    if ($result_set1){
        if (mysqli_num_rows($result_set1) == 1) {
            // admin found
            $result1 = mysqli_fetch_assoc($result_set1);
            $First_Name = $result1['FirstName'];
            $Last_Name = $result1['LastName'];
            $Telephone = $result1['ContactNo'];
            $Email =$result1['Email'];
            $NIC = $result1['AdminId'];
            $Addrerss = $result1['AAddress'];
        }
    }

}

if($User_Type == 'customer'){

    $query1 = "SELECT * FROM customer WHERE UserId = {$user_id}  LIMIT 1";
    $result_set1 = mysqli_query($connection, $query1);

    if ($result_set1){
        if (mysqli_num_rows($result_set1) == 1) {
            // customer found
            $result1 = mysqli_fetch_assoc($result_set1);
            $First_Name = $result1['FirstName'];
            $Last_Name = $result1['LastName'];
            $Telephone = $result1['Telephone'];
            $Email =$result1['Email'];
            $NIC = $result1['CustomerId'];
            $Addrerss = $result1['StreetAddress'];
            $city=$result1['ccity'];

        }
    }

}
if($User_Type == 'owner'){
    $query1 = "SELECT * FROM owners WHERE UserId = {$user_id} LIMIT 1";
    $result_set1 = mysqli_query($connection, $query1);
    if ($result_set1){
        if (mysqli_num_rows($result_set1) == 1) {
            // owner found
            $result1 = mysqli_fetch_assoc($result_set1);
            $First_Name = $result1['First_Name'];
            $Last_Name = $result1['Last_Name'];
            $Telephone = $result1['ContactNo'];
            $NIC = $result1['OwnerId'];
            $Email =$result1['Email'];
            $Addrerss = $result1['OAddress'];
        }
    }

}
if($User_Type == 'cashier'){
    $query1 = "SELECT * FROM cashiers WHERE UserId = {$user_id} LIMIT 1";
    $result_set1 = mysqli_query($connection, $query1);
    if ($result_set1){
        if (mysqli_num_rows($result_set1) == 1) {
            // cashier found
            $result1 = mysqli_fetch_assoc($result_set1);
            $First_Name = $result1['First_Name'];
            $Last_Name = $result1['Last_Name'];
            $Telephone = $result1['ContactNo'];
            $NIC = $result1['CashierId'];
            $Email =$result1['Email'];
            $Addrerss = $result1['CAddress'];
        }
    }

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset ="UTF-8">
    <title>Profile</title>
    <link rel ="stylesheet" href ="css/users.css">
    <link rel ="stylesheet" href ="css/modify_nav.css">
    <link rel ="stylesheet" href ="css/modify_form.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
</head>

<body>

<section class="banner2">

    <header>
        <a href="#" class="logo"> Profile</a>

        <br >
        <div class ="logedin"> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="customer-view.php">Home</a></li>
            <li><a href="edit_profile.php?user_id=<?php echo $user_id;?>"> Edit Profile</a></li>

            <li><a href="logout.php">Log-out</a></li>
            <li><a href="#"></a></li>

        </ul>
    </header>

    <?php

    if(!(empty ($errors))){
        display_errors($errors);
    }
    ?>
    <form action ="modifyuser.php" method ="post" class="userform">


        <div class="container6">

            <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <input type ="hidden" name="user_id"  value="<?php echo $user_id;?>">
                        <input type="text" name="First_Name" required <?php echo 'value ="'.$First_Name.'"';?>>
                        <span class="text">First Name</span>
                        <span class="line"></span>
                    </div>
                </div>

                <div class="col">
                    <div class="inputBox">
                        <input type="text" name="Last_Name" required <?php echo 'value ="'.$Last_Name.'"';?>>
                        <span class="text">Last Name</span>

                        <span class="line"></span>
                    </div>
                </div>
            </div>


            <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <input type="text" name="Telephone" required="required" <?php echo 'value ="'.$Telephone.'"';?>>
                        <span class="text">Telephone</span>
                        <span class="line"></span>
                    </div>
                </div>


                <div class="col">
                    <div class="inputBox">
                        <input type="text" name="NIC" required="required"<?php echo 'value ="'.$NIC.'"';?> >
                        <span class="text">NIC</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>

            <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <input type="email" name="Email" required="required" <?php echo 'value ="'.$Email.'"';?> >
                        <span class="text">Email</span>
                        <span class="line"></span>
                    </div>
                </div>

                <div class="col">
                    <div class="inputBox">
                        <input type="text" name="Addrerss" required="required"<?php echo 'value ="'.$Addrerss.'"';?> >
                        <span class="text">Address</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>

            <div class="row100">
            <div class="col">
                <div class="inputBox">
                    <input type="text" name="city" required="required"<?php echo 'value ="'.$city.'"';?> >
                    <span class="text">City</span>
                    <span class="line"></span>
                </div>
            </div>
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

