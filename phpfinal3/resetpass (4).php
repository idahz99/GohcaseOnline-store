<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home8/crimsonw/public_html/s269349/GohCases/php/PHPMailer/src/Exception.php';
require '/home8/crimsonw/public_html/s269349/GohCases/php/PHPMailer/src/PHPMailer.php';
require '/home8/crimsonw/public_html/s269349/GohCases/php/PHPMailer/src/SMTP.php';


include_once("dbconnector.php");
    
$email = $_POST['email'];
$generatenewpass = random_password(10);
$passha1 = sha1($generatenewpass);
$generateotp = rand(1000,9999);


$sql = "SELECT * FROM tabel_Users WHERE Email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $sqlupdate = "UPDATE tabel_Users SET OTP = '$generateotp', Password = '$passha1' WHERE Email = '$email'";
        if ($conn->query($sqlupdate) === TRUE){
                 echo 'success';
                sendEmail($generateotp,$generatenewpass ,$email);
               
        }else{
                echo 'failed';
        }
    }else{
        echo "failed";
    }

function sendEmail($generateotp,$generatenewpass ,$email){
   $mail = new PHPMailer(true);

    $mail->SMTPDebug = 0;                                               //Disable verbose debug output
    $mail->isSMTP();                                                    //Send using SMTP
    $mail->Host       = 'mail.crimsonwebs.com';                          //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                           //Enable SMTP authentication
    $mail->Username   = 'gohcases@crimsonwebs.com';                  //SMTP username
    $mail->Password   = 'xv.Y6mvyJ)aq';                                 //SMTP password
    $mail->SMTPSecure = 'tls';         
    $mail->Port       =  587;
    
    $from = "gohcases@crimsonwebs.com";
    $to = $email;
    $subject = 'From GohCases.Please verify your account';
    $message ="<p>Your account has been reset. Please login again using the information below.</p><br><br><h3>Password:".$generatenewpass.
    "</h3><br><br><a href='https://slumberjer.com/touringholic/php/verify_account.php?email=".$email."&key=".$generateotp."'>Click Here to activate account</a>";
    
    $mail->setFrom($from,"GohCases");
    $mail->addAddress($to);                                                     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                                //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->send();
}

function random_password($length){
    //A list of characters that can be used in our random password
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //Create blank string
    $generatedpassword = '';
    //Get the index of the last character in our $characters string
    $characterListLength = mb_strlen($characters, '8bit') - 1;
    //Loop from 1 to the length that was specified
    foreach(range(1,$length) as $i){
        $generatedpassword .=$characters[rand(0,$characterListLength)];
    }
    return $generatedpassword;
}