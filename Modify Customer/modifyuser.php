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
$Email ='';
$Addrerss ='';
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
            $User_Name = $result['UserName'];
            $User_Type = $result['utype'];
            $Email = $result['Email'];
           
       

        if($User_Type = 'customer'){
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
                    $Addrerss = $result1['HAddress'];
                }
            }
            
        }


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
                    $Addrerss = $result1['OAddress'];
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
                    $Addrerss = $result1['CAddress'];
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
                    $Addrerss = $result1['AAddress'];
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
    $First_Name =$_POST['First_Name'];
    $Last_Name =$_POST['Last_Name'];
    $User_Name =$_POST['User_Name'];
    $User_Type =$_POST['User_Type'];
    $Telephone =$_POST['Telephone'];
    $NIC =$_POST['NIC'];
    $Email =$_POST['Email'];
    $Addrerss =$_POST['Addrerss'];
    

    //checking required fileds

    $req_fields =array('user_id','First_Name','Last_Name','User_Name','User_Type','Telephone','NIC','Email');
    $errors = array_merge($errors,check_req_fields($req_fields));

    //checking max length

    $max_length_fields = array('First_Name'=> 50,'Last_Name'=>50,'User_Name'=>50,'User_Type'=>10,'Telephone'=>10,'NIC'=>100,'Email'=>50);
    $errors = array_merge($errors,check_max_length($max_length_fields));
       
          
    // checking email address
    if(!is_email($_POST['Email'])){
        $errors[]='Email address is invalid.';
    }
    
    // checking email address already exixts
    $email = mysqli_real_escape_string($connection,$_POST['Email']);
    $query ="SELECT * FROM users WHERE Email ='{$email}'AND UserId!={$user_id} LIMIT 1";

    $result_set =mysqli_query($connection,$query);

    if($result_set){
        if(mysqli_num_rows($result_set)==1){
            $errors[]='Email Address already exists!';
        }
    }


    //checking username already exixts
    $uname = mysqli_real_escape_string($connection,$_POST['User_Name']);
    $query1 ="SELECT * FROM users WHERE UserName ='{$uname}'AND UserId!={$user_id} LIMIT 1";

    $result_set1 =mysqli_query($connection,$query1);

    if($result_set){
        if(mysqli_num_rows($result_set1)==1){
            $errors[]='User Name already exists!';
        }
    }

