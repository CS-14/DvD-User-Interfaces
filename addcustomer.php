<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php 

$errors = array();
$First_Name = '';
$Last_Name ='';
$User_Name ='';
$User_Type ='';
$Telephone ='';
$NIC ='';
$Addrerss ='';
$Email ='';
$User_Password ='';

if(isset($_POST['submit']))
{
   
    $First_Name =$_POST['First_Name'];
    $Last_Name =$_POST['Last_Name'];
    $User_Name =$_POST['User_Name'];
    $User_Type =$_POST['User_Type'];
    $Telephone =$_POST['Telephone'];
    $NIC =$_POST['NIC'];
    $Addrerss =$_POST['Addrerss'];
    $Email =$_POST['Email'];
    $User_Password =$_POST['User_Password'];

    //checking required fileds

    $req_fields =array('First_Name','Last_Name','User_Name','User_Type','Telephone','NIC','Addrerss','Email','User_Password');
    $errors = array_merge($errors,check_req_fields($req_fields));
  
    //checking max length

    $max_length_fields = array('First_Name'=> 50,'Last_Name'=>50,'User_Name'=>50,'User_Type'=>10,'Telephone'=>10,'NIC'=>100,'Addrerss'=>50,'Email'=>50,'User_Password'=>50);
    $errors = array_merge($errors,check_max_length($max_length_fields));
      
          
    // checking email address
    if(!is_email($_POST['Email'])){
        $errors[]='Email address is invalid.';
        }
    

    // checking email address already exixts
    $email = mysqli_real_escape_string($connection,$_POST['Email']);
    $query ="SELECT * FROM users WHERE Email ='{$email}' LIMIT 1";
        
    $result_set =mysqli_query($connection,$query);

    if($result_set){
        if(mysqli_num_rows($result_set)==1){
            $errors[]='Email Address already exists!';
        }
    }

    //checking username already exixts
    $uname = mysqli_real_escape_string($connection,$_POST['User_Name']);
    $query1 ="SELECT * FROM users WHERE UserName ='{$uname}' LIMIT 1";

    $result_set1 =mysqli_query($connection,$query1);

    if($result_set){
        if(mysqli_num_rows($result_set1)==1){
            $errors[]='User Name already exists!';
        }
    }

    //add data to the table
    if(empty($errors)){
        // no errors found
        // to secure data use real scape function
        $First_Name = mysqli_real_escape_string($connection,$_POST['First_Name']);
        $Last_Name = mysqli_real_escape_string($connection,$_POST['Last_Name']);
        // email and username is already sanitized
        $User_Type =mysqli_real_escape_string($connection,$_POST['User_Type']);
        $Telephone =mysqli_real_escape_string($connection,$_POST['Telephone']);
        $NIC = mysqli_real_escape_string($connection,$_POST['NIC']);;
        $Addrerss = mysqli_real_escape_string($connection,$_POST['Addrerss']);
        $User_Password  = mysqli_real_escape_string($connection,$_POST['User_Password']);

        // hashed password
        $hashed_password = sha1($User_Password);

       // insert data to user table
        $query2 = " INSERT INTO users (utype,UserName,cpassword,Email,is_deleted)
        VALUES('{$User_Type}','{$uname}','{$User_Password}','$email',0) ";

        $result = mysqli_query($connection , $query2);

         // select specific user id in users table
         $query3 = " SELECT UserId FROM users WHERE  UserName ='{$uname}'";
         $result2 = mysqli_query($connection , $query3); 
         if($result2->num_rows >0){
             while($row = $result2->fetch_assoc())
             {
                 $uid = $row["UserId"];
             }         
         }

         if ($result)
        { if($User_Type = 'customer')
            {
            $query4 = " INSERT INTO customer (Cpassword,FirstName,LastName,UserName,HAddress,Email,Telephone,CustomerId,UserId)
            VALUES('{$User_Password}','{$First_Name}','{$Last_Name}','{$User_Name}','$Addrerss','{$Email}','{$Telephone}','{$NIC}',{$uid})";
            $result3 = mysqli_query($connection , $query4);
            
            }          
        }
        if($result3){
            header('Location:usv.php');
        }
        else{
            echo "error!";
        }
   }

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset ="UTF-8">
    <title>Add Customer </title>
    <link rel ="stylesheet" href ="css/users.css">
    <link rel ="stylesheet" href ="css/modify_nav.css">
    <link rel ="stylesheet" href ="css/modify_form.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
</head>
<body>
<section class="banner2">

    <header>
        <a href="#" class="logo">Add Customer</a>

        <br >
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="Home.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="adminview.php">Back</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="#"></a></li>

        </ul>
    </header>
    <div class="content">
        <div class="contentBx">

            <h3 class="textTitle"><a href="usv.php" class="btn"> < Back to User List</a></h3>
        </div>
    </div>

       <?php
       
            if(!(empty ($errors))){
                display_errors($errors);
            }
       ?>

        <form action ="addcustomer.php" method ="post" class="userform">

            <div class="container6">

                <div class="row100">
                    <div class="col">
                        <div class="inputBox">

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


                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="User_Name" required <?php echo 'value ="'.$User_Name.'"';?>>
                            <span class="text">User Name</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="User_Type" required <?php echo 'value ="'.$User_Type.'"';?>>
                            <span class="text">User Type</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="Telephone" required <?php echo 'value ="'.$Telephone.'"';?>>
                            <span class="text">Telephone</span>
                            <span class="line"></span>
                        </div>
                    </div>


                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="NIC" required <?php echo 'value ="'.$NIC.'"';?>>
                            <span class="text">NIC</span>
                            <span class="line"></span>
                        </div>
                    </div>


                    <div class="col">
                        <div class="inputBox">
                            <input type="text" name="Addrerss" required <?php echo 'value ="'.$Addrerss.'"';?>>
                            <span class="text">Addrerss</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inputBox">
                            <input type="email" name="Email" required <?php echo 'value ="'.$Email.'"';?>>
                            <span class="text">Email</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="inputBox">
                            <input type="password" name="User_Password" required <?php echo 'value ="'.$User_Password.'"';?>>
                            <span class="text">User_Password</span>
                            <span class="line"></span>
                        </div>
                    </div>

                    <div class="row100">
                        <div class="col">
                            <input type="submit" value="Save">
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