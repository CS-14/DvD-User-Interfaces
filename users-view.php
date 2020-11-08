<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    //checking if a user is logged in
  /*  if(!isset($_SESSION['user_id'])){
        header("Location: loginform.php");
    }
    */
    $userlist = ' ';

    //getting the list of users
    $query ="SELECT * FROM users ORDER BY UserId";
    $users =mysqli_query($connection,$query);

    if( $users){
        while($user = mysqli_fetch_assoc($users)){
            $userlist .= "<tr>";
            $userlist .= "<td>{$user['UserName']}</td>";
            $userlist .= "<td>{$user['utype']}</td>"; 
            $userlist .= "<td>{$user['last_login']}</td>"; 
            $userlist .= "<td><a href=\"modifyuser.php?user_id={$user['UserId']}\">Edit</a></td>" ;    
            $userlist .= "<td><a href=\"delete-user.php?user_id={$user['UserId']}\">Delete</a></td>" ;    
        }

    }else{
        echo "Database query failed";
    }
?>

<!DOCTYPE html>
<html>  
<head>
    <meta charset ="UTF-8">
    <title>Users </title>
    <link rel ="stylesheet" href = "css/users.css">
</head>
<body>
    <header>
        <div class ="appname"> User Management System </div>
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! <a href ="logout.php"> Logout </a></div>
    </header>

<main>
    <h1> Users <span><a href="adduser.php"> + Add New User </a> </span> &ensp; <span><a href="addcustomer.php"> + Add New  Customer </a> </span> </h1>
   <table class = "masterlist">
    <tr>       
        <th>User Name </th>
        <th>User Type</th>
        <th>Last Login </th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>  
    <?php echo $userlist; ?>
     </table> 
</main> 

</body>

</html>