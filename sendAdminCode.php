<?php
require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["admin_email"])){

    $email = $_POST["admin_email"];

    if (empty($email)){
        echo ("Please enter your Email !!!");
    }else if(strlen($email) >= 100){
        echo ("Email must have less than 100 characters");
    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo ("Invalid Email !!!");
    } else {
    
    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
    $n = $rs->num_rows;

    if($n == 1){

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE 
        `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sadeepasrirohanasinghe2@gmail.com';
            $mail->Password = 'dgrrfxryvhzxscob';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('sadeepasrirohanasinghe2@gmail.com', 'Bright and Beyond Admin Log In');
            $mail->addReplyTo('sadeepasrirohanasinghe2@gmail.com', 'Bright and Beyond Admin Log In');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Bright and Beyond Admin Log In Verification Code';
            $bodyContent = '<h3 style="color:black">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

    }else{
        echo ("No admins with this Email Address");
    }

}
}

?>