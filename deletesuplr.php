<?php session_start(); ?>
<?php
require_once('inc/connection.php');
 ?>


<?php




//View    

    if(isset($_GET['suplr_id'])){

    
          $id=mysqli_real_escape_string($connection,$_GET['suplr_id']);
          //delete movie
          $query="UPDATE supplier SET Is_deleted=1 WHERE SupplierId='{$id}' LIMIT 1";
          
          $result=mysqli_query($connection,$query);
          
          if($result){
             header('Location:supplierlist.php?msg=supplier_deleted');
          
          }
          else{
            header('Location:supplierlist.php?err=delete_failed');
          }



    }
    else{
      header('Location:supplierlist.php');
    }

?>






