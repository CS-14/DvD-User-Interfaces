<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
//checking if a user is logged in
/*  if(!isset($_SESSION['user_id'])){
      header("Location: loginform.php");
  }
  */
$userlist = ' ';
$search = ' ';

//getting the list of users
if(isset($_GET['search'])){

    $search = mysqli_real_escape_string($connection,$_GET['search']);
    $query ="SELECT * FROM users WHERE (utype LIKE '%{$search}%' OR UserName LIKE '%{$search}%') AND is_deleted=0 ORDER BY UserId";
}else{
    $query ="SELECT * FROM users WHERE is_deleted=0 ORDER BY UserId";
}


$users =mysqli_query($connection,$query);

if( $users){
    while($user = mysqli_fetch_assoc($users)){
        $userlist .= "<tr>";
        $userlist .= "<td>{$user['UserName']}</td>";
        $userlist .= "<td>{$user['utype']}</td>";
        $userlist .= "<td>{$user['last_login']}</td>";
        $userlist .= "<td><a href=\"modifyuser.php?user_id={$user['UserId']}\">Edit</a></td>" ;
        $userlist .= "<td><a href=\"delete-user.php?user_id={$user['UserId']}\" onclick =\"return confirm('Are you sure?');\">Delete</a></td>" ;
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
    <link rel ="stylesheet" href ="css/users.css">
</head>
<body>
<header>
    <div class ="appname"> User Management System </div>
    <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! <a href ="logout.php"> Logout </a></div>
</header>

<main>
    <h1> Users <span><a href="adduser.php"> + Add New User </a> </span> &ensp; <span><a href="addcustomer.php"> + Add New  Customer </a>&ensp; |&ensp;<a href="users-view.php">  Refresh </a></span> </h1>

    <div class ="search" style ="margin-bottom: 12px;">
        <form action="users-view.php" method="get">
            <p>
                <input type ="text" name ="search" id="" placeholder="Type User Name or User Type and Press Enter"  value="<?php echo $search;?>"  style="width :99%;"required  autofocus>
            </p>

        </form>
    </div>

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