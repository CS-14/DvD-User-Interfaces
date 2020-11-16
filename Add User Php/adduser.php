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
$User_Password ='';

if(isset($_POST['submit']))
{
   
    $First_Name =$_POST['First_Name'];
    $Last_Name =$_POST['Last_Name'];
    $User_Name =$_POST['User_Name'];
    $User_Type =$_POST['User_Type'];
    $Telephone =$_POST['Telephone'];
    $NIC =$_POST['NIC'];
    $Email =$_POST['Email'];
   // $Addrerss =$_POST['Addrerss'];
    $User_Password =$_POST['User_Password'];

    //checking required fileds

    $req_fields =array('First_Name','Last_Name','User_Name','User_Type','Telephone','NIC','Email','User_Password');
    $errors = array_merge($errors,check_req_fields($req_fields));

    //checking max length

    $max_length_fields = array('First_Name'=> 50,'Last_Name'=>50,'User_Name'=>50,'User_Type'=>10,'Telephone'=>10,'NIC'=>100,'Email'=>50,'User_Password'=>50);
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
    $NIC = mysqli_real_escape_string($connection,$_POST['NIC']);
   // $Addrerss = mysqli_real_escape_string($connection,$_POST['Addrerss']);
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
    { /*if($User_Type = 'customer')
        {
        $query4 = " INSERT INTO customer (Cpassword,FirstName,LastName,UserName,HAddress,Email,Telephone,CustomerId,UserId)
        VALUES('{$User_Password}','{$First_Name}','{$Last_Name}','{$User_Name}','$Addrerss','{$Email}','{$Telephone}','{$NIC}',{$uid})";
        $result3 = mysqli_query($connection , $query4);
        } */
        if($User_Type = 'owner')
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
        } 

    }

    if($result3){
        header('Location:users-view.php');
    }
    else{
        echo "error!";
    }
}






}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New User</title>
 <link rel ="stylesheet" href ="css/users.css">
  <link rel ="stylesheet" href ="css/users_Nav.css">
  <link rel ="stylesheet" href ="css/users_Form.css">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 
</head>


<body>

<section>

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
    
     <div class="navigation2">
 <ul>
 <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-home" aria-hidden="true"></i></span>
    <span class="title1">Home</span></a></li>
    
    <li>
    <a href="#">
    <span class="icon1"></span>
    <span class="title1"><h3>Category</h3></span></a></li>
    
   <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-automobile" aria-hidden="true"></i></span>
    <span class="title1">Action</span></a></li>
    
    <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-anchor" aria-hidden="true"></i></span>
    <span class="title1">Adventure</span></a></li>
    
    
   <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
    <span class="title1">Mystery</span></a></li>
    
    
   <li>
    <a href="#">
    <span class="icon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
    <span class="title1">Romance</span></a></li>
    
    </ul>
   </div>
   
       <div class="content">
   <div class="contentBx">
    <h2 class="titleText"> Feel the Entertainment</br> At Your Doorstep</h2>
    <p class="text">A twisted tale told by Harley Quinn herself, when Gotham's most nefariously narcissistic villain, Roman Sionis, and his zealous right-hand, Zsasz, put a target on a young girl named Cass, the city is turned upside down looking for her. Harley, Huntress, Black Canary and Renee Montoya's paths collide, and the unlikely foursome have no choice but to team up to take Roman down.<br></p>
    <a href="#" class="btn">Popular Movies and Tv Series</a>
    </div>
    </div>
    
    
<div class="player">
	<div class="imgBx2">
    <img src="image/im2.png">
    </div>
    <audio controls>
    <source src="audio/Saweetie - Tap In.mp3" type="audio/mp3">
    </audio>
</div>
</div>
    

</section>

<section class="banner2">
  <div class="content">
  <div class="contentBx">
       <h2 class="titleText"> Add New User <a href="users-view.php" class="btn"> Back to User List</a></h2>
      </div>
      </div>
      
       <?php
       
            if(!(empty ($errors))){
                display_errors($errors);
            }
       ?>
       
        <form action ="adduser.php" method ="post" class="userform">
        
  <div class="container6">
        
        <div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" name="First_Name" required="required" <?php echo 'value ="'.$First_Name.'"';?>>
      <span class="text">First Name</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
      <input type="text" name="Last_Name" required="required" <?php echo 'value ="'.$Last_Name.'"';?>>
      <span class="text">Last Name</span>
      
      <span class="line"></span>
    </div>
</div>
</div>
       
<div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" name="User_Name" required="required"<?php echo 'value ="'.$User_Name.'"';?>  >
      <span class="text">User Name</span>
      <span class="line"></span>
    </div>
</div>


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
      <input type="text" name="Telephone" required="required" <?php echo 'value ="'.$Telephone.'"';?>>
      <span class="text">Telephone</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
      <input type="text" name="NIC" required="required"<?php echo 'value ="'.$NIC.'"';?>  >
      <span class="text">NIC</span>
      <span class="line"></span>
    </div>
</div>
</div>
        
<div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" name="Email" required="required" <?php echo 'value ="'.$Email.'"';?>>
      <span class="text">Email</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
      <input type="password" name="User_Password" required="required" >
      <span class="text">User Password</span>
      <span class="line"></span>
    </div>
</div>
</div>

<div class="row100">
	<div class="col">
      <input type="submit" value="Submit Me">
</div>
</div>

</div>
               
        </form>
        
            <ul class="sci">
     <li><a href="#"><img src="image/facebook.png"></a></li>
     <li><a href="#"><img src="image/instagram.png"></a></li>
     <li><a href="#"><img src="image/twitter.png"></a></li>
     </ul>
 </section>  
    
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