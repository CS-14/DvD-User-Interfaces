<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php

$errors = array();
$First_Name = '';
$Last_Name ='';
$User_Type ='customer';
$Telephone ='';
$NIC ='';
$Email ='';
$Addrerss ='';
$city='';
$user_id ='';


if (isset($_GET['user_id'])) {
    // getting the user information
    $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
    $query = "SELECT * FROM users WHERE UserId = {$user_id} LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            // user found
            $result = mysqli_fetch_assoc($result_set);
            $First_Name = $result['FirstName'];
            $User_Type = $result['utype'];
            $Email = $result['Email'];



            if($User_Type == 'customer'){
                $query1 = "SELECT * FROM customer WHERE UserId = {$user_id} LIMIT 1";
                $result_set1 = mysqli_query($connection, $query1);
                if ($result_set1){
                    if (mysqli_num_rows($result_set1) == 1) {
                        // customer found
                        $result1 = mysqli_fetch_assoc($result_set1);
                        $First_Name = $result1['FirstName'];
                        $Last_Name = $result1['LastName'];
                        $Telephone = $result1['Telephone'];
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
                        $Addrerss = $result1['CAddress'];
                    }
                }

            }

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
                        $NIC = $result1['AdminId'];
                        $Addrerss = $result1['AAddress'];
                    }
                }

            }

        }


        else {
            // user not found
            header('Location: custtomer-view.php?err=user_not_found');
        }
    } else {
        // query unsuccessful
        header('Location: customer-view .php?err=query_failed');
    }

}


if(isset($_POST['submit']))
{
    $user_id =$_POST['user_id'];
    $First_Name =$_POST['First_Name'];
    $Last_Name =$_POST['Last_Name'];
    $Telephone =$_POST['Telephone'];
    $NIC =$_POST['NIC'];
    $Email =$_POST['Email'];
    $Addrerss =$_POST['Addrerss'];
    $city=$_POST['city'];

    //checking required fileds

    $req_fields =array('user_id','First_Name','Last_Name','Telephone','NIC','Email');
    $errors = array_merge($errors,check_req_fields($req_fields));

    //checking max length

    $max_length_fields = array('First_Name'=> 50,'Last_Name'=>50,'Telephone'=>10,'NIC'=>100,'Email'=>50);
    $errors = array_merge($errors,check_max_length($max_length_fields));


    // checking email address
    if(!is_email($_POST['Email'])){
        $errors[]='Email address is invalid.';
    }

    // checking email address already exixts
    $email = mysqli_real_escape_string($connection,$_POST['Email']);
    $query ="SELECT * FROM users WHERE Email ='{$Email}'AND UserId!={$user_id} LIMIT 1";

    $result_set =mysqli_query($connection,$query);

    if($result_set){
        if(mysqli_num_rows($result_set)==1){
            $errors[]='Email Address already exists!';
        }
    }




//modify data in  the table
    if(empty($errors)){
        // no errors found
        // to secure data use real scape function
        $First_Name = mysqli_real_escape_string($connection,$_POST['First_Name']);
        $Last_Name = mysqli_real_escape_string($connection,$_POST['Last_Name']);
        // email and username is already sanitized

        $Telephone =mysqli_real_escape_string($connection,$_POST['Telephone']);
        $NIC = mysqli_real_escape_string($connection,$_POST['NIC']);
        $Addrerss = mysqli_real_escape_string($connection,$_POST['Addrerss']);
        $city = mysqli_real_escape_string($connection,$_POST['city']);

        // modify data in user table
        $query2 =" UPDATE users SET FirstName = '{$First_Name}',Email ='{$email}'WHERE UserId ='{$user_id}' LIMIT  1";
        $result = mysqli_query($connection , $query2);

        if ($result)
        {   if($User_Type = 'customer')
        {
         $query4 = " UPDATE  customer SET  FirstName ='{$First_Name}',
                                           LastName = '{$Last_Name}',
                                           StreetAddress = '{$Addrerss}',
                                           ccity ='{$city}',
                                           Email ='{$Email}',
                                           Telephone ='{$Telephone}',
                                           CustomerId ='{$NIC}' WHERE UserId ='{$user_id}' LIMIT  1";

            $result3 = mysqli_query($connection , $query4);
        }

        }

        if($result3){
            header('Location:customer-view.php ? profile_updated=true');
        }
        else{
            echo ($query4);
        }
    }

}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset ="UTF-8">
    <title>Edit Profile </title>
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
        <div class ="logedin"> Welcome <?php echo ($_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="customer-view.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="#"></a></li>

        </ul>
    </header>


    <?php

    if(!(empty ($errors))){
        display_errors($errors);
    }
    ?>
    <form action ="edit_profile.php" method ="post" class="userform">


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


            <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <input type="text" name="city" required="required" <?php echo 'value ="'.$city.'"';?> >
                        <span class="text">City</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>

             <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <span class="text">User***: <?php echo 'Password'; ?></span>
                        <br>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href="cuschange-password.php?user_id=<?php echo $user_id;?>" class="btn">Change Password</a>
                    </div>
                </div>
                <br>

                <div class="row100">
                    <div class="col">
                        <input type="submit"  name="submit" value="Update Me">
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