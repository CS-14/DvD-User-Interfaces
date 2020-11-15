<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/function.php'); ?>
<?php 

$errors = array();
$RefNo = '';
$Order_date ='';
$User_Name ='';
$Description ='';
$cost ='';
$pay_method ='';
$Email ='';
$CusId='';

//$User_Password ='';

if(isset($_POST['submit']))
{
    $RefNo = $_POST['RefNo'];
    $Order_date =$_POST['Order_date'];
    $User_Name =$_POST['User_Name'];
    $Description =$_POST['Descrition'];
    $cost =$_POST['cost'];
    $pay_method =$_POST['paymethod'];
    $Email =$_POST['Email'];
    $CusId =$_POST['CusId'];
       
   

    //checking required fileds

    $req_fields =array('RefNo','Order_date','User_Name','Descrition','cost','paymethod','Email','CusId');
    $errors = array_merge($errors,check_req_fields($req_fields));

    //checking max length

    $max_length_fields = array('RefNo'=>100,'User_Name'=>50,'Descrition'=>200,'cost'=>100,'paymethod'=>20,'Email'=>50,'CusId'=>50);
    $errors = array_merge($errors,check_max_length($max_length_fields));
       
          
    // checking email address
    if(!is_email($_POST['Email'])){
        $errors[]='Email address is invalid.';
    }
    
    
    // checking email address is registered one
    $email = mysqli_real_escape_string($connection,$_POST['Email']);
    $query0 ="SELECT * FROM customer WHERE (Email ='{$Email}' AND UserName='{$User_Name}') LIMIT 1";

    $result_set0 =mysqli_query($connection,$query0);

    if($result_set0){
        if(mysqli_num_rows($result_set0)==0){
            $errors[]='Email Address is not Registered!';
        }
    }


    // checking CustomerId is registered one
    $email = mysqli_real_escape_string($connection,$_POST['CusId']);
    $query3 ="SELECT * FROM customer WHERE (CustomerId ='{$CusId}' AND UserName='{$User_Name}') LIMIT 1";

    $result_set3 =mysqli_query($connection,$query3);

    if($result_set3){
        if(mysqli_num_rows($result_set3)==0){
            $errors[]='Customer Id is not Valid!';
        }
    }

    //checking username already exixts(Registered customer)
    $uname = mysqli_real_escape_string($connection,$_POST['User_Name']);
    $query1 ="SELECT * FROM customer WHERE UserName ='{$uname}' LIMIT 1";

    $result_set1 =mysqli_query($connection,$query1);

    if($result_set1){
        if(mysqli_num_rows($result_set1)==0){
            $errors[]='Customer is not registered!';
        }
    }

//add data to the table
if(empty($errors)){
    // no errors found
    // to secure data use real scape function
    $RefNo  = mysqli_real_escape_string($connection,$_POST['RefNo']);
    $Order_date = mysqli_real_escape_string($connection,$_POST['Order_date']);
    // email and username is already sanitized
    $Description =mysqli_real_escape_string($connection,$_POST['Descrition']);
    $cost = mysqli_real_escape_string($connection,$_POST['cost']);
    $CusId =mysqli_real_escape_string($connection,$_POST['CusId']);
    $pay_method = mysqli_real_escape_string($connection,$_POST['paymethod']);
    
   

   // insert data to order table
    $query2 = " INSERT INTO orderstable (RefNo,ODate,TotalCost,CustomerId,UserName,Payment_method,Customer_email,ODescription)
    VALUES('{$RefNo}','{$Order_date}','{$cost}','{$CusId}','{$uname}','{$pay_method}','$Email','{$Description}') ";

    $result = mysqli_query($connection , $query2);
  echo($Order_date);

  
    if($result){
        header('Location:orders-view.php');
    }else{
        echo "error!";
    }
}




}
?>

<!DOCTYPE html>
<html> 

<head>
        <meta charset ="UTF-8">
        <title>Add New Order </title>
        <link rel ="stylesheet" href ="css/users.css">
</head>

<body>
    <header>
        <div class ="appname"> User Management System </div>
        <div class ="logedin"> Welcome <?php echo ($_SESSION['user_name']); ?> ! <a href ="logout.php"> Logout </a></div>
    </header>

    <main>
        <h1> Add New Order <span> <a href="orders-view.php"> < Back to Order List</a></span></h1>
      
       <?php
       
            if(!(empty ($errors))){
                display_errors($errors);
            }
       ?>
        <form action ="addorder.php" method ="post" class="userform">

        <p>
        <label for="">Reference No:</label>
        <input type="text" name="RefNo" <?php echo 'value ="'.$RefNo.'"';?>>
        </p> 

        <p>
        <label for = " ">Ordered Date: </label>
        <input type = "date" name = "Order_date"<?php echo 'value ="'.$Order_date.'"';?> >
        </p>
       
        <p>
        <label for = " ">User Name :</label>
        <input type = "text" name ="User_Name"<?php echo 'value ="'.$User_Name.'"';?> >
        </p>

        <p>
        <label for = " ">CustomerId :</label>
        <input type = "text" name ="CusId"<?php echo 'value ="'.$CusId.'"';?> >
        </p>

        <p>
        <label for = " ">Description:</label>
        <input type = "text" name = "Descrition"<?php echo 'value ="'.$Description.'"';?> > 
        </p>

        <p>
        <label for = " ">Cost: </label>
        <input type = "text" name = "cost"<?php echo 'value ="'.$cost.'"';?> > 
        </p>

        <p>
        <label for = " ">Payment Method: </label>
        <input type = "text" name = "paymethod"<?php echo 'value ="'.$pay_method.'"';?> >
        </p>

        <p>
        <label for = " ">Customer Email: </label>
        <input type = "email" name = "Email"<?php echo 'value ="'.$Email.'"';?> > 
        </p>
        
      

        <p>
        <label for = " ">&nbsp; </label>
        <button type = "submit" name = "submit"> Save </button> 
        </p>
             
        </form>
    </main> 


 </body>
</html>