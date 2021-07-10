<?
include_once("dbconnector.php");



    $sql = "SELECT * FROM tabel_Users WHERE status = 'User'";
 
if ($result=mysqli_query($conn,$sql)) {
    $rowcount=mysqli_num_rows($result);
    echo "".$rowcount; 
}


function total_num_users(){
  $sql = "SELECT * FROM tabel_Users WHERE status = 'User'";
  $result = mysqli_query($connection,$sql);
  $count = mysqli_num_rows($result);
  return $count; 
}


 $result = mysqli_query($connection, $sqlcount);
 $num = mysqli_num_rows($sqlcount);




?>