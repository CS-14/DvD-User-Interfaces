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
            <title>Change Password </title>
            <link rel ="stylesheet" href ="css/users.css">
    </head>

    <body>
        <header>
        <div class ="appname"> User Management System </div>
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! <a href ="logout.php"> Logout </a></div>
    </header>

    <main>
        <h1> Change Password <span> <a href="users-view.php"> < Back to User List</a></span></h1>
      
       <?php
       
            if(!(empty ($errors))){
                display_errors($errors);
            }
       ?>
        <form action ="change-password.php" method ="post" class="userform">
            <input type ="hidden" name="user_id"  value="<?php echo $user_id;?>"> 
        <p>
                <label for="">First Name:</label>
                <input type="text" name="First_Name" <?php echo 'value ="'.$First_Name.'"';?>disabled>
        </p> 
       
        <p>
                <label for = " ">Last Name :</label>
                <input type = "text" name ="Last_Name"<?php echo 'value ="'.$Last_Name.'"';?> disabled>
        </p>

        <p>
                <label for = " ">User Name:</label>
                <input type = "text" name = "User_Name"<?php echo 'value ="'.$User_Name.'"';?>disabled > 
        </p>

        <p>
                <label for = " ">User Type: </label>
                <input type = "text" name = "User_Type"<?php echo 'value ="'.$User_Type.'"';?>disabled > 
        </p>

        <p>
                <label for = " ">Telephone: </label>
                <input type = "text" name = "Telephone"<?php echo 'value ="'.$Telephone.'"';?> disabled> 
        </p>

        <p>
                <label for = " ">NIC: </label>
                <input type = "text" name = "NIC"<?php echo 'value ="'.$NIC.'"';?> disabled> 
        </p>
        
        <p>
                <label for = " ">Addrerss: </label>
                <input type = "text" name = "Addrerss"<?php echo 'value ="'.$Addrerss.'"';?>disabled > 
        </p>

        <p>
                <label for = " ">Email: </label>
                <input type = "email" name = "Email"<?php echo 'value ="'.$Email.'"';?> disabled> 
        </p>

        
        <p>
				<label for="">New Password:</label>
                <input type = "password" name = "User_Password" id ="password" > 
		</p>

        <p>
				<label for="">Show Password:</label>
                <input type = "Checkbox" name = "showpassword" id="showpassword" style="width:20px; height:20px;" > 
		</p>
        
        <p>
                <label for = " ">&nbsp; </label>
                <button type = "submit" name = "submit">Update </button> 
        </p>
             
        </form>
    </main> 
 
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
    </body> 
</html>