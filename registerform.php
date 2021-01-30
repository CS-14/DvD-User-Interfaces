<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>


<?php

$first_name ='';
$last_name ='';
$cid = '';
$email = '';
$tele = '';
$Address = '';
$city = '';


// check the submission
if (isset($_POST['submit']))
{

    $utype ='customer';
    $first_name = $_POST['fname'];
    $last_name =$_POST['lname'];
    $cid = $_POST['uid'];
    $email = $_POST['email'];
    $tele = $_POST['tele'];
    $Address = $_POST['straddr'];
    $city = $_POST['city'];
    $password = $_POST['pass'];
    $repassword = $_POST['repass'];
// not used here
    $hashed_password =sha1($password);

    $error = 0;
    $errors = array();

    if( empty($first_name)|| empty($last_name) ||  empty($cid)|| empty($email) ||empty($tele)|| empty($Address)||empty( $city)||empty($password)|| empty($repassword))
    {
        $errors[] = 'Inputs are Missing/Invalid';

    }

    else{

        if($password != $repassword ){
            $errors[] = 'Password is Invalid';
        }
        else {


            // insert data to user table
            $query1 = " INSERT INTO users (utype,FirstName,cpassword,Email)
        VALUES('{$utype}','{$first_name}','{$password}','{$email}') ";

            $result1 = mysqli_query($connection , $query1 );

            // select specific user id
            $query2 = " SELECT UserId FROM users WHERE  Email ='{$email}'";
            $result2 = mysqli_query($connection , $query2);



            if($result2->num_rows >0){
                while($row = $result2->fetch_assoc())
                {
                    $uid = $row["UserId"];
                }

            }

            if ($result1)
            {

                if($utype == 'customer')
                {
                    $query3 = " INSERT INTO customer (cpassword,FirstName,LastName,StreetAddress,ccity,Email,Telephone,CustomerId,UserId)
            VALUES('{$password}','{$first_name}','{$last_name}','{$Address}','{$city}','{$email}','{$tele}','{$cid}',{$uid})";
                    $result3 = mysqli_query($connection , $query3);
                }


            }

            if($result3){

                header('Location:loginform.php');
            }
            else{
                $errors[] = 'Customer is already registered /Invalid ';
            }


        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Registration Page</title>
    <link rel ="stylesheet" href ="css/style2.css">
    <link rel="stylesheet" href="css/dvd.css" >
    <link rel="stylesheet" href="css/GalleryMainPage.css" >
</head>
<body style ="background-image: url('image/Sherlock2.jpg');">
<header>
    <a href="#" class="logo"><h2>Sign-up</h2></a>
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
    <center>
      <img src ="image/avatar.png" class ="avatar" />
    </center>
  

    <form class ="myform" action ="registerform.php"  method ="post">

        <?php

        if(!(empty ($errors))){
            display_errors($errors);
        }
        ?>

        <label><b>First Name:</b></label><br>
        <input type ="text" name ="fname" class = "inputvalues" placeholder="Type your firstname" required <?php echo 'value ="'.$first_name.'"';?>><br>

        <label><b>Last Name:</b></label><br>
        <input type ="text" name ="lname" class = "inputvalues" placeholder="Type your lastname"required <?php echo 'value ="'. $last_name.'"';?> ><br>

        <label><b>NIC:</b></label><br>
        <input type ="text" name ="uid" class = "inputvalues" placeholder="Type your NIC"required <?php echo 'value ="'.$cid.'"';?> ><br>

        <label><b>Email:</b></label><br>
        <input type ="text" name ="email" class = "inputvalues" placeholder="Type your email"required <?php echo 'value ="'.$email.'"';?> ><br>

        <label><b>Telephone:</b></label><br>
        <input type ="text" name ="tele" class = "inputvalues" placeholder="Type your phone number"required <?php echo 'value ="'.$tele.'"';?> ><br>

        <label><b>Street Address:</b></label><br>
        <input type ="text" name ="straddr" class = "inputvalues" placeholder="Type your Street Address"required <?php echo 'value ="'.$Address.'"';?> ><br>

        <label><b>city:</b></label><br>

        <input type ="text" name ="city" class = "inputvalues" placeholder="Type your city"required <?php echo 'value ="'. $city.'"';?> ><br>

        <label><b>Password:</b></label><br>
        <input type ="password" name ="pass" class ="inputvalues" placeholder="Type your password"required <?php echo 'value ="'.$first_name.'"';?> ><br>

        <label><b>Confirm Password:</b></label><br>
        <input type ="password" name ="repass" class ="inputvalues" placeholder="Type your password"required <?php echo 'value ="'.$first_name.'"';?><br>
        

        <input type ="submit"  name ="submit" id = "signup_btn" value="Sign Up"/><br>

       
        
    </form>
  </div>



</body>
</html>
