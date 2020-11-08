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
    $query2 = " UPDATE users SET UserName = '{$uname}',Email ='{$email}'WHERE UserId ='{$user_id}' LIMIT  1";
    $result = mysqli_query($connection , $query2); 
    
    
    if ($result){
       

     if($User_Type = 'customer'){
        
        $query4 = " UPDATE customer SET FirstName = '{$First_Name}',LastName ='{$Last_Name}',UserName ='{$User_Name}',HAddress = '$Addrerss',Email ='{$Email}',Telephone='{$Telephone}',CustomerId ='{$NIC}'
        WHERE UserId ='{$user_id}' LIMIT  1";
        $result3 = mysqli_query($connection , $query4);
        } 

    if($User_Type = 'owner'){
        
        $query4 = " UPDATE owners SET First_Name ='{$First_Name}',Last_Name='{$Last_Name}',UserName='{$User_Name}',Email='{$Email}',ContactNo='{$Telephone}',OwnerId='{$NIC}' WHERE UserId ='{$user_id}' LIMIT  1 ";
        $result3 = mysqli_query($connection , $query4);
        } 

    if($User_Type = 'admin') {
       
        $query4 = " UPDATE admins SET FirstName='{$First_Name}',LastName='{$Last_Name}',UserName='{$User_Name}',Email='{$Email}',ContactNo='{$Telephone}',AdminId='{$NIC}' WHERE UserId ='{$user_id}' LIMIT  1 ";
        $result3 = mysqli_query($connection , $query4);
        } 

    if($User_Type = 'cashier'){
      
        $query4 = " UPDATE cashiers SET First_Name='{$First_Name}',Last_Name='{$Last_Name}',UserName='{$User_Name}',Email= '{$Email}',ContactNo='{$Telephone}',CashierId ='{$NIC}'  WHERE UserId ='{$user_id}' LIMIT  1 ";
        $result3 = mysqli_query($connection , $query4);
        } 
   
     }

   if($result3){
        header('Location:users-view.php ? user_modified=true');
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
            <title>Modify User </title>
            <link rel ="stylesheet" href ="css/users.css">
    </head>

    <body>
        <header>
        <div class ="appname"> User Management System </div>
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! <a href ="logout.php"> Logout </a></div>
    </header>

    <main>
        <h1> Modify/View User <span> <a href="users-view.php"> < Back to User List</a></span></h1>
      
       <?php
       
            if(!(empty ($errors))){
                display_errors($errors);
            }
       ?>
        <form action ="modifyuser.php" method ="post" class="userform">
            <input type ="hidden" name="user_id"  value="<?php echo $user_id;?>"> 
        <p>
                <label for="">First Name:</label>
                <input type="text" name="First_Name" <?php echo 'value ="'.$First_Name.'"';?>>
        </p> 
       
        <p>
                <label for = " ">Last Name :</label>
                <input type = "text" name ="Last_Name"<?php echo 'value ="'.$Last_Name.'"';?> >
        </p>

        <p>
                <label for = " ">User Name:</label>
                <input type = "text" name = "User_Name"<?php echo 'value ="'.$User_Name.'"';?> > 
        </p>

        <p>
                <label for = " ">User Type: </label>
                <input type = "text" name = "User_Type"<?php echo 'value ="'.$User_Type.'"';?> > 
        </p>

        <p>
                <label for = " ">Telephone: </label>
                <input type = "text" name = "Telephone"<?php echo 'value ="'.$Telephone.'"';?> > 
        </p>

        <p>
                <label for = " ">NIC: </label>
                <input type = "text" name = "NIC"<?php echo 'value ="'.$NIC.'"';?> > 
        </p>
        
        <p>
                <label for = " ">Addrerss: </label>
                <input type = "text" name = "Addrerss"<?php echo 'value ="'.$Addrerss.'"';?> > 
        </p>

        <p>
                <label for = " ">Email: </label>
                <input type = "email" name = "Email"<?php echo 'value ="'.$Email.'"';?> > 
        </p>

        
        <p>
				<label for="">User:</label>
				<span>******</span> | <a href="change-password.php?user_id=<?php echo $user_id;?>">Change Password</a>
		</p>

        <p>   <?php echo 'Password'; ?> </p>
        <p>
                <label for = " ">&nbsp; </label>
                <button type = "submit" name = "submit"> Save </button> 
        </p>
             
        </form>
    </main> 


 </body>
</html>
	
