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

if (isset($_GET['user_id'])) {
    // getting the user information
    $user_id = mysqli_real_escape_string($connection,$_GET['user_id']);
    $query = "SELECT * FROM users WHERE UserId = {$user_id} LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            // user found
            $result = mysqli_fetch_assoc($result_set);
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
    $User_Type =$_POST['User_Type'];
    $Telephone =$_POST['Telephone'];
    $NIC =$_POST['NIC'];
    $Email =$_POST['Email'];

    

    //checking required fileds

    $req_fields =array('user_id','First_Name','Last_Name','User_Type','Telephone','NIC','Email');
    $errors = array_merge($errors,check_req_fields($req_fields));

    //checking max length

    $max_length_fields = array('First_Name'=> 50,'Last_Name'=>50,'User_Type'=>10,'Telephone'=>10,'NIC'=>100,'Email'=>50);
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


   // modify data in user table
    $query2 = " UPDATE users SET FirstName='{$First_Name}', Email ='{$email}'WHERE UserId ='{$user_id}' LIMIT  1";
    $result = mysqli_query($connection , $query2);    

    if ($result){
        {
            if($User_Type =='owner')
            {
                $query4 = " UPDATE owners SET First_Name ='{$First_Name}',Last_Name='{$Last_Name}',Email='{$Email}',ContactNo='{$Telephone}',OwnerId='{$NIC}' WHERE UserId ='{$user_id}' LIMIT  1 ";
                $result3 = mysqli_query($connection , $query4);

                $result3 = mysqli_query($connection , $query4);
            }

            if($User_Type == 'admin')
            {
                $query4 = " UPDATE admins SET FirstName='{$First_Name}',LastName='{$Last_Name}',Email='{$Email}',ContactNo='{$Telephone}',AdminId='{$NIC}' WHERE UserId ='{$user_id}' LIMIT  1 ";
                $result3 = mysqli_query($connection , $query4);

                $result3 = mysqli_query($connection , $query4);
            }

            if($User_Type == 'cashier')
            {
                $query4 = " UPDATE cashiers SET First_Name='{$First_Name}',Last_Name='{$Last_Name}',Email= '{$Email}',ContactNo='{$Telephone}',CashierId ='{$NIC}'  WHERE UserId ='{$user_id}' LIMIT  1 ";
                $result3 = mysqli_query($connection , $query4);

                $result3 = mysqli_query($connection , $query4);
            }

    }

   if($result3)
    {
        header('Location:usv.php ? user_modified=true');
    }
    else{
        echo("error!");
    }
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
         <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="css/admin1.css">
    <link rel="stylesheet" href="css/admin1_chart.css">
    <link rel="stylesheet" href="css/admin1_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>

<body>
    
    <section class="banner2">

        <header>
            <a href="#" class="logo"> Modify/View Users</a>

            <br >
            <div class ="logedin"> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

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
        <form action ="modifyuser.php" method ="post" class="userform">
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



<div class="row100">
	<div class="col">
      <div class="inputBox"> 
      <span class="text">User***: <?php echo 'Password'; ?></span>
       <br>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href="change-password.php?user_id=<?php echo $user_id;?>" class="btn">Change Password</a>
    </div>
</div>
<br>

<div class="row100">
	<div class="col">
      <input type="submit"  name="submit" value="Submit Me">
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