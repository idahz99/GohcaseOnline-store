<?
include_once("dbconnector.php");
$encoded_string = $_POST['encoded_string'];
$userid = $_POST['userid'];
$username = $_POST['username'];
 $address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$sqlcheck = "SELECT * FROM tabel_Users WHERE user_id ='$userid' ";
$result = $conn->query($sqlcheck);
if ($result ->num_rows > 0){
    $sqledit =  " UPDATE tabel_Users SET username = '$username' ,cus_address = '$address' ,cus_phone = '$phone' WHERE user_id = '$userid' ";
    if($conn->query($sqledit) ===TRUE ){
       echo "success";  
      if ($encoded_string != null ){
          $decoded_string =base64_decode($encoded_string);
            $path ='../images/Profilepicture/'.$userid.'.png';
            if (file_exists($path))
            {file_put_contents($path,$decoded_string);
              // $is_written = file_put_contents($path, $decoded_string);  
            }
           else{
             file_put_contents($path,$decoded_string);  
           }
           // $is_written = file_put_contents($path, $decoded_string);
      }
           file_put_contents($path,$decoded_string);    
          }else echo "faileda";
    // echo 'success';
    
}else echo 'failedb'

?>