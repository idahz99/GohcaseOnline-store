<?php
include_once("dbconnector.php");
 $email = $_POST['email'];
  $instruction = $_POST['instruction'];
 $productid = $_POST['productid'];
$cartqty = $_POST['cartquantity'];

  
     if($instruction == "add"){
           $newqty = $cartqty+1;
           $sqladd = "UPDATE cart SET Product_q = Product_q + 1 WHERE Product_id = '$productid' AND Email = '$email' ";
         // $sqladd =  "INSERT INTO cart (Product_q) VALUES (  '$newqty') WHERE  Product_id = '$productid' AND Email = '$email'";
          if($conn->query($sqladd ) === TRUE ){
              echo "success";
          }else echo "faileda";
   
             
   
   
     } if($instruction == "remove") {
          $newqty = $cartqty-1;
         $sqlremove = "UPDATE cart SET Product_q = Product_q - 1 WHERE Product_id = '$productid' AND Email = '$email' ";
          if($conn->query($sqlremove) ===TRUE ){
              echo "success";
          }else echo "failedr";
        
         }if($instruction == "delete") {
          $newqty = $cartqty-1;
         $sqlremove = "DELETE FROM cart WHERE  Product_id = '$productid' AND Email = '$email' ";
          if($conn->query($sqlremove) ===TRUE ){
              echo "success";
          }else echo "failedD";
        
         }
         
 
   
 
         

 
 
 
 
 ?>