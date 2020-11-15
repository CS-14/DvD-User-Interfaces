<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    //checking if a user is logged in
  /*  if(!isset($_SESSION['user_id'])){
        header("Location: loginform.php");
    }
    */
    $orderlist = ' ';
    $search = ' ';
    
    //getting the list of users
    if(isset($_GET['search'])){

        $search = mysqli_real_escape_string($connection,$_GET['search']);
        $query ="SELECT * FROM orderstable WHERE (UserName LIKE '%{$search}%' OR ODate LIKE %{$search}% OR RefNo LIKE '%{$search}%') AND is_deleted=0 ORDER BY RefNo";
    }else{
        $query ="SELECT * FROM orderstable WHERE (is_deleted=0 AND Confirmation=0) ORDER BY RefNo";
    }
   
    
    $orders =mysqli_query($connection,$query);

    if( $orders){
        while($order = mysqli_fetch_assoc($orders)){
            $orderlist .= "<tr>";
            $orderlist .= "<td>{$order['RefNo']}</td>";
            $orderlist .= "<td>{$order['UserName']}</td>";
            $orderlist .= "<td>{$order['Customer_email']}</td>"; 
            $orderlist .= "<td>{$order['Payment_method']}</td>"; 
            $orderlist .= "<td>{$order['TotalCost']}</td>"; 
            $orderlist .= "<td>{$order['ODate']}</td>";  
            $orderlist .= "<td><a href=\"confirm_orders.php?RefNo={$order['RefNo']}\">confirm</a></td>" ;             
            $orderlist .= "<td><a href=\"delete-order.php?RefNo={$order['RefNo']}\" onclick =\"return confirm('Are you sure?');\">Delete</a></td>" ;   
        }

    }else{
        echo "Database query failed";
    }
?>

<!DOCTYPE html>
<html>  
<head>
    <meta charset ="UTF-8">
    <title>Orders </title>
    <link rel ="stylesheet" href ="css/users.css">
</head>
<body>
    <header>
        <div class ="appname"> Orders Management System </div>
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! <a href ="logout.php"> Logout </a></div>
    </header>

<main>
    <h1> Orders <span><a href="addorder.php"> + Add New Order </a> </span>  </h1>
   
   <div class ="search" style ="margin-bottom: 12px;">
        <form action="users-view.php" method="get">         
            <p>
            <input type ="text" name ="search" id="" placeholder="Type User Name or Date  or RefNo and Press Enter"  value="<?php echo $search;?>"  style="width :99%;"required  autofocus>
            </p> 
       
        </form>
   </div>

   <table class = "masterlist">
    <tr>       
        <th>Reference No </th>
        <th>User Name</th>
        <th> Customer Email</th>
        <th> Payment method</th>
        <th> Total Cost</th>
        <th> Ordered Date</th>
        <th>Confirmation</th>
        <th>Delete</th>
    </tr>  
    <?php echo $orderlist; ?>
     </table> 
</main> 

</body>

</html>