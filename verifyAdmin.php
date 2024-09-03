<?php

session_start();

require "connection.php";

$admin_email = $_POST["admin_email"];
$admin_VCode = $_POST["admin_VCode"];

if (empty($admin_email)) {
    echo ("Please enter your Email !!!");
} else if (strlen($admin_email) >= 100) {
    echo ("Email must have less than 100 characters");
} else if (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email !!!");
} else {



    $rs = Database::search("SELECT `verification_code` FROM `admin` WHERE `email`='" . $admin_email . "' AND `verification_code`='" . $admin_VCode . "'");

    $n = $rs->num_rows;

    if ($n == 1) {
        
        $d = $rs->fetch_assoc();
        $_SESSION["au"] = $d;
        echo ("Success");
    } else {

        echo ("Unregistered admin Email or Invalid Verification Code");
    }
}
