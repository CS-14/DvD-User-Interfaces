<?php 
require_once('inc/connection.php');
 ?>


<?php




//View    

    if(isset($_GET['Id'])){

    
          $cid=mysqli_real_escape_string($connection,$_GET['Id']);
          //delete movie
          $query="UPDATE category SET IsDeleted=1 WHERE CategoryId='{$cid}' LIMIT 1";
          
          $result=mysqli_query($connection,$query);
          
          if($result){
             header('Location:categorylist.php?msg=movie_deleted');
          
          }
          else{
            header('Location:categorylist.php?err=delete_failed');
          }



    }
    else{
      header('Location:categorylist.php');
    }

?>






