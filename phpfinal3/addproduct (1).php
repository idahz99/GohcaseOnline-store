<?
include_once ("dbconnector.php");
$encoded_string = $_POST['encoded_string'];
$productname =$_POST["productname"];
$productquantity = $_POST["productquantity"];
$productprice = $_POST["productprice"];
$productdescription = $_POST["productdescription"];
 
 $sqlinsert = "INSERT INTO table_products(product_name,product_description,product_price,product_quantity)VALUES ('$productname','$productdescription','$productprice','$productquantity')";
 if ($conn->query($sqlinsert) === TRUE){
     $filename =mysqli_insert_id($conn);
     $decoded_string =base64_decode($encoded_string);
     $path ='../images/products/'.$filename.'.png';
     $is_written = file_put_contents($path, $decoded_string);
     echo "success";
 } else echo "failed"
 ?>