<?php
include_once("dbconnector.php");
 $email = $_POST['email'];
 
 
   
  $sqlloadcart = "SELECT * FROM cart INNER JOIN table_products ON cart.Product_id = table_products.product_id WHERE cart.Email = '$email'";
 
  $result = $conn->query($sqlloadcart);
if ($result->num_rows > 0){
    $response["cart"] = array();
    while ($row = $result -> fetch_assoc()){
        $prlist = array();
        $prlist['productid'] = $row['product_id'];
        $prlist['productname'] = $row['product_name'];
        $prlist['productprice'] = $row['product_price'];
        $prlist['productquantity'] = $row['product_quantity'];
        $prlist['cartquantity'] = $row['Product_q'];
       
       
       array_push($response["cart"],$prlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}



?>