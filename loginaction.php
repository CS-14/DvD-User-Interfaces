<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php 
// check for the submission
if (isset ($_POST['loginbtn']) ) 
{  
 
  $errors = array();
  $error = 0;

    // check if the user name and password has been entered
    if(!(isset($_POST['username'] )))
        {         
        $errors[] = 'Username is Missing/Invalid'; 
                
        }

    if(!(isset($_POST['password'] )))
        {       
        $errors[]= 'Password is Missing/ Invalid';      
        }

    //check if there are any errors in the form
    if(empty($errors))
        {
          // save the username and password into variable
          $username = mysqli_real_escape_string($connection,$_POST['username']);
          $password = mysqli_real_escape_string($connection,$_POST['password']);
          $hashed_password =sha1( $password);
          
          // prepare database query
          $query = "SELECT *FROM users 
          WHERE UserName ='{$username}'
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
              $_SESSION['user_name'] = $user['UserName'];
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
              header('Location:customer-page.php');
              }
              // if user is an admin
              if($custype =='admin'){
              header('Location:users-view.php');}

              // if user is the owner
              if($custype =='owner'){
              header('Location:owner-page.php');}

              // if user is the cashier
              if($custype =='cashier'){
              header('Location:cashier-page.php');}

            }else{
              // username and password invalid
              $errors[] = 'Invalid Username/Password';
              $error = 1;
              $_SESSION['error'] = $error;
              header('Location:logininvalid.php');
              
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
 
