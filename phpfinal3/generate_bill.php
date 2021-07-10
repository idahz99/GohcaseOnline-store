<?php
error_reporting(0);
$email = $_GET['email'];
$phone = $_GET['phone'];
$name  = $_GET['name'];
$amount = $_GET['amount'];
$address = $_GET['address'];
$api_key ='8a20567c-e381-4224-863f-1e3f4cac4532';
$collection_id = '0oabse1l';
$host = 'https://billplz-staging.herokuapp.com/api/v3/bills';

$data = array(
    'collection_id' => $collection_id,
      'email'=> $email,
    'phone' => $phone,
     'name'=> $name,
     'amount'=> $amount*100,
     'address' => $address,
      'description'=> "Payment for ordering GohCases",
      'callback_url' => "https://crimsonwebs.com/s269349/GohCases/php/return_url",
      'redirect_url' => "https://crimsonwebs.com/s269349/GohCases/php/payment_update.php?email=$email&phone=$phone&amount=$amount&address=$address&name=$name"
    );
    $process = curl_init($host);
    curl_setopt($process, CURLOPT_HEADER, 0);
    curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
    curl_setopt($process, CURLOPT_TIMEOUT, 30);
    curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data));
   // curl_setopt($process, CURLOPT_HEADER,http_build_query($data));
    
    $return = curl_exec($process);
curl_close($process);

$bill = json_decode($return, true);

echo "<pre>".print_r($bill, true)."</pre>";
header("Location: {$bill['url']}");
     
    


?>