<?php 
 require_once('inc/connection.php');
 ?>

 <?php

// check the submission
if (isset($_POST['submit'])) 
{

$utype = $_POST['utype'];
$first_name = $_POST['fname'];
$last_name =$_POST['lname'];
$user_name = $_POST['uname'];
$cid = $_POST['uid'];
$email = $_POST['email'];
$tele = $_POST['tele'];
$Address = $_POST['addr'];
$password = $_POST['pass'];
$repassword = $_POST['repass'];
// not used here
$hashed_password =sha1($password);



if(empty($utype) || empty($first_name)|| empty($last_name) || empty($user_name) || empty($cid)|| empty($email) ||empty($tele)|| empty($Address)||empty($password)|| empty($repassword))
    { echo "Please Check Inputs";}

else{

    if($password != $repassword ){
        echo "Please Check Password";
    }
    else {

        
        // insert data to user table
        $query1 = " INSERT INTO users (utype,UserName,cpassword,Email)
        VALUES('{$utype}','{$user_name}','{$password}','{$email}') ";

        $result1 = mysqli_query($connection , $query1 );

        // select specific user id 
        $query2 = " SELECT UserId FROM users WHERE  UserName ='{$user_name}'";
        $result2 = mysqli_query($connection , $query2);
 
        
         
        if($result2->num_rows >0){
            while($row = $result2->fetch_assoc())
            {
                $uid = $row["UserId"];
            }
        
        }

        if ($result1)
        {

            if($utype = 'customer')
            {
            $query3 = " INSERT INTO customer (Cpassword,FirstName,LastName,UserName,HAddress,Email,Telephone,CustomerId,UserId)
            VALUES('{$password}','{$first_name}','{$last_name}','{$user_name}','{$Address}','{$email}','{$tele}','{$cid}',{$uid})";
            $result3 = mysqli_query($connection , $query3);
            }

           
        }

        if($result3){
            echo "Successfully record Added!";
        }else{
            echo "error";
        }
        


    }
}
}

else if(isset($_POST['back_btn']))
  {
    header("Location: homepage.php");
  }


?>

