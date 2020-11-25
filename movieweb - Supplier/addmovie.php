<?php 
require_once('inc/connection.php');
 ?>


<?php


$mid = '';
$mname= '';
$mprice = '';
$mdesc = '';
$catid = '';
$admid = '';
$invid = '';


//Check whether if submitted
if(isset($_POST['submit']))
{

   
$mid = $_POST['DVDid'];
$mname= $_POST['name'];
$mprice = $_POST['price'];
$mdesc = $_POST['description'];
$catid = $_POST['categoryId'];
$admid = $_POST['adminId'];
$invid = $_POST['inventoryId'];




   //checking required feilds
   $req_fields = array('DVDid', 'name', 'price', 'description','categoryId','adminId','inventoryId');

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

$Name=mysqli_real_escape_string($connection,$mname);
$query="SELECT * FROM dvd WHERE  Name='{$Name}'LIMIT 1";

$result_set = mysqli_query($connection, $query);

	if($result_set){
		 if(mysqli_num_rows($result_set)==1){
		    echo 'Movie already exists.';
		 }

		

		else{
			
		// $DVD_Id=mysqli_real_escape_string($connection$mid,);
		// $Name=mysqli_real_escape_string($connection,$mname);
		// $Price=mysqli_real_escape_string($connection,$mprice);
		// $Description=mysqli_real_escape_string($connection,$mdesc);
		// $CategoryId=mysqli_real_escape_string($connection,$catid);
		// $AdminId=mysqli_real_escape_string($connection,$admid);
		// $InventoryId=mysqli_real_escape_string($connection,$invid);

	 


		$query2 = "INSERT INTO dvd (DVD_Id,Name,Price,description,CategoryId,AdminId,InventoryId,Is_deleted)  
		 VALUES (
		'{$mid}', '{$Name}',{$mprice},'{$mdesc}','{$catid}','{$admid}','{$invid}','0')";

        $result = mysqli_query($connection,$query2);
		    
		    if($result){    
		        echo '
                  <script>
                                if(!alert("Movie added successfully")) {
                                    window.location.href = "http://localhost/movieweb/movielist.php"
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