//modify data in  the table
if(empty($errors)){
    // no errors found
    // to secure data use real scape function
    $First_Name = mysqli_real_escape_string($connection,$_POST['First_Name']);
    $Last_Name = mysqli_real_escape_string($connection,$_POST['Last_Name']);
    // email and username is already sanitized
    $User_Type =mysqli_real_escape_string($connection,$_POST['User_Type']);
    $Telephone =mysqli_real_escape_string($connection,$_POST['Telephone']);
    $NIC = mysqli_real_escape_string($connection,$_POST['NIC']);
    $Addrerss = mysqli_real_escape_string($connection,$_POST['Addrerss']);
    

   // modify data in user table
    $query2 = " UPDATE users SET UserName = '{$uname}',Email ='{$email}',WHERE UserId ='{$user_id}' LIMIT  1";
    $result = mysqli_query($connection , $query2);    
    if ($result)
    {  /* if($User_Type = 'customer')
        {
        $query4 = " INSERT INTO customer (Cpassword,FirstName,LastName,UserName,HAddress,Email,Telephone,CustomerId,UserId)
        VALUES('{$User_Password}','{$First_Name}','{$Last_Name}','{$User_Name}','$Addrerss','{$Email}','{$Telephone}','{$NIC}',{$uid})";
        $result3 = mysqli_query($connection , $query4);
        } 
    /*    if($User_Type = 'owner')
        {
        $query4 = " INSERT INTO owners (OPassword,First_Name,Last_Name,UserName,Email,ContactNo,OwnerId,UserId)
        VALUES('{$User_Password}','{$First_Name}','{$Last_Name}','{$User_Name}','{$Email}','{$Telephone}','{$NIC}',{$uid})";
        $result3 = mysqli_query($connection , $query4);
        } 

        if($User_Type = 'admin')
        {
        $query4 = " INSERT INTO admins (APassword,FirstName,LastName,UserName,Email,ContactNo,AdminId,UserId)
        VALUES('{$User_Password}','{$First_Name}','{$Last_Name}','{$User_Name}','{$Email}','{$Telephone}','{$NIC}',{$uid})";
        $result3 = mysqli_query($connection , $query4);
        } 

        if($User_Type = 'cashier')
        {
        $query4 = " INSERT INTO cashiers (Chpassword,First_Name,Last_Name,UserName,Email,ContactNo,CashierId,UserId)
        VALUES('{$User_Password}','{$First_Name}','{$Last_Name}','{$User_Name}','{$Email}','{$Telephone}','{$NIC}',{$uid})";
        $result3 = mysqli_query($connection , $query4);
        }  header('Location:users-view.php ? user_modified=true');
*/header('Location:users-view.php ? user_modified=true');
    }

   /* if($result3){
        header('Location:users-view.php ? user_modified=true');
    }*/ 
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
        <title>Modify User </title>
        <link rel ="stylesheet" href ="css/users.css">
        <link rel ="stylesheet" href ="css/modify_nav.css">
        <link rel ="stylesheet" href ="css/modify_form.css">
        <link rel ="stylesheet" href ="css/modify_form2.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    
    <section class="banner2">

    <header>       
   <a href="#" class="logo">DVD Series</a>
<div class="toggleMenu" onmouseover="toggleMenu();"></div>
 <ul class="navigation">
    <li><a href="#">Home</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Gallery</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li>
    </ul>
    <br>
    
    <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> !  <a href="logout.php" class="btn1">LogOut</a></div>  
    
    </header> 
    
  <div class="content">
  <div class="contentBx">

        <h3 class="textTitle"> Modify/View User <a href="users-view.php" class="btn"> < Back to User List</a></h3>
      </div>
      </div>
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
      <input type="text" name="User_Name" required <?php echo 'value ="'.$User_Name.'"';?>>
      <span class="text">User Name</span>
      <span class="line"></span>
    </div>
</div>


<div class="col">
      <div class="inputBox">
      <input type="text" name="User_Type" required <?php echo 'value ="'.$User_Type.'"';?>  >
      <span class="text">User Type</span>
      <span class="line"></span>
    </div>
</div>
</div>

<div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" name="Telephone" required <?php echo 'value ="'.$Telephone.'"';?>>
      <span class="text">Telephone</span>
      <span class="line"></span>
    </div>
</div>


<div class="col">
      <div class="inputBox">
      <input type="text" name="NIC" required <?php echo 'value ="'.$NIC.'"';?> >
      <span class="text">NIC</span>
      <span class="line"></span>
    </div>
</div>
</div>

<div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="email" name="Email" required <?php echo 'value ="'.$Email.'"';?> >
      <span class="text">Email</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
      <input type="text" name="Addrerss" required <?php echo 'value ="'.$Addrerss.'"';?> >
      <span class="text">Address</span>
      <span class="line"></span>
    </div>
</div>
</div>

<div class="row100">
	<div class="col">
      <div class="inputBox"> 
      <span class="text">User***: <?php echo 'Password'; ?></span>
       <br>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href="change-password.php" class="btn">Change Password</a>
    </div>
</div>
<br>

<div class="row100">
	<div class="col">
      <input type="submit" value="Submit Me">
</div>
</div>

</div>
 </form>

 </section>
<footer>

<div class="container7">
        <div class="sec aboutus">
        <h2>About Us</h2>
        <p>When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.</p>
        
        <ul class="sci">
         <li><a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
     
     </ul>
     
</div>

<div class="sec quickLinks">
<h2>Quick Links</h2>
<ul>
          <li><a href="#">About</a></li><br >
          <li><a href="#">FAQ</a></li><br >
          <li><a href="#">Privacy Policy</a></li><br >
          <li><a href="#">Help</a></li><br >
          <li><a href="#">Terms & Conditions</a></li><br>
          <li><a href="#">Contacts</a></li><br>
     
     </ul>
</div>

<div class="sec contact">
<h2>Contact Info</h2>
<ul class="info">
          <li>
          <span><i class="fa fa-map" aria-hidden="true"></i>
          <span>No 89/A Walawwatta Road<br>Papiliyana<br />Sri Lanka
          </span>
          </li><br >
          
           <li>
          <span><i class="fa fa-phone-square" aria-hidden="true"></i>
      <p><a href="Tel:12930405">+94 74693647</a> <br>
      <a href="Tel:12930405">+94 8985647</a></p>
          </li><br>
          
          <li>
          <span><i class="fa fa-envelope-square" aria-hidden="true"></i>  </span>
          <p><a href="enterprisedvdhouse@gmail.com">enterprisedvdhouse@gmail.com</a></p>
        
          </li><br >
              
     </ul>
      <h4 class="copyrightText">Copyright @2020 <a href="#">DVD HOUSE Production</a>. All rights deserved</h4>
</div>

</div>

 

</footer>
    
    
      
    <script type="text/javascript"> 
    function toggleMenu()
    {
    const toggleMenu = document.querySelector('.toggleMenu');
	const navigation = document.querySelector('.navigation');
    toggleMenu.classList.toggle('active');
	navigation.classList.toggle('active');
    }
    </script>
    
    
    
 </body>
</html>