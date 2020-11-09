<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php 
$User_Type ='';

if(!isset($_SESSION['user_id'])){
        header("Location: loginform.php");
    }

if (isset($_GET['user_id'])) {
    // getting the user information
    $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
    $query = "SELECT * FROM users WHERE UserId = {$user_id} LIMIT 1";
    $result_set = mysqli_query($connection, $query);
    if ($result_set) {
        if (mysqli_num_rows($result_set) == 1) {
            // user found to delete
            $User_Type = $result['utype'];
        }  
    }

    if($user_id == $_SESSION['user_id']){
        //should not delete current user
        header('Location:users-view.php?err = cannot_delete_current_user'); 
    }else{
        //deleting the user
        $query = "UPDATE users SET is_deleted =1 WHERE UserId= '{$user_id}' LIMIT 1";
        $result = mysqli_query($connection,$query);

        if($result){

            if($User_Type = 'customer'){
        
                $query1 = " UPDATE customer SET is_deleted =1 WHERE UserId= '{$user_id}' LIMIT 1";
                $result2 = mysqli_query($connection , $query1);
                } 
            
            if($User_Type = 'owner'){
        
                $query1 = " UPDATE owners SET is_deleted =1 WHERE UserId= '{$user_id}' LIMIT 1";
                $result2 = mysqli_query($connection , $query1);
                }
                
            if($User_Type = 'admin') {
       
                $query1 = " UPDATE admins SET is_deleted =1 WHERE UserId= '{$user_id}' LIMIT 1";
                $result2 = mysqli_query($connection , $query1);
                } 
            
            if($User_Type = 'cashier'){
                  
                $query1 = " UPDATE cashiers SET is_deleted =1 WHERE UserId= '{$user_id}' LIMIT 1";
                $result2 = mysqli_query($connection , $query1);
                } 

           
        }else{
            header('Location:users.php?err=delete_failed'); 
        }
        if($result2){
            //user deleted
            header('Location:users-view.php?msg=user_deleted'); 
        }

    }     
        
    

   
}else{
    header('Location: users-view .php');
}
?>

