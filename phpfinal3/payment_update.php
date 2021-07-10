<?php
error_reporting(0);
include_once("dbconnector.php");

$email = $_GET['email'];
$phone = $_GET['phone'];
$name = $_GET['name'];
$amount = $_GET['amount'];
$address = $_GET['address'];

$Name=     "".$name;
$Address= "".$address;
$Email    = "".$email;
$Amount = "60";
$Phone = "".$phone;



$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'] ,
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];

if ($paidstatus=="true"){
  $receiptid = $_GET['billplz']['id'];
  $signing = '';
    foreach ($data as $key => $value) {
        $signing.= 'billplz'.$key . $value;
        if ($key === 'paid') {
            break;
        } else {
            $signing .= '|';
        }
    }
   // UPDATE cart SET id = '$receiptid' WHERE Email ='$email'
      $sqlinsertid = "UPDATE cart SET id = '$receiptid' WHERE Email ='$email' ";
      $sqlin = "INSERT INTO order_history (order_history.orderid,order_history.name,order_history.email,order_history.address,order_history.amount) VALUES ('$receiptid','$name','$email','$address','$amount')";
    
    if (($conn->query( $sqlin) === TRUE)&&($conn->query(  $sqlinsertid) === TRUE)){
        
         $updatestock = "UPDATE table_products ,cart
      SET product_quantity = table_products.product_quantity - cart.Product_q
      WHERE table_products.product_id = cart.Product_id AND cart.Email = '$email'";
     // $stockresult = $mysql_query( $updatestock) ;
      
        if ($conn->query(  $updatestock) === TRUE){
       $sqlremove = "DELETE FROM cart WHERE Email = '$email'";
       $removesuccess = $conn->query( $sqlremove) ;
        }
       
    }
   

        
    
    
    
    
    
    $signed= hash_hmac('sha256', $signing, 'S-70hE9AiAYIMZdm8pKRFYfA');
   
     echo '<br><br><body><div><h2><br><br><center>Your Receipt</center>
     </h1>
     <table border=1 width=80% align=center>
     <tr><td>Receipt ID</td><td>'.$receiptid.'</td></tr><tr><td>Email to </td>
     <td>'.$email. ' </td></tr><td>Amount </td><td>RM '.$amount.'</td></tr>
     <tr><td>Payment Status </td><td>'.$paidstatus.'</td></tr>
     <tr><td>Date </td><td>'.date("d/m/Y").'</td></tr>
     <tr><td>Time </td><td>'.date("h:i a").'</td></tr>
     </table><br>
     <p><center>Press back button to return to GohCases mainscreen</center></p></div></body>';
}
else{
     echo 'Payment Failed!';
      echo "".$name;
      echo "".$address;
       echo "".$email;
      echo "".$amount;
       echo "".$phone;
     
}
?>