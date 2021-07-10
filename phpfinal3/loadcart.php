<?php
include_once("dbconnector.php");
$email = $_POST['email'];
$sqlloadcart = "SELECT * FROM cart WHERE Email = '$email' ";
$result = $conn->query($sqlloadcart);
echo $num = $result-> num_rows;
?>