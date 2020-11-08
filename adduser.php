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
<!DOCTYPE html>
<html> 

<head>
        <meta charset ="UTF-8">
        <title>Add New User </title>
        <link rel ="stylesheet" href ="css/users.css">
</head>

<body>
    <header>
        <div class ="appname"> User Management System </div>
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! <a href ="logout.php"> Logout </a></div>
    </header>

    <main>
        <h1> Add New User <span> <a href="users-view.php"> < Back to User List</a></span></h1>
      
       <?php
       
            if(!(empty ($errors))){
                display_errors($errors);
            }
       ?>
        <form action ="adduser.php" method ="post" class="userform">

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
                <label for = " ">Email: </label>
                <input type = "email" name = "Email"<?php echo 'value ="'.$Email.'"';?> > 
        </p>

        <p>
                <label for = " ">User_Password: </label>
                <input type = "password" name = "User_Password" > 
        </p>

        <p>
                <label for = " ">&nbsp; </label>
                <button type = "submit" name = "submit"> Save </button> 
        </p>
             
        </form>
    </main> 


 </body>
</html>