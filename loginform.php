<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>

<?php
// check for the submission
if (isset ($_POST['loginbtn']) )
{

    $errors = array();
    $error = 0;

    // check if the user name and password has been entered
    if(!(isset($_POST['email'] )))
    {
        $errors[] = 'Email is Missing/Invalid';

    }

    if(!(isset($_POST['password'] )))
    {
        $errors[]= 'Password is Missing/ Invalid';
    }

    //check if there are any errors in the form
    if(empty($errors))
    {
        // save the useremail and password into variable
        $useremail = mysqli_real_escape_string($connection,$_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $hashed_password =sha1( $password);

        // prepare database query
        $query = "SELECT *FROM users 
          WHERE Email ='{$useremail}'
          AND cpassword ='{$password}' 
          LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if($result_set)
        {
            // query successfull
            if(mysqli_num_rows($result_set)==1)
            {
                //valid user found
                $user =mysqli_fetch_assoc($result_set);

                $_SESSION['user_id'] =$user['UserId'];
                $_SESSION['First_name'] = $user['FirstName'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['user_type'] = $user['utype'];
                $custype = $user['utype'];

                // updating last login
                $query = "UPDATE users SET last_login = NOW()";
                $query .= "WHERE UserId ={$_SESSION['user_id'] } LIMIT 1";

                $result_set = mysqli_query($connection, $query);

                if(! $result_set) {
                    die("Database query failed!");
                }
                //redirect to valid user
                // if user is a customer
                if($custype =='customer'){
                    header('Location:customer-view.php');
                }
                // if user is an admin
                if($custype =='admin'){
                    header('Location:adminview.php');}

                // if user is the owner
                if($custype =='owner'){
                    header('Location:owner-view.php');}

                // if user is the cashier
                if($custype =='cashier'){
                    header('Location:cashier-view.php');}

            }else{
                // username and password invalid
                $errors[] = 'Invalid Username/Password';


            }
        }
        else{
            $errors[] = 'Database query failed';

        }

    }

}

else if(isset($_POST['backbtn']))
{
    header("Location: homepage.php");
}


?>

<!DOCTYPE html>
<html lang="">
<head>
<title>Login Page</title>
<link rel ="stylesheet" href ="css/style2.css">
    <link rel="stylesheet" href="css/dvd.css" >
    <link rel="stylesheet" href="css/GalleryMainPage.css" >


</head>
<body style = "background-image: url('image/Sherlock2.jpg' );">
<header>
    <a href="#" class="logo"><h2>Log-In</h2></a>
    <div class="toggleMenu" onmouseover="toggleMenu();"></div>
    <ul class="navigation">
        <li><a href="Home.php">Home</a></li>
        <li><a href="service.php" >Services</a></li>
        <li><a href="contact.php" >Contact</a></li>
        <li><a href="loginform.php" >Log-In</a></li>
        <li><a href="registerform.php" >Sign-Up</a></li>
    </ul>

</header>

  <div id ="main-wrapper">

    <div style="text-align: center;">
        <h2>Login Form</h2>
      <img src ="image/avatar.png" class ="avatar"  alt=""/>
    </div>
        
        <form class ="myform" action ="loginform.php" method ="post">

            <?php
        if(!(empty ($errors))){
            display_errors($errors);
        }   ?>


        <label><b>Email:</b></label><br>
            <label>
                <input type ="email" name ="email"  class = "inputvalues" placeholder="Type your email" required/>
            </label><br>

        <label><b>Password:</b></label><br>
            <label>
                <input type ="password" name ="password" class ="inputvalues" placeholder="Type your password" required/>
            </label><br>

        <input type ="submit"  name ="loginbtn" id = "login_btn" value="Login"/><br>


          <center>  <p><a href="#" style="color:black ;">Forgot Password!</a></p></center>


    </form>
  </div>
</body>
</html>
