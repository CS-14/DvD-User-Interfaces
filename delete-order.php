<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php
$order_Type ='';
/*
if(!isset($_SESSION['user_id'])){
    header("Location: loginform.php");
}
*/
if (isset($_GET['RefNo'])) {
    // getting the user information
    $RefNo = mysqli_real_escape_string($connection, $_GET['RefNo']);
    $query = "SELECT * FROM orderstable WHERE RefNo = {$RefNo} LIMIT 1";
    $result_set = mysqli_query($connection, $query);
    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            // user found to delete
            $order_Type = $result['Payment_method'];
        }
    }


        //deleting the order
        $query1 = "UPDATE orderstable SET is_deleted =1 WHERE RefNo= '{$RefNo}' LIMIT 1";
        $result1 = mysqli_query($connection,$query1);

        if($result1){
            //user deleted
            header('Location:orders-view.php?msg=user_deleted');
        }

}

else{
    header('Location:orders-view.php?err=delete_failed');

}
?>

