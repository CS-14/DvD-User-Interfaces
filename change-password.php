<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php 

$errors = array();
$First_Name = '';
$Last_Name ='';

$User_Type ='';
$Telephone ='';
$NIC ='';
$Email ='';

$user_id ='';
$password ='';

if (isset($_GET['user_id'])) {
    // getting the user information
    $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
    $query = "SELECT * FROM users WHERE UserId = {$user_id} LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            // user found
            $result = mysqli_fetch_assoc($result_set);

            $User_Type = $result['utype'];
            $Email = $result['Email'];
           

        if($User_Type = 'owner'){
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
                    $password =$result1['OPassword'];

                }
            }
            
        }


        if($User_Type = 'cashier'){
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

                }
            }
            
        }

        if($User_Type = 'admin'){
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

                }
            }
            
        }
    }
        
    else {
            // user not found
            header('Location: users-view.php?err=user_not_found');	
        }
    } else {
        // query unsuccessful
        header('Location: users-view .php?err=query_failed');
    }
   
}


if(isset($_POST['submit']))
{
    $user_id =$_POST['user_id'];
    $password =$_POST['User_Password'];
    //$User_Type =$_POST['User_Type'];
    
    

    //checking required fileds

    $req_fields =array('User_Password');
    $errors = array_merge($errors,check_req_fields($req_fields));

    //checking max length

    $max_length_fields = array('User_Password'=>50);
    $errors = array_merge($errors,check_max_length($max_length_fields));
       

//modify data in  the table
if(empty($errors)){
    // no errors found
    // to secure data use real scape function
    $password= mysqli_real_escape_string($connection,$_POST['User_Password']);

   // modify data in user table
    $query2 = " UPDATE users SET cpassword ='{$password}' WHERE UserId ='{$user_id}' LIMIT  1";
    $result = mysqli_query($connection , $query2); 
    
    
    if ($result){
       

            if($User_Type = 'customer'){
                
                $query4 = " UPDATE customer SET cpassword ='{$password}' WHERE UserId ='{$user_id}' LIMIT  1";
                $result3 = mysqli_query($connection , $query4);
                } 

             if($User_Type = 'owner'){
                
                $query4 = " UPDATE owners SET OPassword ='{$password}' WHERE UserId ='{$user_id}' LIMIT  1";
                $result3 = mysqli_query($connection , $query4);
                } 

           if($User_Type = 'admin') {
            
                $query4 = " UPDATE admins SET APassword ='{$password}' WHERE UserId ='{$user_id}' LIMIT  1";
                $result3 = mysqli_query($connection , $query4);
                } 

            if($User_Type = 'cashier'){
            
                $query4 = " UPDATE cashiers SET Chpassword='{$password}' WHERE UserId ='{$user_id}' LIMIT  1";
                $result3 = mysqli_query($connection , $query4);
                } 
   
     }

   if($result3){
        header('Location:usv.php ? user_modified=true');
        
   }
    else{
        
        $errors[]='Failed to modify data!';
    }
}
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset ="UTF-8">
    <title>Change Password </title>
    <link rel ="stylesheet" href ="css/users.css">
    <link rel ="stylesheet" href ="css/modify_nav.css">
    <link rel ="stylesheet" href ="css/modify_form.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="css/admin1.css">
    <link rel="stylesheet" href="css/admin1_chart.css">
    <link rel="stylesheet" href="css/admin1_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

    <body>
    <section class="banner2">

        <header>
            <a href="#" class="logo">Change Password</a>

            <br >
            <div class ="logedin""> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

            <div class="toggleMenu" onmouseover="toggleMenu();"></div>
            <ul class="navigation">

                <li><a href="Home.php">Home</a></li>
                <li><a href="usv.php">Back</a></li>
                <li><a href="logout.php">Log-out</a></li>
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


       <?php
       
            if(!(empty ($errors))){
                display_errors($errors);
            }
       ?>

        <form action ="change-password.php" method ="post" class="userform">


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
                            <input type="text" name="User_Type" required="required"<?php echo 'value ="'.$User_Type.'"';?>  >
                            <span class="text">User Type</span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>

                <div class="row100">
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


                <div class="row100">
                <div class="col">
                    <div class="inputBox">
                        <input type="password" name="User_Password" id ="password" <?php echo 'value ="'.$password.'"';?>>
                        <span class="text">New Password:</span>
                        <span class="line"></span>
                    </div>
                </div>
            </div>

            <div class="row100">
                        <div class="col">
                            <div class="inputBox">
                                <input type="Checkbox" name="Checkbox" id="showpassword" style="width:20px; height:20px;">
                                <span class="text">Show Password:</span>

                            </div>
                        </div>
                    </div>

                    <div class="row100">
                        <div class="col">
                            <input type="submit"  name="submit" value="Submit Me">
                        </div>
                    </div>

        </form>
    </section>
	<script src="js/jquery.js"></script>
	<script>
		$(document).ready(function(){
			$('#showpassword').click(function(){
				if ( $('#showpassword').is(':checked') ) {
					$('#password').attr('type','text');
				} else {
					$('#password').attr('type','password');
				}
			});
		});
	</script>

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