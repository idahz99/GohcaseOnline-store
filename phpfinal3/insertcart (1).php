<?php
include_once("dbconnector.php");

$email = $_POST["email"];
$productid = $_POST["productid"];

$sqlcheckstock ="SELECT * FROM table_products WHERE product_id = '$productid' ";
$sqlresultstock = $conn->query($sqlcheckstock);
if($sqlresultstock->num_rows > 0){
    while($row = $sqlresultstock->fetch_assoc()){
        $productquantity = $row['product_quantity']; ///
        if($productquantity == 0){
            echo "failedA";
            return;
        }else{
           $sqlcheckcart = "SELECT * FROM cart WHERE Product_id = '$productid' AND Email = '$email' ";
            $sqlresultcheckcart = $conn->query($sqlcheckcart);
            if($sqlresultcheckcart->num_rows == 0){
              $sqlinsertcart = "INSERT INTO cart (Email,Product_id,Product_q) VALUES ('$email','$productid','1')";
            if ($conn-> query ($sqlinsertcart)=== TRUE){
                 echo "successa";
            }else{ echo "failedB";
                
            }
                
            }else{
               $sqlupdatecart = "UPDATE cart SET Product_q = Product_q + 1 WHERE Product_id = '$productid' AND Email = '$email' ";
            if ($conn-> query ($sqlupdatecart)=== TRUE) {
                echo "successb";
            }else {
               echo "failedC"; 
            }
            }
        }
    }
}else{
    echo "failedE";
}



?>