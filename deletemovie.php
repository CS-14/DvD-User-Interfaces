<?php session_start(); ?>
<?php
require_once('inc/connection.php');
 ?>


<?php




//View    

    if(isset($_GET['Id'])){

    
          $mid=mysqli_real_escape_string($connection,$_GET['Id']);
          //delete movie
          $query="UPDATE dvd SET Is_deleted=1 WHERE DVD_Id='{$mid}' LIMIT 1";
          
          $result=mysqli_query($connection,$query);
          
          if($result){
             header('Location:movielist.php?msg=movie_deleted');
          
          }
          else{
            header('Location:movielist.php?err=delete_failed');
          }



    }
    else{
      header('Location:movielist.php');
    }

?>






