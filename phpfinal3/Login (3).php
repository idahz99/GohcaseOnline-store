<?php
error_reporting(0);
include_once("dbconnector.php");
$email = $_POST['email'];
//$Username = $_POST['Username'];
$password = sha1($_POST['password']);

$sqllogin = "SELECT * FROM tabel_Users WHERE Email='$email' AND Password = '$password' AND OTP ='0' ";
$result = $conn->query($sqllogin);
if ($result ->num_rows > 0){
    while ($row= $result  -> fetch_assoc()){
    //echo  "Success ";
       echo $data = "Success,".$row["username"].",".$row["Date"]. ",".$row["status"].",".$row["user_id"].",".$row["cus_address"].",".$row["cus_phone"];
}
   }else
   echo "failed";
    

?>