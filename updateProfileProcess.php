<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["m"];
    $line1 = $_POST["l1"];
    $line2 = $_POST["l2"];
    $province = $_POST["p"];
    $district = $_POST["d"];
    $city = $_POST["c"];
    $pcode = $_POST["pc"];



    Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' 
            WHERE `email`='" . $_SESSION["u"]["email"] . "'");

    $address_rs = Database::search("SELECT * FROM `user_has_addres` WHERE 
            `user_email`='" . $_SESSION["u"]["email"] . "'");
    $address_num = $address_rs->num_rows;

    if ($address_num == 1) {

        Database::iud("UPDATE `user_has_addres` SET `line 1`='" . $line1 . "',
                `line 2`='" . $line2 . "',
                `city_id`='" . $city . "',
                `postal_code`='" . $pcode . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
    } else {

        Database::iud("INSERT INTO `user_has_addres` 
                (`line 1`,`line 2`,`user_email`,`city_id`,`postal_code`) VALUES 
                ('" . $line1 . "','" . $line2 . "','" . $_SESSION["u"]["email"] . "','" . $city . "','" . $pcode . "')");
    }

    echo ("success");
} else {
    echo ("Please login first");
}
