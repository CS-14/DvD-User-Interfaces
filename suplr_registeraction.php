<?php session_start(); ?>
<?php
 require_once('inc/connection.php');
 ?>

 <?php

// check the submission
if (isset($_POST['submit'])) 
{


$fname = $_POST['fname'];
$lname = $_POST['lname'];
$sid = $_POST['uid'];
$email = $_POST['email'];
$tele = $_POST['tele'];
$Address = $_POST['addr'];
$cat=$_POST['category'];





    if(empty($fname)|| empty($lname) || empty($sid)|| empty($email) ||empty($tele)|| empty($Address)||empty($cat))
        { echo "Please Check Inputs";}
 


    else{  


               // if(!is_email($_POST['email'])){
               //     echo "Email address is invalid.";
               //   }

                $id=mysqli_real_escape_string($connection,$sid);
                $query="SELECT * FROM supplier WHERE  SupplierId='{$id}'LIMIT 1";

                $result_set = mysqli_query($connection, $query);

                if($result_set){
                    if(mysqli_num_rows($result_set)==1){
                        echo 'Supplier already exists.';
                    }
                
                    else{
                        // insert data to user table
                        $query1 = " INSERT INTO supplier (SupplierId,FirstName,LastName,Address,Email,PhoneNo,is_deleted,Categories)
                        VALUES('{$sid}','{$fname}','{$lname}','{$Address}','{$email}','{$tele}','{0}','{$cat}') ";

                        $result1 = mysqli_query($connection , $query1 );

                        
                        if ($result1){ echo '<script>
                                if(!alert("Supplier added successfully")) {
                                    window.location.href = "http://localhost/movieweb/supplierlist.php"
                                }
                  </script>'; } 
                        else{echo "$query1";}
                            
                        
                    }
               
           }
    
        }
}
// else if(isset($_POST['back_btn']))
//   {
//     header("Location: homepage.php");
//   }
?>









