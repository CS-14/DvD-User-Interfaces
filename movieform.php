<?php session_start(); ?>
<?php
require_once('inc/connection.php');
 ?>

<?php

$mid = '';
$mname= '';
$mprice = '';
$mdesc = '';
$catid = '';

$errors = array();

if(isset($_POST['upload'])){
    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    $temp_name = $_FILES['image']['tmp_name'];

    $upload_to = 'image/';
    // checking the file type
    if ($file_type != 'image/jpeg') {
        $errors[] = 'Only JPEG files are allowed.';
    }

    // checking file size
    if ($file_size > 2500000) {
        $errors[] = 'File size should be less than 2.5Mb.';
    }

    if (empty($errors)) {
        $file_uploaded = move_uploaded_file($temp_name, $upload_to . $file_name);
    }}




    //Check whether if submitted
if(isset($_POST['submit']))
{  

$mname= $_POST['name'];
$mprice = $_POST['price'];
$mdesc = $_POST['description'];
$catid = $_POST['categoryId'];

// $admid = $_POST['adminId'];
// $invid = $_POST['inventoryId'];




   //checking required feilds
   $req_fields = array( 'name', 'price', 'description','categoryId');

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

	 


		$query2 = "INSERT INTO dvd (Name,Is_Movie,Is_TV_Series,Price,description,CategoryId,AdminId,InventoryId,Is_deleted)  
		 VALUES (
		'{$Name}',1,0,{$mprice},'{$mdesc}',{$catid},'784582637V','1',0)";

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
				 echo 'error';
			}


		}

    }





}
?>

<!DOCTYPE html>
<html>
<head>  

<meta charset ="UTF-8">
<title>Add New Movie </title>
<link rel ="stylesheet" href ="css/stylet.css">
<link rel ="stylesheet" href ="css/category_Nav.css">
<link rel ="stylesheet" href ="css/category_Foot.css">
<link rel ="stylesheet" href ="css/category_Form.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
 
</head>

<body>


<section class="banner2">

    <header>
        <a href="#" class="logo"> Add Movie</a>

        <br >
        <div class ="logedin" style="color: lightseagreen;"> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="owner-view.php">Home</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#"></a></li>

        </ul>

    </header>
      
       
 <?php
           if(!empty($errors)){
            echo '<div class="errmsg">';
            echo '<b>There were Errors in your form.</b>' ;
            foreach ($errors as $error){

                echo $error . '<br>';
            }
            
            echo '</div>';
           }


 ?>


    <div class="content">
        <div class="contentBx">

            <h3 class="textTitle"><a href="movielist.php" class="btn"> < Back to Movie List</a></h3>
        </div>
    </div>
    
     <form action ="movieform.php"  method ="post" >  
          
<div class="container6">
        
        <div class="row100">


<div class="col">
      <div class="inputBox">
    <input type="text" name="name" required >
      <span class="text">Movie Name:</span>
      <span class="line"></span>
    </div>
</div>
</div>

     <div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" name="price" required>
                 
         <span class="text">Price:</span>
      <span class="line"></span>
    </div>
</div>

<div class="col">
      <div class="inputBox">
     <input type="text" name="description"  required >
      <span class="text">Description:</span>
      <span class="line"></span>
    </div>
</div>
</div>

   <div class="row100">
	<div class="col">
      <div class="inputBox">
      <input type="text" name="categoryId"  required    >
      <span class="text">Category Id:</span>  
      <span class="line"></span>
    </div>
</div>
</div>


  
<div class="row100">
	<div class="col">
      <div class="inputBox">
      <?php
    if (!empty($errors)) {
        echo '<div class="errors">';
        echo '<b>File not uploaded. Check following errors:</b><br>';
        foreach ($errors as $error) {
            echo '- ' . $error;
        }
        echo '</div>';
    }

    ?>
      
      <form action="movieform.php" method ="post" enctype="multipart/form-data">      
      <input type ="file" name ="image" id ="" ><br>
      <p>Note: JPEG files less than 2.5Mb only.</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="upload" >Upload</button ><br> 
      </form>
      <?php
    if (isset($file_uploaded)) {
        echo '<h3>Uploaded File</h3>';
        echo '<img src="' . $upload_to . $file_name . '" style="height:200px">';
    }

    ?>
      </div>
     </div>
</div>
<br>
    <p>
  <label for="">&nbsp;</label>
  <button type="submit" name="submit" class="save_button" >Save</button >
</p>
</form>

  </div>
  
</section>
  

    
</body>
</html>