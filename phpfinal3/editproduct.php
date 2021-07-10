<?
include_once("dbconnector.php");
$encoded_string = $_POST['encoded_string'];
$productid = $_POST['productid'];
$productname = $_POST['productname'];
  $productquantity = $_POST['productquantity'];
 $productprice = $_POST['productprice'];
$productdescription = $_POST['productdescription'];

$sqlcheck = "SELECT * FROM table_products WHERE product_id ='$productid'";
$result = $conn->query($sqlcheck);
if ($result ->num_rows > 0){
    $sqledit =  " UPDATE table_products SET product_name = '$productname' ,product_description = '$productdescription' ,product_price = '$productprice' ,product_quantity =  '$productquantity' WHERE product_id = '$productid' ";
    if($conn->query($sqledit) ===TRUE ){
       echo "success";  
      if ($encoded_string != null ){
          $decoded_string =base64_decode($encoded_string);
           $path ='../images/products/'.$productid.'.png';
            unlink($path);
            $is_written = file_put_contents($path, $decoded_string);
      }
           
          }else echo "failed";
    // echo 'success';
    
}else echo 'failed'


?>