<?php

require "connection.php";

$email = $_POST["e"];
$np = $_POST["n"];
$rnp = $_POST["r"];
$vcode = $_POST["v"];

if (empty($email)){
    echo ("Please enter your Email !!!");
}else if(strlen($email) >= 100){
    echo ("Email must have less than 100 characters");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email !!!");
} else if (empty($np)) {
    echo ("Please insert a new Password");
} else if (strlen($np) < 5 || strlen($np) > 20) {
    echo ("Invalid Password");
} else if (empty($rnp)) {
    echo ("Please Re-type your new Password");
} else if ($np != $rnp) {
    echo ("Password does not matched");
} else if (empty($vcode)) {
    echo ("Please enter your Verification Code");
} else {

    $rs = Database::search("SELECT `verification_code` FROM `user` WHERE `email`='" . $email . "' AND `verification_code`='" . $vcode . "'");

    $n = $rs->num_rows;

    if ($n == 1) {

        Database::iud("UPDATE `user` SET `password`='" . $np . "' WHERE `email`='" . $email . "'");
        echo ("success");

    } else {

        echo ("Invalid Email or Verification Code");

    }
}
