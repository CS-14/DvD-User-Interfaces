<?php
if(isset($_POST['submit'])){
    //
   $file_name =$_FILES['image']['name'];
   $file_type =$_FILES['image']['type'];
   $file_size =$_FILES['image']['size'];
   $temp_name =$_FILES['image']['tmp_name'];

   $upload_to = 'image/';
   move_uploaded_file($temp_name,$upload_to .$file_name);
}
?>




<! DOCTYPE html>
<html lang ="en">
<head>
<meta charset="UTF-8">
<title>Image Upload</title>
<style>
    .container {width:960px; margin:0 auto;}
</style>

</head>
<body>
<div class ="container">
    <h1>Image Upload</h1>
    <h3>Choose an Image and Click Upload</h3>

    <form action="imageupload.php" method ="post" enctype="multipart/form-data">
        <input type ="file" name ="image" id ="">
        <button type ="submit" name ="submit">Upload</button>
    </form>

</div>
</body>


</html>