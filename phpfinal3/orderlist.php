<?php
include_once("dbconnector.php");
 $email = $_POST['email'];
 
 
   
  $sqlloadhistory = "SELECT * FROM order_history  WHERE order_history.email = '$email' ORDER BY date DESC";
 
  $result = $conn->query($sqlloadhistory);
if ($result->num_rows > 0){
    $response["orders"] = array();
    while ($row = $result -> fetch_assoc()){
        $orderlist = array();
        $orderlist['orderid'] = $row['orderid'];
        $orderlist['name'] = $row['name'];
        $orderlist['email'] = $row['email'];
        $orderlist['address'] = $row['address'];
        $orderlist['amount'] = $row['amount'];
        $orderlist['orderdate'] = $row['date'];
       
       array_push($response["orders"],$orderlist);
    }
    echo json_encode($response);
}else{
    echo "nodata";
}
