<?php
include_once("dbconnector.php");
 
  $productid = $_POST['productid'];
 

  $sqlproduct  = "SELECT * FROM table_products WHERE product_id = '$productid' ";
   $resultproduct = $conn->query($sqlproduct);
   
  $sqlproductcart  = "SELECT * FROM cart WHERE Product_id = '$productid' ";
   $resultcart = $conn->query($sqlproductcart);
   
   
   
 //$sqlresultmod = $conn->query($sqlmod ===TRUE );
      if( $resultproduct->num_rows > 0) {
          $sqldelete = "DELETE FROM table_products WHERE  product_id = '$productid'";
          if($conn->query( $sqldelete) ===TRUE ){
            $path ='../images/products/'.$productid.'.png';
            unlink($path);
            echo "success";
          }else echo "failedP";
         }
         if($resultcart->num_rows > 0) {
          $sqldelete = "DELETE FROM cart WHERE  Product_id = '$productid'";
          if($conn->query( $sqldelete) ===TRUE ){
           echo "success";
          }else echo "failedC";
        
         }
         
 
   
 
         

 
 
 
 
 ?>