<?php 
require_once('inc/connection.php');
 ?>


<?php


//$errors=array();
// $mid = '';
// $mname= '';
// $mprice = '';
// $mdesc = '';
// $catid = '';
// $admid = '';
// $invid = '';


//Check whether if submitted
if(isset($_POST['submit']))
{

   
$cid = $_POST['categoryId'];
$cname= $_POST['name'];
$cdesc = $_POST['description'];
// $admid = $_POST['adminId'];




   //checking required feilds
   $req_fields = array('categoryId', 'name',  'description');

		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
				echo $field . ' is required';
			}
		}

//check whether the lengths are correct


/*$max_len_fields=array('DVD_Id' => 50,'Name' => 50, 'Price' => 100, 'Description' => 300, 'CategoryId' => 50,'AdminId' => 50,'InventoryId' => 50, );
foreach($max_len_fields as $field => $max_len){
 if(strlen(trim($field)) > $max_len){ 
    $errors[] = $field . ' must be less than ' . $max_len . ' characters' ;
 }

}*/

//check whether the dvd already exists in the system

$Name=mysqli_real_escape_string($connection,$cname);
$query="SELECT * FROM category WHERE  CategoryName='{$Name}'LIMIT 1";

$result_set = mysqli_query($connection, $query);

	if($result_set){
		 if(mysqli_num_rows($result_set)==1){
		    echo 'Category already exists.';
		 }

		

		else{
			//echo "my";
		// $DVD_Id=mysqli_real_escape_string($connection$mid,);
		// //$Name=mysqli_real_escape_string($connection,$mname);
		// $Price=mysqli_real_escape_string($connection,$mprice);
		// $Description=mysqli_real_escape_string($connection,$mdesc);
		// $CategoryId=mysqli_real_escape_string($connection,$catid);
		// $AdminId=mysqli_real_escape_string($connection,$admid);
		// $InventoryId=mysqli_real_escape_string($connection,$invid);

	 //    echo $DVD_Id;
		// echo $Name;
		// echo $Price;
		// echo $Description;
		// echo $CategoryId;
		// echo $AdminId;
		// echo $InventoryId;


		$query2 = "INSERT INTO category (CategoryId,CategoryName,Description,AdminId,IsDeleted)  
		 VALUES (
		'{$cid}', '{$Name}','{$cdesc}','784582637V','0')";

        $result = mysqli_query($connection,$query2);
		    
		    if($result){

				header("Location: categorylist.php");
		        echo '
                  <script>
                                if(!alert("Category added successfully")) {
                                    window.location.href = "http://localhost/movieweb/categorylist.php"
                                }
                  </script>
              
                ';

            }
			else
			{
				 echo'error';
			}


		}

    }

}



?>











